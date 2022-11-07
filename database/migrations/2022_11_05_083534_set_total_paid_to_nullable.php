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
        Schema::table('payments', function (Blueprint $table) {
            $table->double('total_paid')->nullable()->change();
            $table->string('payment_method')->nullable()->change();
            $table->text('payment_payload')->nullable()->change();
            $table->string('payment_token')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->double('total_paid')->change();
            $table->string('payment_method')->change();
            $table->string('payment_payload')->change();
            $table->string('payment_token')->change();
        });
    }
};
