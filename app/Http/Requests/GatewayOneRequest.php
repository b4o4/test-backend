<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GatewayOneRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            'merchant_id' => 'integer|required',
            'payment_id' => 'integer|required',
            'timestamp' => 'date|string',
            'sign' => 'string|required'
        ]);
    }
}
