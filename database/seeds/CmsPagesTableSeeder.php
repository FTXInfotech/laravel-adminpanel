<?php
use Carbon\Carbon as Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;


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
        $this->truncate(config("access.cms_pages_table"));
        
        $cmspage = [
            [
                'title'       => 'Terms and conditions',
                'page_slug'   => 'terms-and-conditions',
                'description' => 'terms and conditions',
                'status'      => '1',
                'created_by'  => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
         
         DB::table(config('access.cms_pages_table'))->insert($cmspage);
         
         $this->enableForeignKeys();
    }
}
