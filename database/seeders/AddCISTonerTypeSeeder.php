<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TonerType;

class AddCISTonerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $toner = ['name' => 'CIS'];

        TonerType::create($toner);
    }
}
