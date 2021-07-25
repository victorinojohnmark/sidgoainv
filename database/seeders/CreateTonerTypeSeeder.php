<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\TonerType;

class CreateTonerTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $toner_types = [
            ['name' => 'Mono'],
            ['name' => 'Color']
        ];

        foreach ($toner_types as $toner_type) {
            TonerType::create($toner_type);
        }
    }
}
