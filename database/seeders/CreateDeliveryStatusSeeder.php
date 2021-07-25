<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\CheckOut;
use App\Models\DeliveryStatus;

class CreateDeliveryStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deliveryStatuses = [
            ['name' => 'Full'],
            ['name' => 'Incomplete']
        ];

        foreach ($deliveryStatuses as $deliveryStatus) {
            DeliveryStatus::create($deliveryStatus);
        }

        $checkouts = CheckOut::all();
        foreach ($checkouts as $checkout) {
            $checkout->delivery_status_id = 1;
            $checkout->save();
        }
    }
}
