<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('seo_keyword')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('company_contact')->nullable();
            $table->text('company_address')->nullable();
            $table->string('from_name')->nullable();
            $table->string('from_email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->string('google')->nullable();
            $table->string('copyright_text')->nullable();
            $table->string('footer_text')->nullable();
            $table->text('terms')->nullable();
            $table->text('disclaimer')->nullable();
            $table->text('google_analytics')->nullable();
            $table->string('home_video1')->nullable();
            $table->string('home_video2')->nullable();
            $table->string('home_video3')->nullable();
            $table->string('home_video4')->nullable();
            $table->string('explanation1')->nullable();
            $table->string('explanation2')->nullable();
            $table->string('explanation3')->nullable();
            $table->string('explanation4')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
