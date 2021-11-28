<?php

namespace Moladoust\Skyroomlaravel;

use Moladoust\Skyroomlaravel\Api\Skyroom;

class SkyroomGenerate {

    // const VERSION = Skyroom::VERSION;

    // const ROOM_STATUS_DISABLED  = Skyroom::ROOM_STATUS_DISABLED;
    // const ROOM_STATUS_ENABLED   = Skyroom::ROOM_STATUS_ENABLED;

    // const USER_STATUS_DISABLED  = Skyroom::USER_STATUS_DISABLED;
    // const USER_STATUS_ENABLED   = Skyroom::USER_STATUS_ENABLED;

    // const USER_GENDER_UNKNOWN   = Skyroom::USER_GENDER_UNKNOWN;
    // const USER_GENDER_MALE      = Skyroom::USER_GENDER_MALE;
    // const USER_GENDER_FEMALE    = Skyroom::USER_GENDER_FEMALE;

    // const USER_ACCESS_NORMAL    = Skyroom::USER_ACCESS_NORMAL;
    // const USER_ACCESS_PRESENTER = Skyroom::USER_ACCESS_PRESENTER;
    // const USER_ACCESS_OPERATOR  = Skyroom::USER_ACCESS_OPERATOR;
    // const USER_ACCESS_ADMIN     = Skyroom::USER_ACCESS_ADMIN;

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