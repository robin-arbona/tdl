<?php

namespace core;

use core\Model;
use Exception;

class Controller
{
    protected $name;
    protected $table;
    protected $model;

    public function __construct()
    {
        $this->model = new Model();
        $this->name = str_replace('controller\\', '', strtolower(get_class($this)));
    }

    public function renderJson($data, $response_code = 200)
    {
        ob_clean();

        header_remove();
        header("Content-type: application/json; charset=utf-8");

        http_response_code($response_code);

        echo json_encode($data);

        exit();
    }

    public function renderHtml($data, $viewPath, $buffer = false, $response_code = 200)
    {
        if (is_array($data) && !empty($data)) {
            extract($data);
        }
        ob_start();
        require(dirname(dirname(__FILE__)) . "/view/$viewPath");
        $content = ob_get_clean();

        if ($buffer) {
            return $content;
        } else {
            http_response_code($response_code);
            echo $content;
            exit();
        }
    }

    public function checkPostRequest()
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
                $msg = ucfirst($key) . " is empty, please fill it.";
            }

            if (isset($msg) && ($msg != 1)) {
                $errors[] = $msg;
                unset($msg);
            }
        }
        if (!empty($errors))
            $this->renderJson(['msg' => implode(" ", $errors)], 200);
    }

    public function bddRequestAndRenderJson($request, $succesMsg = 'Success')
    {
        try {
            $this->renderJson(['msg' => $succesMsg], 201);
        } catch (Exception $e) {
            $this->renderJson(['msg' => $e->getMessage()], 500);
        }
    }

    public function checkUserSession()
    {
        if (!isset($_SESSION['user'])) {
            $this->renderHtml(NULL, 'page/denied.php', false, 403);
        }
        return $_SESSION['user'];
    }
}
