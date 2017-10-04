<?php

use Database\TruncateTable;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;
use Illuminate\Support\Facades\DB;

/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate(config('access.users_table'));

        //Add the master administrator, user id of 1
        $users = [
            [
                'first_name'        => 'Admin Istrator',
                'last_name'         => 'Admin Istrator',
                'address'           => 'Admin Istrator',
                'ssn'               => 'Admin Istrator',
                'city_id'           => '2',
                'state_id'          => '1',
                'country_id'        => '1',
                'zip_code'          => '1123',
                'email'             => 'admin@admin.com',
                'password'          => bcrypt('1234'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'created_by'        => 1,
                'updated_by'        => null,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
                'deleted_at'        => null,
            ],
            [
                'first_name'        => 'Backend User',
                'last_name'         => 'Admin Istrator',
                'address'           => 'Admin Istrator',
                'ssn'               => 'Admin Istrator',
                'city_id'           => '2',
                'state_id'          => '1',
                'country_id'        => '1',
                'zip_code'          => '1123',
                'email'             => 'executive@executive.com',
                'password'          => bcrypt('1234'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'created_by'        => 1,
                'updated_by'        => null,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
                'deleted_at'        => null,
            ],
            [
                'first_name'        => 'Default User',
                'last_name'         => 'Admin Istrator',
                'address'           => 'Admin Istrator',
                'ssn'               => 'Admin Istrator',
                'city_id'           => '2',
                'state_id'          => '1',
                'country_id'        => '1',
                'zip_code'          => '1123',
                'email'             => 'user@user.com',
                'password'          => bcrypt('1234'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed'         => true,
                'created_by'        => 1,
                'updated_by'        => null,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
                'deleted_at'        => null,
            ],
        ];

        DB::table(config('access.users_table'))->insert($users);

        $this->enableForeignKeys();
    }
}
