<?php

namespace App\Exceptions;

use Exception;

class ChatNotFoundException extends Exception
{
    public function __construct(string $message = "Chat não encontrado!", int $code = 404)
    {
        parent::__construct($message, $code);
    }
}
