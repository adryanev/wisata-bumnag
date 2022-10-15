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
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('destinations', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('ad_banners', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('destination_certifications', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('recommendations', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('tickets', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('order_details', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('ticket_settings', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('order_status_histories', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('category_closure', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('destination_categories', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('packages', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('package_categories', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('souvenirs', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('souvenir_categories', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('ad_banners', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('destination_certifications', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('recommendations', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('ticket_settings', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('order_status_histories', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('category_closure', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('destination_categories', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('packages', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('package_categories', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('souvenirs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('souvenir_categories', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
