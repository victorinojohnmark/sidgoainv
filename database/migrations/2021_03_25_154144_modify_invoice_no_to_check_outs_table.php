<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyInvoiceNoToCheckOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('check_outs', function (Blueprint $table) {
            $table->string('invoice_no')->nullable()->change();
            $table->date('delivery_date')->nullable()->change();
            $table->string('delivery_by')->nullable()->change();
            $table->unsignedInteger('delivery_status_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('check_outs', function (Blueprint $table) {
            //
        });
    }
}
