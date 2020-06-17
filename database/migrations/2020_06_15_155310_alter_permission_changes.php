<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPermissionChanges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->string('guard_name')->nullable()->change();
            $table->string('display_name')->unique()->nullable();
            $table->smallInteger('sort')->unsigned()->default(0);
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
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
        Schema::table('permissions', function(Blueprint $table) {
            $table->dropColumn('sort');
            $table->dropColumn('display_name');
            $table->dropColumn('status');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('deleted_at');
        });
    }
}
