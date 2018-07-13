<?php

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailTemplateTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::table(config('module.email_templates.types_table'))->truncate();
        }

        $data = [
            [
                'name'       => 'Registration',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name'       => 'Create User',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name'       => 'Acivate / Deactivate User',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name'       => 'Change Password',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table(config('module.email_templates.types_table'))->insert($data);
    }
}
