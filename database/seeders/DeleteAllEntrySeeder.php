<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\CheckIn;
use App\Models\Stock;
use App\Models\CheckOut;
use App\Models\ReleaseItem;

class DeleteAllEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // //retrieve all checkins
        // $checkins = CheckIn::all();
        // //delete all records of checkins
        // foreach ($checkins as $checkin) {
        //     $checkin->delete();
        // }


        // //retrieve all stocks
        // $stocks = Stock::all();
        // //delete all records of stocks
        // foreach ($stocks as $stock) {
        //     $stock->delete();
        // }

        // $checkouts = CheckOut::all();
        // foreach ($checkouts as $checkout) {
        //     $checkout->delete();
        // }

        // $releaseitems = ReleaseItem::all();
        // foreach ($releaseitems as $releaseitem) {
        //     $releaseitem->delete();
        // }

        \DB::statement('TRUNCATE TABLE check_ins;');
        \DB::statement('TRUNCATE TABLE stocks;');
        \DB::statement('TRUNCATE TABLE check_outs;');
        \DB::statement('TRUNCATE TABLE release_items;');



    }
}
