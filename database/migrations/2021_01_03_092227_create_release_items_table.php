<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReleaseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('release_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('check_out_id');
            $table->unsignedInteger('stock_id');
            $table->integer('quantity');
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
        Schema::dropIfExists('release_items');
    }
}
