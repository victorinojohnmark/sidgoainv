<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_outs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('location_id');
            $table->string('dr_no');
            $table->string('invoice_no')->nullable();
            $table->string('request_slip_no');
            $table->date('delivery_date')->nullable();
            $table->boolean('status')->default(0);
            $table->text('note')->nullable();
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('edited_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_outs');
    }
}
