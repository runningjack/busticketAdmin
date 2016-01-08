<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("buses", function(Blueprint $table){
            $table->increments("id");
            $table->string("model");
            $table->string("name");
            $table->string("plate_no")->unique();
            $table->string("chases_no")->unique();
            $table->string("bus_color");
            $table->integer("route_id")->unsigned()->default(0);
            $table->integer("number_of_sitters");
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
        Schema::drop("buses");
    }
}
