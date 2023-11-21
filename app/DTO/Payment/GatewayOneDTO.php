<?php

namespace App\DTO\Payment;

use Atwinta\DTO\DTO;

class GatewayOneDTO extends DTO
{
    public function __construct(
        public readonly int $merchant_id,
        public readonly int $payment_id,
        public readonly string $timestamp,
        public readonly string $sign,
        public readonly string $status,
        public readonly int $amount,
        public readonly int $amount_paid,
    ) {}
}
