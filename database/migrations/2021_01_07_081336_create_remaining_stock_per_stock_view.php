<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemainingStockPerStockView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
        CREATE VIEW view_remaining_stock_per_stock AS (
            SELECT 
                stocks.id, 
                check_in_id, 
                toner_id, 
                stocks.quantity, 
                IFNULL(SUM(release_items.quantity), 0) AS 'release_quantity', 
                stocks.quantity - IFNULL(SUM(release_items.quantity), 0) AS 'remaining_stock',
                IFNULL(check_outs.status, 0) as 'status'
            FROM 
                stocks
            LEFT JOIN release_items ON release_items.stock_id = stocks.id
            LEFT JOIN check_ins ON check_ins.id = stocks.check_in_id
            LEFT JOIN check_outs ON check_outs.id = release_items.check_out_id
            WHERE check_ins.status = 1 
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
        \DB::statement("DROP VIEW IF EXISTS view_remaining_stock_per_stock");
    }
}
