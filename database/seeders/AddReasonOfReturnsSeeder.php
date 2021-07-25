<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReasonOfReturn;
use App\Models\SubjectFor;
use App\Models\ReturnType;

class AddReasonOfReturnsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rors = [
            ['value' => 'Fauly'],
            ['value' => 'Incorrect Model'],
            ['value' => 'Swap Model']
        ];

        foreach ($rors as $item) {
            ReasonOfReturn::create($item);
        }


        $subjects = [
            ['value' => 'Replacement'],
            ['value' => 'Refund'],
            ['value' => 'Repair']
        ];

        foreach ($subjects as $subject) {
            SubjectFod::create($subject);
        }

        $reissueTypes = [
            ['name' => 'Served'],
            ['name' => 'Return to stock']
        ];

        foreach ($reissueTypes as $reissueType) {
            ReturnType::create($reissueType);
        }




    }
}
