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
        Schema::table('ad_banners', function (Blueprint $table) {
            $table->string('action')->nullable()->change();
            $table->string('target')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ad_banners', function (Blueprint $table) {
            $table->string('action')->change();
            $table->string('target')->change();
        });
    }
};
