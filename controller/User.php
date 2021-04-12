<?php

namespace controller;

use core\Controller;
use core\Model;
use Exception;


class User extends Controller
{
    public function __construct()
    {
        $this->model = new Model;
    }

    public function add()
    {
        $this->checkPostRequest();

        $this->bddRequestAndRenderJson($this->model->add($_POST, 'User'), 'Your inscription is a success');
    }

    public function connexion()
    {
        $this->checkPostRequest();

        if (!isset($_POST["login"]) || !isset($_POST["password"]) || empty($_POST['login']) || empty($_POST['password'])) {
            $this->renderJson(['msg' => 'Please fullfill your login & password'], 200);
        }
        if ($user =  $this->model->getBy('login', $_POST["login"], 'User')) {
            if (password_verify($_POST["password"], $user->password)) {
                $_SESSION['user'] = $user;
                $this->renderJson(['msg' => 'Connexion granted'], 201);
            }
        }
        $this->renderJson(['msg' => 'Connexion failed. Login or password incorrect'], 401);
    }

    public function logout()
    {
        session_destroy();
        header("Location: " . BASE_URL);
    }

    public function update($parameters = NULL)
    {
        $user = $this->checkUserSession();

        if (is_string($parameters) && strpos($parameters, 'Privilege')) {

            $id = $_POST['id'];
            $privilege = is_string($user->privilege) ? unserialize($user->privilege) : $user->privilege;
            if ($parameters == 'addPrivilege') {
                $privilege[] = (int) $id;
            } else if ($parameters == 'removePrivilege') {
                $privilege = array_diff($privilege,  array($id));
            }

            $user->privilege = serialize($privilege);
        }
        $this->model->update((array) $user, 'User');
        exit();
        return $this->bddRequestAndRenderJson('lala', 'Task successfully updated');
    }

    public function updateForm($buffer = false)
    {
        $user = $this->checkUserSession();

        $keyword = isset($_POST["search"]) ? $_POST["search"] : ' ';
        $results =  $this->search($keyword);

        return $this->renderHtml(compact('user', 'results'), 'component/user_update_form.php', $buffer);
    }

    public function search($login)
    {
        $login = htmlspecialchars($login);
        if ($login == "" || $login == " ") {
            return [];
        } else {
            $users = $this->model->search($login, 'login', 'User');
        }

        return $users;
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
