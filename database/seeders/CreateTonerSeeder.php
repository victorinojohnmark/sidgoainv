<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Toner;

class CreateTonerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* 
        ::TONER TYPES
        Mono    = 2
        Color   = 3
        
        ::UNITS
        PCS     = 1
        BOTTLES = 2
        */

        //SET YOUR USERID FROM Users Table
        $userid = 2;


        //MONO TONERS
        $toners_mono = [
            ['model_name' => 'CE285A', 'minimum_quantity' => 200],
            ['model_name' => 'CE390A', 'minimum_quantity' => 50],
            ['model_name' => 'CE255A', 'minimum_quantity' => 20],
            ['model_name' => 'CE278A', 'minimum_quantity' => 20],
            ['model_name' => 'CE505A/CF280A', 'minimum_quantity' => 50],
            ['model_name' => 'CF283A', 'minimum_quantity' => 20],
            ['model_name' => 'CF280X', 'minimum_quantity' => 10],
            ['model_name' => 'Q7551A', 'minimum_quantity' => 30],
            ['model_name' => 'Q7553A', 'minimum_quantity' => 20],
            ['model_name' => 'Q5942A', 'minimum_quantity' => 30],
            ['model_name' => 'Q7570A', 'minimum_quantity' => 20],
            ['model_name' => 'TN2380', 'minimum_quantity' => 50],
            ['model_name' => 'Canon 337A/83A', 'minimum_quantity' => 11],

        ];

        foreach ($toners_mono as $toner) {
            $toner['toner_types_id'] = 2;   //SET TONERTYPE ID
            $toner['units_id'] = 1;         //SET UNITS ID
            $toner['created_by'] = $userid; //SET USER ID

            Toner::create($toner);
        }

        //COLOR TONERS
        $toners_color = [
            ['model_name' => 'CE410A/CC530A - Black', 'minimum_quantity' => 30],
            ['model_name' => 'CE411A/CC531A - Cyan', 'minimum_quantity' => 30],
            ['model_name' => 'CE412A/CC532A - Yellow', 'minimum_quantity' => 30],
            ['model_name' => 'CE413A/CC533A - Black', 'minimum_quantity' => 30],
            ['model_name' => 'CE340A - Black', 'minimum_quantity' => 8],
            ['model_name' => 'CE341A - Cyan', 'minimum_quantity' => 6],
            ['model_name' => 'CE342A - Yellow', 'minimum_quantity' => 6],
            ['model_name' => 'CE343A - Magenta', 'minimum_quantity' => 6],
            ['model_name' => 'CF210A - Black', 'minimum_quantity' => 15],
            ['model_name' => 'CF211A - Cyan', 'minimum_quantity' => 15],
            ['model_name' => 'CF212A - Yellow', 'minimum_quantity' => 15],
            ['model_name' => 'CF213A - Magenta', 'minimum_quantity' => 15],
            ['model_name' => 'CF400A - Black', 'minimum_quantity' => 15],
            ['model_name' => 'CF401A - Cyan', 'minimum_quantity' => 15],
            ['model_name' => 'CF402A - Yellow', 'minimum_quantity' => 15],
            ['model_name' => 'CF403A - Magenta', 'minimum_quantity' => 15],
            ['model_name' => 'CF410A - Black', 'minimum_quantity' => 20],
            ['model_name' => 'CF411A - Cyan', 'minimum_quantity' => 20],
            ['model_name' => 'CF412A - Yellow', 'minimum_quantity' => 20],
            ['model_name' => 'CF413A - Magenta', 'minimum_quantity' => 20],
        ];

        foreach ($toners_color as $toner) {
            $toner['toner_types_id'] = 3;   //SET TONERTYPE ID
            $toner['units_id'] = 1;         //SET UNITS ID
            $toner['created_by'] = $userid; //SET USER ID

            Toner::create($toner);
        }
    }
}
