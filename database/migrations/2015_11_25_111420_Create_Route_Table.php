<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('routes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('short_name')->unique();
            $table->string('name')->unique();
            $table->string('description');
            $table->string('distance');
            $table->string('no_of_busstop',5);
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
        //
        Schema::drop('routes');
    }
}
