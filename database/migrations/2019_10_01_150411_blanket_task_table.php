<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BlanketTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blanket_task', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('blanket_id');
            $table->unsignedBigInteger('task_id');

            $table->foreign('blanket_id')->references('id')->on('blankets')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
