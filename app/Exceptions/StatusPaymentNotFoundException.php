<?php

namespace App\Exceptions;

class StatusPaymentNotFoundException extends BusinessException
{
    protected $code = 422;

    protected string $userMessage = 'Статус не найден';
}
