<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        //
        Schema::create("drivers",function(Blueprint $table){
            $table->increments("id");
            $table->string("firstname");
            $table->string("lastname");
            $table->string("licence_code");
            $table->dateTime("issue_date");
            $table->dateTime("expiry_date");
            $table->string("address");
            $table->string("city");
            $table->string("state");
            $table->string("country");
            $table->string("phone")->unique();
            $table->string("email")->unique();
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
        Schema::drop("drivers");
    }
}
