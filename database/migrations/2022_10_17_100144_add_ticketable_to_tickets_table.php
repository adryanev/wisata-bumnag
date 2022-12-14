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
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropConstrainedForeignId('destination_id');
            $table->text('description')->nullable();
            $table->morphs('ticketable');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreignId('destination_id')->references('id')->on('destinations');
            $table->dropColumn('description');
            $table->dropMorphs('ticketable');
        });
    }
};
