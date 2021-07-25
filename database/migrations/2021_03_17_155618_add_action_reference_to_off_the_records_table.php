<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActionReferenceToOffTheRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('off_the_records', function (Blueprint $table) {
            $table->string('action_reference')->nullable()->after('off_the_record_action_taken_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('off_the_records', function (Blueprint $table) {
            $table->dropColumn('action_reference');
        });
    }
}
