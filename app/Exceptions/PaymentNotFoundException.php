<?php

namespace App\Exceptions;

class PaymentNotFoundException extends BusinessException
{
    protected $code = 404;

    protected string $userMessage = 'Платеж не найден';
}
