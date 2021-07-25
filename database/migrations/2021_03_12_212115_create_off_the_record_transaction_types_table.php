<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffTheRecordTransactionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('off_the_record_transaction_types', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            // $table->timestamps();
        });

        DB::table('off_the_record_transaction_types')->insert(
            [
                ['value' => 'Return'],
                ['value' => 'Checkin'],
                ['value' => 'Checkout']
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('off_the_record_transaction_types');
    }
}
