<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logo', 191)->nullable();
            $table->string('favicon', 191)->nullable();
            $table->string('seo_title', 191)->nullable();
            $table->text('seo_keyword', 65535)->nullable();
            $table->text('seo_description', 65535)->nullable();
            $table->string('company_contact', 191)->nullable();
            $table->text('company_address', 65535)->nullable();
            $table->string('from_name', 191)->nullable();
            $table->string('from_email', 191)->nullable();
            $table->string('facebook', 191)->nullable();
            $table->string('linkedin', 191)->nullable();
            $table->string('twitter', 191)->nullable();
            $table->string('google', 191)->nullable();
            $table->string('copyright_text', 191)->nullable();
            $table->string('footer_text', 191)->nullable();
            $table->text('terms', 65535)->nullable();
            $table->text('disclaimer', 65535)->nullable();
            $table->text('google_analytics', 65535)->nullable();
            $table->string('home_video1', 191)->nullable();
            $table->string('home_video2', 191)->nullable();
            $table->string('home_video3', 191)->nullable();
            $table->string('home_video4', 191)->nullable();
            $table->string('explanation1', 191)->nullable();
            $table->string('explanation2', 191)->nullable();
            $table->string('explanation3', 191)->nullable();
            $table->string('explanation4', 191)->nullable();
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
        Schema::drop('settings');
    }
}
