<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('ticket_id');
            $table->string('name');
            $table->double('ticket_price');
            $table->double('quantity');
            $table->double('subtotal');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('ticket_id')->references('id')->on('tickets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details',function (Blueprint $table){
            $table->dropForeign('order_id');
            $table->dropForeign('ticket_id');
        });
        Schema::dropIfExists('order_details');
    }
};
