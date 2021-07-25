<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffTheRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('off_the_records', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no')->nullable();
            $table->unsignedInteger('off_the_record_transaction_type_id');
            $table->date('transaction_date');
            $table->string('transaction_reference')->nullable();
            $table->unsignedInteger('location_id');
            $table->unsignedInteger('off_the_record_issue_description_id');
            $table->unsignedInteger('off_the_record_subject_for_id');
            $table->unsignedInteger('off_the_record_action_taken_id');
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('off_the_records');
    }
}
