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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->unsignedBigInteger('order_id');
            $table->integer('payment_status');
            $table->timestamp('payment_create_date');
            $table->timestamp('payment_update_date');
            $table->double('total_paid');
            $table->double('total');
            $table->string('payment_method');
            $table->text('payment_payload');
            $table->string('payment_token');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
