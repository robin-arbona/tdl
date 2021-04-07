<?php

namespace core;

use core\Model;

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
}
