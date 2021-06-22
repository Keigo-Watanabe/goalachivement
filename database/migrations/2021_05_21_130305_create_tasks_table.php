<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id('task_id');
            $table->string('content', 100);
            $table->integer('user_id');
            $table->integer('goal_id');
            $table->integer('task_category_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('priority');
            $table->integer('severity');
            $table->string('memo', 500);
            $table->boolean('complete');
            $table->softDeletes();
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
        Schema::dropIfExists('tasks');
    }
}
