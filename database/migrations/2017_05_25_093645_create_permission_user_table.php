<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('access.permission_user_table'), function ($table) {
            $table->increments('id')->unsigned();
            $table->integer('permission_id')->unsigned();
            $table->integer('user_id')->unsigned();

            /**
             * Add Foreign/Unique/Index
             */
            $table->foreign('permission_id')
                ->references('id')
                ->on(config('access.permissions_table'))
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on(config('access.users_table'))
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(config('access.permission_user_table'), function (Blueprint $table) {
            $table->dropForeign(config('access.permission_user_table') . '_permission_id_foreign');
            $table->dropForeign(config('access.permission_user_table') . '_user_id_foreign');
        });

        Schema::drop(config('access.permission_user_table'));
    }
}
