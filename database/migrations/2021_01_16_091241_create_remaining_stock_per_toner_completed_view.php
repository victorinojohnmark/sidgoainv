<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemainingStockPerTonerCompletedView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
            CREATE VIEW view_remaining_stock_per_toner_completed AS(
                SELECT stocks.id, stocks.check_in_id, stocks.toner_id, stocks.quantity, IFNULL(r.total_release, 0) AS 'total_release', stocks.quantity - SUM(IFNULL(r.total_release, 0)) AS 'remaining_stock' FROM stocks
                LEFT JOIN (
                    SELECT r.id, r.stock_id, SUM(r.quantity) AS 'total_release' FROM release_items r
                    LEFT JOIN check_outs ON r.check_out_id = check_outs.id
                    WHERE check_outs.status = 1
                    GROUP BY r.id
                ) AS r ON r.stock_id = stocks.id
                GROUP BY stocks.id
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
        \DB::statement("DROP VIEW IF EXISTS view_remaining_stock_per_toner_completed");
    }
}
