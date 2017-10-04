<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeletedAtFieldInTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->timestamp("deleted_at")->nullable();
        });
        Schema::table('permissions', function (Blueprint $table) {
            $table->timestamp("deleted_at")->nullable();
        });
        Schema::table('cms_pages', function (Blueprint $table) {
            $table->timestamp("deleted_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn("deleted_at");
        });
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn("deleted_at");
        });
        Schema::table('cms_pages', function (Blueprint $table) {
            $table->dropColumn("deleted_at");
        });
    }
}
