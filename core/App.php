<?php

namespace core;

class App
{
    public $dirName;

    public function __construct()
    {
        $this->autoload();
        $this->launchSession();
        $this->sanitizePostRequest();
        $basePathArray = explode('/', BASE_PATH);
        $this->dirName = end($basePathArray);
        $this->rooter();
    }

    private function autoload()
    {
        spl_autoload_register(function ($className) {
            require(str_replace('\\', '/', $className) . '.php');
        });
    }

    private function launchSession()
    {
        session_start();
    }

    private function sanitizePostRequest()
    {
        if (empty($_POST)) {
            return;
        }
        foreach ($_POST as $key => &$value) {
            $value = htmlspecialchars($value);
        }
    }

    private function rooter()
    {
        $root = explode('/', $_SERVER['REQUEST_URI']);

        if (array_search("base_url", $root)) {
            ob_clean();
            exit(BASE_URL);
        }
        $root = array_slice($root, array_search($this->dirName, $root) + 1);

        if (isset($root[0])  && (strlen($root[0]) > 0) && ($root[0] != 'index.php')) {
            if (file_exists('controller/' . ucfirst($root[0]) . '.php')) {
                $controllerName = 'controller\\' . ucfirst($root[0]);
                $controller = new $controllerName();
                if (isset($root[1]) && method_exists($controller, $root[1])) {
                    $method = $root[1];
                    try {
                        $parameters = isset($root[2]) ? $root[2] : NULL;
                        $controller->$method($parameters);
                        return;
                    } catch (\Exception $e) {
                        $controller->renderJson(['code' => $e->getCode(), 'message' => $e->getMessage(), 'file' => $e->getFile(), 'ligne' => $e->getLine()]);
                    }
                }
            }
        }
        $controller = new \controller\Home();
        return;
    }
}
