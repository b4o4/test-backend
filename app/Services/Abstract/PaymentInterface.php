<?php

namespace App\Services\Abstract;

use App\DTO\Payment\GatewayOneDTO;
use App\DTO\Payment\GatewayTwoDTO;

interface PaymentInterface
{
    public function savePaymentGatewayOne(GatewayOneDTO $dto): void;

    public function savePaymentGatewayTwo(GatewayTwoDTO $dto): void;

    public function checkSignatureGatewayOne(GatewayOneDTO $dto): void;

    public function checkSignatureGatewayTwo(GatewayTwoDTO $dto, ?string $authSign): void;
}