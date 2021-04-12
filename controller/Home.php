<?php

namespace controller;

use core\Controller;


class Home extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->homePage();
    }

    public function homePage()
    {
        if (isset($_SESSION['user'])) {
            $taskCtl = new Task();
            $taskCtl->dashboard();
            exit();
        }
        $content = $this->renderHtml(NULL, 'page/home.php', true);

        $this->renderHtml(compact('content'), 'template/user.php');
    }
}
