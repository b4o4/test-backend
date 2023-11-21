<?php

namespace App\Domain\Enums;

use App\Domain\Enums\Traits\HasValues;

enum StatusType: string
{
    use HasValues;
    case CREATED = 'created';
    case IN_PROGRESS = 'inprogress';
    case PAID = 'paid';
    case EXPIRED_OR_REJECTED = 'expired or rejected';


    public static function statusExist(string $status): bool
    {
        return in_array($status, StatusType::values());
    }
}
