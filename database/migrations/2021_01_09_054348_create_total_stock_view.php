<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalStockView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
        CREATE VIEW view_total_stock AS (
            SELECT toners.id, toners.model_name, toners.toner_type_id, toners.unit_id, toners.minimum_quantity, 
            IFNULL(s.total_per_toner, 0) AS 'total_qty_per_toner', 
            IFNULL(r.release_per_toner, 0) AS 'released_qty', 
            IFNULL(s.total_per_toner, 0) - IFNULL(r.release_per_toner, 0) As 'computed_remaining_qty'  FROM toners
        LEFT JOIN (
            SELECT stocks.*, toners.model_name, IFNULL(SUM(IFNULL(stocks.quantity, 0)), 0) AS 'total_per_toner', check_ins.id AS 'checkin_id', check_ins.status FROM stocks
            LEFT JOIN check_ins ON check_ins.id = stocks.check_in_id
            LEFT JOIN toners ON toners.id = stocks.toner_id
            WHERE check_ins.status = 1
            GROUP BY toners.id
        ) AS s ON s.toner_id = toners.id
        LEFT JOIN (
            SELECT stocks.id AS 'stock_id', stocks.toner_id, IFNULL(SUM(r.quantity), 0) as 'release_per_toner' FROM release_items r
            LEFT JOIN stocks ON stocks.id = r.stock_id
            LEFT JOIN check_outs ON check_outs.id = r.check_out_id
            LEFT JOIN toners ON toners.id = stocks.toner_id
            WHERE check_outs.status = 1
            GROUP BY toners.id
        ) AS r ON r.toner_id = toners.id  
        ORDER BY `toners`.`model_name` ASC
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
        \DB::statement("DROP VIEW IF EXISTS view_total_stock");
    }
}
