<?php

namespace controller;

use core\Controller;
use Exception;
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
        $user = $this->checkUserSession();

        $component__task_done_list = $this->done(true);

        $component__task_todo_list = $this->todo(true);

        $component__task_add_form = $this->addForm(true);

        $content = $this->renderHtml(compact('component__task_done_list', 'component__task_todo_list', 'component__task_add_form'), 'page/todolist.php', 'true');

        $this->renderHtml(compact('content'), 'template/user.php', false, 200);
    }

    public function done($buffer = false)
    {
        $user = $this->checkUserSession();

        $tasksDone = $this->model->getTasksDone($user->id);
        return $this->renderHtml(compact('tasksDone'), 'component/task_done_list.php', $buffer);
    }

    public function todo($buffer = false)
    {
        $user = $this->checkUserSession();

        $tasksToDo = $this->model->getTasksToDo($user->id);
        return $this->renderHtml(compact('tasksToDo'), 'component/task_todo_list.php', $buffer);
    }

    public function addForm($buffer = false)
    {
        $user = $this->checkUserSession();

        return $this->renderHtml(compact('user'), 'component/task_add_form.php', $buffer);
    }

    public function updateForm($buffer = false)
    {
        $user = $this->checkUserSession();

        $this->checkPostRequest();

        $task = $this->model->getBy('id', $_POST['id'], 'Task');

        return $this->renderHtml(compact('user', 'task'), 'component/task_update_form.php', $buffer);
    }

    public function add()
    {
        $user = $this->checkUserSession();

        $_POST["creator_login"] = $user->login;

        $this->checkPostRequest();

        $this->bddRequestAndRenderJson($this->model->add($_POST, 'Task'), 'Task successfully added');
    }

    public function update($param)
    {
        $user = $this->checkUserSession();

        $this->checkPostRequest();

        $errors = [];

        if ($param == "changeState") {
            $task = (array) $this->model->getBy('id', (int) $_POST["task"], 'Task');
            if ($user->id == $task["owner_id"]) {
                $task["done"] = $task["done"] == 0 ? 1 : 0;
                $this->bddRequestAndRenderJson($this->model->update($task, 'Task'), 'Task successfully updated');
            } else {
                $errors[] = 'You can\'t change state of task if your not the owner';
                $this->renderJson(['msg' => implode(" ", $errors)], 200);
            }
        }

        $_POST["done"] = isset($_POST["done"]) ? 1 : 0;

        $this->bddRequestAndRenderJson($this->model->update($_POST, 'Task'), 'Task successfully updated');
    }

    public function remove($param)
    {
        $id = (int) $param;
        $this->bddRequestAndRenderJson($this->model->remove('id', $id, 'Task'), 'Task successfully removed');
    }
}
