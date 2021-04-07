<?php

namespace controller;

use core\Controller;

class Task extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function dashboard()
    {
        if (isset($_SESSION['user'])) {
            $this->renderHtml(NULL, 'page/todolist.php');
        } else {
            $this->renderHtml(NULL, 'page/denied.php', false, 403);
        }
    }
}
