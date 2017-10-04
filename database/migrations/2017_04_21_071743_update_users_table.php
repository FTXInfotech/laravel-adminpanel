<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('first_name')->after('id');
            $table->string('last_name')->after('first_name');
            $table->text('address')->after('password');
            $table->integer('country_id')->unsigned()->index()->after('address');
            $table->integer('state_id')->unsigned()->index()->after('country_id');
            $table->integer('city_id')->unsigned()->index()->after('state_id');
            $table->string('zip_code')->after('city_id');
            $table->string('ssn')->after('zip_code');
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
            $table->string('name')->after('id');
            $table->dropColumn('first_name')->after('id');
            $table->dropColumn('last_name')->after('first_name');
            $table->dropColumn('address')->after('password');
            $table->dropColumn('country_id')->unsigned()->index()->after('address');
            $table->dropColumn('state_id')->unsigned()->index()->after('country_id');
            $table->dropColumn('city_id')->unsigned()->index()->after('state_id');
            $table->dropColumn('zip_code')->after('city_id');
            $table->dropColumn('ssn')->after('zip_code');
        });
    }
}
