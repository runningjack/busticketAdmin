<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusstopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("busstops", function(Blueprint $table){
            $table->increments("id");
            $table->string("short_name")->unique();
            $table->integer("route_id")->unsigned()->default(0);
            $table->string("name")->unique();
            $table->string("description");
            $table->string("geodata");
            $table->string("distance");
            $table->foreign("route_id")->references("id")->on("routes")->onDelete("cascade");
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
        Schema::drop("busstops");
    }
}
