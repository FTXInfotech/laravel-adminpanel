<?php

use Carbon\Carbon as Carbon;
use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CmsPagesTableSeeder extends Seeder
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
        $this->truncate(config('access.cms_pages_table'));

        $cmspage = [
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

        DB::table(config('access.cms_pages_table'))->insert($cmspage);

        $this->enableForeignKeys();
    }
}
