<?php

namespace entity;

use controller\User;
use core\Entity;
use core\Model;

class UserEntity extends Entity
{
    public function getPrivilegeList()
    {
        $list = [];
        $usersID = is_string($this->privilege) ? unserialize($this->privilege) : $this->privilege;
        if (is_array($usersID) && count($usersID) > 0) {
            $model = new Model();
            foreach ($usersID as $userId) {
                $user = $model->getBy('id', $userId, 'User');
                if ($user)
                    $list[] = $user;
            }
        }
        return $list;
    }

    public function getOnWhoPrivilegeList()
    {
        $list = [];
        $model = new Model();
        $users = $model->getAll(["1" => "1"], 'User');
        foreach ($users as $user) {
            foreach ($user->getPrivilegeList() as $u) {
                if ($u->id == $this->id) {
                    $list[] = $user;
                }
            }
        }
        return $list;
    }
}
