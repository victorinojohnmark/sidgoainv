<?php

namespace Database\Seeders;

use App\Models\Location;

use Illuminate\Database\Seeder;

class CreateCompanyIDonTableLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Set all company id to 1(HRM)
     * @return void
     */
    public function run()
    {
        $locations = Location::all();

        foreach ($locations as $location) {
            $location->company_id = 1;
            $location->save();
        }
    }
}
