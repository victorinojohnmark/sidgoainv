<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffTheRecordIssueDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('off_the_record_issue_descriptions', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            // $table->timestamps();
        });

        DB::table('off_the_record_issue_descriptions')->insert(
            [
                ['value' => 'Swap Model'],
                ['value' => 'Incorrect Model'],
                ['value' => 'Faulty']
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
        Schema::dropIfExists('off_the_record_issue_descriptions');
    }
}
