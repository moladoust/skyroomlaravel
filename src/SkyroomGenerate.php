<?php

namespace Moladoust\Skyroomlaravel;

use Moladoust\Skyroomlaravel\Api\Skyroom;

class SkyroomGenerate {

    private $users = [];

    public function addUser($userId, $access = Skyroom::USER_ACCESS_PRESENTER) {
        $this->users[] = [
            'user_id' => $userId,
            'access' => $access,
        ];
        return $this;
    }

    public function getUsers() {
        return $this->users;
    }
}