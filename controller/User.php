<?php

namespace controller;

use core\Controller;
use core\Model;
use Exception;


class User extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new Model;
    }

    public function add()
    {
        $errors = [];
        foreach ($_POST as $key => $value) {

            $method = 'verify' . ucfirst($key);
            if (method_exists($this, $method)) {
                if (($msg = $this->$method($value)) === TRUE) {
                    continue;
                }
            }

            if (empty($value)) {
                $msg = ucfirst($key) . " is empty, please fill it";
            }

            if (isset($msg) && ($msg != 1)) {
                $errors[] = $msg;
                unset($msg);
            }
        }
        try {
            if (empty($errors) && $this->model->add($_POST, 'Users')) {
                $this->renderJson(['msg' => 'Your inscription is a success'], 201);
            } else {
                $this->renderJson(['msg' => implode('. ', $errors)]);
            }
        } catch (Exception $e) {
            $this->renderJson(['msg' => $e->getMessage()], 500);
        }
    }

    public function connexion()
    {
        if (!isset($_POST["login"]) || !isset($_POST["password"]) || empty($_POST['login']) || empty($_POST['password'])) {
            $this->renderJson(['msg' => 'Please fullfill your login & password'], 200);
        }
        if ($user =  $this->model->getBy('login', $_POST["login"], 'Users')) {
            if (password_verify($_POST["password"], $user->password)) {
                $_SESSION['user'] = $user;
                $this->renderJson(['msg' => 'Connexion granted'], 201);
            }
        }
        $this->renderJson(['msg' => 'Connexion failed. Login or password incorrect'], 401);
    }

    public function verifyEmail(string $mail)
    {
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            return TRUE;
        } else {
            return 'Your Email is not valid.';
        }
    }

    public function verifyPassword(string $password)
    {
        if (strlen($password) > 4) {
            $this->password = $password;
            return TRUE;
        } else {
            return 'Your password length is to short, 5 chars needed at least.';
        }
    }

    public function verifyPassword_conf(string $password_conf)
    {
        if ($password_conf == $this->password) {
            $_POST['password'] = password_hash($password_conf, PASSWORD_DEFAULT);
            unset($_POST['password_conf']);
            return TRUE;
        } else {
            return 'Password and password confirmation have to be identical.';
        }
    }
}
