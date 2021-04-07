<?php

namespace controller;

use core\Controller;


class Home extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $content = $this->renderHtml(NULL, 'page/home.php', true);
        $this->renderHtml(compact('content'), 'template/user.php');
    }
}
