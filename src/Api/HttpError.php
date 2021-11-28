<?php

namespace Moladoust\Skyroomlaravel\Api;

class HttpError
{
    private $code;
    private $message;

    function __construct($message, $code = 0) {
        $this->code = $code;
        $this->message = $message;
    }

    function getCode() {
        return $this->code;
    }

    function getMessage() {
        return $this->message;
    }

    static function IsError(&$input) {
        return is_object($input) && (get_class($input) === 'Moladoust\Skyroomlaravel\Api\HttpError');
    }
}
