<?php

namespace core;

use core\Model;

class Controller
{
    protected $name;
    protected $table;

    public function __construct()
    {
        $this->name = str_replace('controller\\', '', strtolower(get_class($this)));
        $this->table = $this->name . 's';
    }

    public function renderJson($data, $response_code = NULL)
    {
        ob_clean();

        header_remove();
        header("Content-type: application/json; charset=utf-8");

        $success = !empty($data) ? true : false;
        $response_code = (($response_code == NULL) && ($success)) ? 200 : $response_code;
        $response_code = (($response_code == NULL) && (!$success)) ? 500 : $response_code;
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
