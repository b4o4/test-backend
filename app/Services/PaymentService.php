<?php

namespace App\Services;

use App\Domain\Enums\StatusType;
use App\DTO\Payment\GatewayOneDTO;
use App\DTO\Payment\GatewayTwoDTO;
use App\Exceptions\InvalidSignatureException;
use App\Exceptions\PaymentNotFoundException;
use App\Exceptions\StatusPaymentNotFoundException;
use App\Models\Payment;
use App\Services\Abstract\PaymentInterface;

class PaymentService implements PaymentInterface
{
    public function savePaymentGatewayOne(GatewayOneDTO $dto): void
    {
        $payment = new Payment();

        $this->checkStatus($dto->status);

        $payment = $this->getPayment($dto->merchant_id, $payment->id);

        if ($payment === null) {
            throw new PaymentNotFoundException();
        }

        $this->savePayment($payment, $dto->status, $dto->timestamp);
    }

    public function savePaymentGatewayTwo(GatewayTwoDTO $dto): void
    {
        $payment = new Payment();

        $payment = $this->getPayment($dto->project, $dto->invoice);

        if ($payment === null) {
            throw new PaymentNotFoundException();
        }

        $payment->fill([
            'merchant_id' => $dto->project,
            'payment_id' => $dto->invoice,
            'status' => $dto,
            'amount' => $dto->amount,
            'amount_paid' => $dto->amount_paid,
        ]);

        $this->savePayment($payment, $dto->status, now()->toString());
    }

    public function checkSignatureGatewayOne(GatewayOneDTO $dto): void
    {
        $signArray = $dto->toArray();
        unset($signArray['sign']);

        ksort($signArray);

        $sign = hash('sha256', implode(':', $signArray).config('services.merchant_one.key'));

        if ($sign != $dto->sign) {
            throw new InvalidSignatureException();
        }
    }

    public function checkSignatureGatewayTwo(GatewayTwoDTO $dto, ?string $authSign): void
    {
        if ($authSign === null) {
            throw new InvalidSignatureException();
        }

        $signArray = $dto->toArray();

        ksort($signArray);

        $sign = md5(implode('.', $signArray).config('services.merchant_two.key'));

        if ($sign != $authSign) {
            throw new InvalidSignatureException();
        }
    }

    private function checkStatus(string $status): void
    {
        if (!StatusType::statusExist($status)) {
            throw new StatusPaymentNotFoundException();
        }
    }

    private function getPayment(int $merchantId, int $paymentId): ?Payment
    {
        return Payment::newQuery()
            ->where('merchant_id', $merchantId)
            ->where('payment_id', $paymentId)
            ->first();
    }

    private function savePayment(Payment $payment, string $status, string $time): void
    {
        $payment->update([
            'status' => $status,
            'updated_at' => $time
        ]);
    }
}