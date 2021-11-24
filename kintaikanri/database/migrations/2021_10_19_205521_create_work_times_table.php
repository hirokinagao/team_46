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
            $table->date('date');
            $table->time('start_time')->nullable()->default(null);
            $table->time('end_time')->nullable()->default(null);
            $table->time('rest_on')->nullable()->default(null);
            $table->time('rest_back')->nullable()->default(null);
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
