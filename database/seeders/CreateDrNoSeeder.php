<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Delivery;
use App\Models\CheckOut;

class CreateDrNoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $checkouts = Checkout::all();
        foreach ($checkouts as $checkout) {
            $dr = [
                'check_out_id' => $checkout->id,
                'dr_no' => $checkout->dr_no
            ];

            if ($checkout->status) {
                Delivery::create($dr);
            }
            
        }
    }
}
