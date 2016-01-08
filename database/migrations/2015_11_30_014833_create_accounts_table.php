<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("accounts",function(Blueprint $table){
            $table->increments("id");
            $table->integer("merchant_id")->unsigned()->default(0);
            $table->integer("busstop_id")->unsigned()->default(0);
            $table->string("account_id")->unique();
            $table->decimal("balance",10,2);
            $table->boolean("status");
            $table->boolean("view");
            $table->foreign("merchant_id")->references("id")->on("merchants")->onDelete("cascade");
            $table->foreign("busstop_id")->references("id")->on("busstops")->onDelete("cascade");
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
    }
}
