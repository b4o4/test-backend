<?php

namespace Database\Seeders;

use App\Domain\Enums\StatusType;
use Illuminate\Database\Seeder;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (StatusType::values() as $status) {
            \DB::table('payment_statuses')->insertOrIgnore(['alias' => $status]);
        }
    }
}
