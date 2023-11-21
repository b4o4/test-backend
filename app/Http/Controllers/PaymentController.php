<?php

namespace App\Http\Controllers;

use App\DTO\Payment\GatewayOneDTO;
use App\Http\Requests\GatewayOneRequest;
use App\Http\Requests\GatewayTwoRequest;
use App\Services\Abstract\PaymentInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(
        protected PaymentInterface $service
    )
    {
    }

    public function gatewayOne(GatewayOneRequest $request)
    {
        $dto = GatewayOneDTO::create($request);

        $this->service->checkSignatureGatewayOne($dto);

        $this->service->savePaymentGatewayOne($dto);
    }

    public function gatewayTwo(GatewayTwoRequest $request)
    {
        $dto = GatewayOneDTO::create($request);

        $this->service->checkSignatureGatewayTwo($dto, $request->header('Authorization'));

        $this->service->savePaymentGatewayTwo($dto);
    }
}
