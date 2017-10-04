<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableToBlogFields extends Migration
{
    /**
     * Solution of enum data type.
     */
    public function __construct()
    {
        DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
    }
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn("domain_id");
            $table->string('meta_title')->nullable()->change();
            $table->string('cannonical_link')->nullable()->change();
            $table->string('slug')->nullable()->change();
            $table->text('meta_description')->nullable()->change();
            $table->text('meta_keywords')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->integer("domain_id")->unsigned()->index()->after("featured_image");
            $table->string('meta_title')->change();
            $table->string('cannonical_link')->change();
            $table->string('slug')->change();
            $table->text('meta_description')->change();
            $table->text('meta_keywords')->change();
        });
    }
}
