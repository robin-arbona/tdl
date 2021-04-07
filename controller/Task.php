<?php

namespace controller;

use core\Controller;
use model\TaskModel;

class Task extends Controller
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new TaskModel();
    }

    public function dashboard()
    {
        if (!isset($_SESSION['user'])) {
            $this->renderHtml(NULL, 'page/denied.php', false, 403);
        }
        $user = $_SESSION['user'];

        $tasksDone = $this->model->getTasksDone($user->id);
        $component__task_done_list = $this->renderHtml(compact('tasksDone'), 'component/task_done_list.php', true);

        $tasksToDo = $this->model->getTasksToDo($user->id);
        $component__task_todo_list = $this->renderHtml(compact('tasksToDo'), 'component/task_todo_list.php', true);

        $component__task_add_form = $this->renderHtml(NULL, 'component/task_add_form.php', true);

        $content = $this->renderHtml(compact('component__task_done_list', 'component__task_todo_list', 'component__task_add_form'), 'page/todolist.php', 'true');

        $this->renderHtml(compact('content'), 'template/user.php', false, 200);
    }
}
