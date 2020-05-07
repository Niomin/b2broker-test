<?php

namespace Niomin\B2BrokerTest\Exceptions;

use Exception;

class B2BrokerException extends Exception
{
    const CODE_NOT_FOUND = 10001;

    public static function throwNotFoundException(int $id)
    {
        throw new self("Request $id not found", self::CODE_NOT_FOUND);
    }

    public function getResponse()
    {
        return [
            'code' => $this->code,
            'message' => $this->message
        ];
    }
}
