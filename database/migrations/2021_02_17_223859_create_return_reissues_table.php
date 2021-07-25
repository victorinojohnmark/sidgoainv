<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnReissuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_reissues', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no')->nullable();
            $table->unsignedInteger('return_receive_id');
            $table->unsignedInteger('reissue_type_id');
            $table->date('delivery_date')->nullable();
            $table->boolean('status')->default(0);
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by')->nullable();
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
        Schema::dropIfExists('return_reissues');
    }
}
