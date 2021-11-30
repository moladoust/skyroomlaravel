<?php

namespace Moladoust\Skyroomlaravel;

use Moladoust\Skyroomlaravel\Api\Skyroom;
use Moladoust\Skyroomlaravel\Api\HttpError;


class SkyroomLaravel
{
    const SERVICE_STATUS__INACTIVE = 0;
    const SERVICE_STATUS__ACTIVE = 1;

    const ROOM_STATUS__INACTIVE = 0;
    const ROOM_STATUS__ACTIVE = 1;

    const USER_STATUS__INACTIVE = 0;
    const USER_STATUS__ACTIVE = 1;

    const USER_GENDER__UNKNOWN = 0;
    const USER_GENDER__MALE = 1;
    const USER_GENDER__FEMALE = 2;

    const ROOM_ACCESS__NORMAL_USER = 1;
    const ROOM_ACCESS__NORMAL_INSTRUCTOR = 2;
    const ROOM_ACCESS__NORMAL_OPERATION = 3;


    private $api;

    public function __construct($apiUrl)
    {
        $this->api = new Skyroom($apiUrl);
    }

    private function _getMessage($action, $params)
    {
        try {
            $result = $this->api->call($action, $params);

            if (HttpError::IsError($result)) {
                return [
                    'status' => 'error',
                    'message' => $result->getMessage(),
                    'code' => $result->getCode(),
                    // 'data' => $result['result'],
                ];
            } elseif (!$result['ok']) {
                return [
                    'status' => 'error',
                    // 'message' => $result->getMessage(),
                    // 'code' => $result->getCode(),
                    'message' => $result['error_message'],
                    'code' => $result['error_code'],
                ];
            } else {
                return [
                    'status' => 'success',
                    // 'message' => $result->getMessage(),
                    // 'code' => $result->getCode(),
                    'data' => $result['result'],
                ];
            }
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ];
        }
    }

    /////

    public function getServices()
    {
        return $this->_getMessage('getServices', []);
    }

    public function getRooms()
    {
        return $this->_getMessage('getRooms', []);
    }

    public function countRooms()
    {
        return $this->_getMessage('countRooms', []);
    }

    public function getRoom($roomId)
    {
        $params = array(
            'room_id' => $roomId,
        );
        return $this->_getMessage('getRoom', $params);
    }

    public function getRoomUrl($roomId, $relative = true, $language = 'fa')
    {
        $params = array(
            'room_id' => $roomId,
            'relative' => $relative,
            'language' => $language,
        );

        return $this->_getMessage('getRoomUrl', $params);
    }

    public function createRoom($name, $title, $maxUsers, $guestLogin = true)
    {
        $params = array(
            'name' => $name,
            'title' => $title,
            'max_users' => $maxUsers,
            'guest_login' => $guestLogin,
        );

        return $this->_getMessage('getRoomUrl', $params);
    }

    public function updateRoom($roomId, $timeLimit, $sessionDuration)
    {
        $params = array(
            'room_id' => $roomId,
            'time_limit' => $timeLimit,
            'session_duration' => $sessionDuration,
        );

        return $this->_getMessage('getRoomUrl', $params);
    }

    public function deleteRoom($roomId)
    {
        $params = array(
            'room_id' => $roomId,
        );

        return $this->_getMessage('getRoomUrl', $params);
    }

    public function getRoomUsers($roomId)
    {
        $params = array(
            'room_id' => $roomId,
        );

        return $this->_getMessage('getRoomUrl', $params);
    }

    /**
     * @param $user array : [ [user_id: ..., access: Skyroom::USER_ACCESS_...] ]
     */
    public function addRoomUsers($roomId, $users)
    {
        $params = array(
            'room_id' => $roomId,
            'users' => $users,
        );

        return $this->_getMessage('getRoomUrl', $params);
    }

    public function removeRoomUsers($roomId, array $usersId)
    {
        $params = array(
            'room_id' => $roomId,
            'users' => $usersId,
        );

        return $this->_getMessage('getRoomUrl', $params);
    }

    public function updateRoomUser($roomId, $userId, $newAccess)
    {
        $params = array(
            'room_id' => $roomId,
            'user_id' => $userId,
            'access' => $newAccess,
        );

        return $this->_getMessage('getRoomUrl', $params);
    }

    public function getUsers()
    {
        return $this->_getMessage('getRoomUrl', []);
    }

    public function countUsers()
    {
        return $this->_getMessage('getRoomUrl', []);
    }

    public function getUser($userId)
    {
        $params = array(
            'user_id' => $userId,
        );

        return $this->_getMessage('getRoomUrl', $params);
    }

    public function createUser($username, $nickname, $password, $email, $fname, $lname, $isPublic = true)
    {
        $params = array(
            'username' => $username,
            'nickname' => $nickname,
            'password' => $password,
            'email' => $email,
            'fname' => $fname,
            'lname' => $lname,
            'is_public' => $isPublic,
        );

        return $this->_getMessage('getRoomUrl', $params);
    }

    public function updateUser($userId)
    {
        $params = array(
            'user_id' => $userId,
        );

        return $this->_getMessage('getRoomUrl', $params);
    }

    public function deleteUser($userId)
    {
        $params = array(
            'user_id' => $userId,
        );

        return $this->_getMessage('getRoomUrl', $params);
    }

    public function getUserRooms($userId)
    {
        $params = array(
            'user_id' => $userId,
        );

        return $this->_getMessage('getRoomUrl', $params);
    }

    /**
     * @param $rooms = [ [ room_id: ..., {optional}'acces': Skyroom::USER_ACCESS_... ] ]
     */
    public function addUserRooms($userId, $rooms)
    {
        $params = array(
            'user_id' => $userId,
            'rooms' => $rooms,
        );

        return $this->_getMessage('getRoomUrl', $params);
    }

    public function removeUserRooms($userId, array $roomsId)
    {
        $params = array(
            'user_id' => 5,
            'rooms' => $roomsId,
        );

        return $this->_getMessage('getRoomUrl', $params);
    }

    public function getLoginUrl($roomId, $userId, $language = 'fa', $ttl = 60)
    {
        $params = array(
            'room_id' => $roomId,
            'user_id' => $userId,
            'language' => $language,
            'ttl' => $ttl,
        );

        return $this->_getMessage('getRoomUrl', $params);
    }

    public function createLoginUrl($roomId, $userId, $nickname, $access, $concurrent, $ttl, $language = 'fa')
    {
        $params = array(
            'room_id' => $roomId,
            'user_id' => $userId,
            'nickname' => $nickname,
            'access' => $access,
            'concurrent' => $concurrent,
            'ttl' => $ttl,
            'language' => $language,
        );

        return $this->_getMessage('getRoomUrl', $params);
    }
}
