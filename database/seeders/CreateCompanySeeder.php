<?php

namespace Database\Seeders;

use App\Models\Company;

use Illuminate\Database\Seeder;

class CreateCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Company
        //HRM = 1
        //GOA = 2

        $companies = [
            ['name' => 'HRM', 'code' => 'HRM'],
            ['name' => 'GOA', 'code' => 'GOA']
        ];

        foreach ($companies as $company) {
            
            Company::create($company);
        }
    }
}
