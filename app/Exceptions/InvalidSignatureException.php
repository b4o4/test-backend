<?php

namespace App\Exceptions;

use Exception;

class InvalidSignatureException extends BusinessException
{
    protected $code = 422;

    protected string $userMessage = 'Подпись не совпадает';
}
