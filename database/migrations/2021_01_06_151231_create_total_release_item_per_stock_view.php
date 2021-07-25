<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalReleaseItemPerStockView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // CREATE VIEW view_total_release_item_per_stock AS (
        //     SELECT release_items.id, check_out_id, stock_id, SUM(release_items.quantity) AS 'total_count' FROM release_items
        //     LEFT JOIN stocks ON release_items.stock_id = stocks.id
        //     GROUP BY stocks.toner_id
        // )

        \DB::statement("
            CREATE VIEW view_total_release_item_per_stock AS (
                SELECT release_items.id, check_out_id, stock_id, stocks.toner_id, SUM(release_items.quantity) AS 'total_count' FROM release_items
                LEFT JOIN stocks ON release_items.stock_id = stocks.id
                GROUP BY stocks.toner_id, check_out_id
            )
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement('DROP VIEW IF EXISTS view_total_release_item_per_stock');
    }
}
