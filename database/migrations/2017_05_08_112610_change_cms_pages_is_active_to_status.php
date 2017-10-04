<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCmsPagesIsActiveToStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cms_pages', function (Blueprint $table) {
            $table->tinyInteger('status')->default(1)->unsigned()
                ->after("seo_description");
            $table->dropColumn('is_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cms_pages', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->enum('is_active', ['Active', 'Inactive'])
                ->after("seo_description");
        });
    }
}
