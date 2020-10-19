<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 191)->unique();
            $table->string('display_name', 191);
            $table->smallInteger('sort')->unsigned()->default(0);
            $table->boolean('status')->default(1);
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 191)->unique();
            $table->boolean('all')->default(0);
            $table->smallInteger('sort')->unsigned()->default(0);
            $table->boolean('status')->default(1);
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('permission_id')->unsigned()->index('permission_role_permission_id_foreign');
            $table->bigInteger('role_id')->unsigned()->index('permission_role_role_id_foreign');
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->index('role_user_user_id_foreign');
            $table->bigInteger('role_id')->unsigned()->index('role_user_role_id_foreign');
        });

        Schema::create('permission_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('permission_id')->unsigned()->index('permission_user_permission_id_foreign');
            $table->bigInteger('user_id')->unsigned()->index('permission_user_user_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('permissions');
        Schema::drop('roles');
        Schema::drop('permission_role');
        Schema::drop('role_user');
        Schema::drop('permission_user');
    }
}
