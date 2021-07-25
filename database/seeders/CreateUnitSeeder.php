<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Unit;

class CreateUnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = [
            ['name' => 'PCS'],
            ['name' => 'BOTTLES']
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
