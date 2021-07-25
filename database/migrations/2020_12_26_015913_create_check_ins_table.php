<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_ins', function (Blueprint $table) {
            $table->id();
            $table->string('toner_code');
            $table->string('invoice_no');
            $table->string('or_no');
            $table->decimal('purchased_cost', $precision = 9, $scale = 2);
            $table->date('purchased_date');
            $table->unsignedInteger('supplier_id');
            $table->boolean('status')->default(0);
            $table->string('note')->nullable();
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
        Schema::dropIfExists('check_ins');
    }
}
