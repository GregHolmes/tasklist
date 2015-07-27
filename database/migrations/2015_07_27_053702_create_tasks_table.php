<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id', true);
            $table->string('task', 50);
            $table->dateTime('expiry');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->integer('active');

            $table->unique('id');
            $table->index('id');
            $table->index(['active', 'expiry']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tasks');
    }
}
