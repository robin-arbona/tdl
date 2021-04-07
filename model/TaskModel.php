<?php

namespace model;

use core\Model;

class TaskModel extends Model
{
    public function getTasksDone($owner_id)
    {
        $SQL = "SELECT * FROM {$this->table} WHERE owner_id = ? AND done = ?";
        return $this->preFetchAll($SQL, [$owner_id, TRUE]);
    }

    public function getTasksToDo($owner_id)
    {
        $SQL = "SELECT * FROM {$this->table} WHERE owner_id = ? AND done = ?";
        return $this->preFetchAll($SQL, [$owner_id, FALSE]);
    }
}
