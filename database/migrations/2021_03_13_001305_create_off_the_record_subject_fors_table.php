<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffTheRecordSubjectForsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('off_the_record_subject_fors', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            // $table->timestamps();
        });

        DB::table('off_the_record_subject_fors')->insert(
            [
                ['value' => 'Repair'],
                ['value' => 'Replace'],
                ['value' => 'Return to stock'],
                ['value' => 'Return to supplier'],
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
        Schema::dropIfExists('off_the_record_subject_fors');
    }
}
