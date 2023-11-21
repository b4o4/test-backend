<?php

namespace App\DTO\Payment;

use Atwinta\DTO\DTO;

class GatewayTwoDTO extends DTO
{
    public function __construct(
        public readonly int $project,
        public readonly int $invoice,
        public readonly string $rand,
        public readonly string $status,
        public readonly int $amount,
        public readonly int $amount_paid,
    ) {}
}
