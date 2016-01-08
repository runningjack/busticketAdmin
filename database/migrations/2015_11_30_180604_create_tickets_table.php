<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        //
        Schema::create("ticket_stacks",function(Blueprint $table){
            $table->increments("id");
            $table->string("batch_code");
            $table->timestamps();
        });

        Schema::create("tickets",function(Blueprint $table){
            $table->increments("id");
            $table->string("code")->unique();
            $table->string("serial_no")->unique();
            $table->integer("terminal_id")->unsigned()->default(0);
            $table->integer("route_id")->unsigned()->default(0);
            $table->integer("stack_id")->unsigned()->default(0);
            $table->foreign("stack_id")->references("id")->on("ticket_stacks")->onDelete("cascade");
            $table->foreign("terminal_id")->references("id")->on("busstops")->onDelete("cascade");
            $table->foreign("route_id")->references("id")->on("routes")->onDelete("cascade");
            $table->tinyInteger("ticket_type");
            $table->decimal("amount",5,2);
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
