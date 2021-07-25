<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemainingStockPerTonerView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
        CREATE VIEW view_remaining_stock_per_toner AS (
            SELECT
                check_ins.id AS 'check_in_id',
                stocks.id AS 'stock_id',
                toners.id AS 'toner_id',
                stocks.quantity AS 'stock_quantity',
                SUM(IFNULL(release_items.quantity, 0)) AS 'released_quantity',
                stocks.quantity - SUM(IFNULL(release_items.quantity, 0)) AS 'remaining_stock'
            FROM
                stocks
            LEFT JOIN (
				SELECT release_items.* FROM release_items
    			LEFT JOIN check_outs ON check_outs.id = release_items.check_out_id
                WHERE check_outs.void_status = 0
			) release_items ON release_items.stock_id = stocks.id
            LEFT JOIN toners ON stocks.toner_id = toners.id
            LEFT JOIN check_ins ON stocks.check_in_id = check_ins.id
            WHERE
                check_ins.status = 1
            GROUP BY
                stocks.id
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
        \DB::statement('DROP VIEW IF EXISTS view_remaining_stock_per_toner');
    }

}
