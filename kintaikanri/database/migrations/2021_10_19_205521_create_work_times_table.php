<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_times', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->integer('start_time_h');
            $table->integer('start_time_m');
            $table->integer('end_time_h');
            $table->integer('end_time_m');
            $table->integer('rest_on_h');
            $table->integer('rest_on_m');
            $table->integer('rest_back_h');
            $table->integer('rest_back_m');
            $table->string('comment')->nullable()->default(null);
            $table->string('updated_id');
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
        Schema::dropIfExists('work_times');
    }
}
