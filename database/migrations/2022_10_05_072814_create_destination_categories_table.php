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
        Schema::create('destination_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('destination_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('destination_id')->references('id')->on('destinations');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('destination_categories',function (Blueprint $table){
            $table->dropForeign('destination_id');
            $table->dropForeign('category_id');
        });
        Schema::dropIfExists('destination_categories');
    }
};
