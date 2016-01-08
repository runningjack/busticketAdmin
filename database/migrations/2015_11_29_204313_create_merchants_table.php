<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("merchants",function(Blueprint $table){
            $table->increments("id");
            $table->string("c_fname");
            $table->string("c_lname");
            $table->string("company");
            $table->string("address");
            $table->string("city");
            $table->string("state");
            $table->string("phone");
            $table->string("email");
            $table->string("web_url");
            $table->boolean("status");
            $table->boolean("view");
            $table->decimal("balance",10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        //
    }
}
