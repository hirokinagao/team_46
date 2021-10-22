<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class work_times extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_times', function (Blueprint $table) {
            $table->increments('id','10')->index();
            $table->varchar('user_id','10')->primary()->index();
            $table->int('start_time_h','2');
            $table->int('start_time_m','2');
            $table->int('end_time_h','2');
            $table->int('end_time_m','2');
            $table->int('rest_on_h','2');
            $table->int('rest_on_m','2');
            $table->int('rest_back_h','2');
            $table->int('rest_back_m','2');
            $table->varchar('coment','30')->nullable()->index();
            $table->datatime('created_at');
            $table->datatime('updated_at');
            $table->varchar('updated_id','10');
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
