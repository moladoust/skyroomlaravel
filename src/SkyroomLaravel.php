<?php

namespace Moladoust\Skyroomlaravel;

use Moladoust\Skyroomlaravel\Api\Skyroom;
use Moladoust\Skyroomlaravel\Api\HttpError;


class SkyroomLaravel
{
    private $api;

    public function __construct($apiUrl)
    {
        $this->api = new Skyroom($apiUrl);
    }

    public function getServiceStatuses() {
        return [
            'inactive' => 0,
            'active' => 1,
        ];
    }

    public function getRoomStatuses() {
        return [
            'inactive' => 0,
            'active' => 1,
        ];
    }

    public function getUserStatuses() {
        return [
            'inactive' => 0,
            'active' => 1,
        ];
    }

    public function getUserGenders() {
        return [
            'unknown' => 0,
            'male' => 1,
            'female' => 2,
        ];
    }

    public function getRoomAccesses() {
        return [
            'normal' => 1,
            'instructor' => 2,
            'operator' => 3,
        ];
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

    public function getRoomByName($roomName)
    {
        $params = array(
            'name' => $roomName,
        );
        return $this->_getMessage('getRoom', $params);
    }

    public function getRoomUrl($roomId, $relative = false, $language = null)
    {
        $params = array(
            'room_id' => $roomId,
            'relative' => $relative,
            'language' => $language ?: config('skyroom.language'),
        );

        return $this->_getMessage('getRoomUrl', $params);
    }

    public function createRoom($name, $title, $guestLogin = true, $opLoginFirst = false, $maxUsers = 30)
    {
        $params = array(
            'name' => $name,
            'title' => $title,
            'guest_login' => $guestLogin,
            'op_login_first' => $opLoginFirst,
            'max_users' => $maxUsers,
        );

        return $this->_getMessage('createRoom', $params);
    }

    public function updateRoom($roomId, $name, $title, $guestLogin, $opLoginFirst, $maxUsers)
    {
        $params = array(
            'room_id' => $roomId,
            'name' => $name,
            'title' => $title,
            'guest_login' => $guestLogin,
            'op_login_first' => $opLoginFirst,
            'max_users' => $maxUsers,
        );

        return $this->_getMessage('updateRoom', $params);
    }

   /*  public function updateRoom00($roomId, $timeLimit, $sessionDuration)
    {
        $params = array(
            'room_id' => $roomId,
            'time_limit' => $timeLimit,
            'session_duration' => $sessionDuration,
        );

        return $this->_getMessage('updateRoom', $params);
    } */

    public function deleteRoom($roomId)
    {
        $params = array(
            'room_id' => $roomId,
        );

        return $this->_getMessage('deleteRoom', $params);
    }

    public function getRoomUsers($roomId)
    {
        $params = array(
            'room_id' => $roomId,
        );

        return $this->_getMessage('getRoomUsers', $params);
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

        return $this->_getMessage('addRoomUsers', $params);
    }

    public function removeRoomUsers($roomId, array $usersId)
    {
        $params = array(
            'room_id' => $roomId,
            'users' => $usersId,
        );

        return $this->_getMessage('removeRoomUsers', $params);
    }

    public function updateRoomUser($roomId, $userId, $newAccess)
    {
        $params = array(
            'room_id' => $roomId,
            'user_id' => $userId,
            'access' => $newAccess,
        );

        return $this->_getMessage('updateRoomUser', $params);
    }

    public function getUsers()
    {
        return $this->_getMessage('getUsers', []);
    }

    public function countUsers()
    {
        return $this->_getMessage('countUsers', []);
    }

    public function getUser($userId)
    {
        $params = array(
            'user_id' => $userId,
        );

        return $this->_getMessage('getUser', $params);
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

        return $this->_getMessage('createUser', $params);
    }

    public function updateUser($userId, array $params)
    {
        $params = array_merge(['user_id' => $userId], $params);

        return $this->_getMessage('updateUser', $params);
    }

    public function deleteUser($userId)
    {
        $params = array(
            'user_id' => $userId,
        );

        return $this->_getMessage('deleteUser', $params);
    }

    public function getUserRooms($userId)
    {
        $params = array(
            'user_id' => $userId,
        );

        return $this->_getMessage('getUserRooms', $params);
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

        return $this->_getMessage('addUserRooms', $params);
    }

    public function removeUserRooms($userId, array $roomsId)
    {
        $params = array(
            'user_id' => 5,
            'rooms' => $roomsId,
        );

        return $this->_getMessage('removeUserRooms', $params);
    }

    public function getLoginUrl($roomId, $userId, $language = null, $ttl = 60)
    {
        $params = array(
            'room_id' => $roomId,
            'user_id' => $userId,
            'language' => $language ?: config('skyroom.language'),
            'ttl' => $ttl,
        );

        return $this->_getMessage('getLoginUrl', $params);
    }

    public function createLoginUrl($roomId, $userId, $nickname, $access, $concurrent, $ttl, $language = null)
    {
        $params = array(
            'room_id' => $roomId,
            'user_id' => $userId,
            'nickname' => $nickname,
            'access' => $access,
            'concurrent' => $concurrent,
            'ttl' => $ttl,
            'language' => $language ?: config('skyroom.language'),
        );

        return $this->_getMessage('createLoginUrl', $params);
    }
}
