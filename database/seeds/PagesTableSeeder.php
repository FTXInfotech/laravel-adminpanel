<?php

use Carbon\Carbon;
use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;
use Illuminate\Support\Facades\DB;

class PagesTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate(config('access.pages_table'));

        $page = [
            [
                'title'       => 'Terms and conditions',
                'page_slug'   => 'terms-and-conditions',
                'description' => 'terms and conditions',
                'status'      => '1',
                'created_by'  => '1',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
        ];

        DB::table(config('access.pages_table'))->insert($page);

        $this->enableForeignKeys();
    }
}
