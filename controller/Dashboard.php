<?php

namespace controller;

use core\Controller;

class Dashboard extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $content = $this->renderHtml(NULL, 'page/dashboard.php', true);
        $this->renderHtml(compact('content'), 'template/user.php');
    }
}
