<?php

use Database\TruncateTable;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;

class PagesTableSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    /**
     * Run the database seeds.
     */
    public function run(Faker $faker)
    {
        $this->disableForeignKeys();
        $this->truncate('pages');

        $pages = [];

        for ($i = 0; $i < 50; $i++) {
            $title = $faker->sentence(4);

            $pages[] = [
                'title' => $title,
                'page_slug' => Str::slug($title),
                'description' => $faker->paragraph(),
                'cannonical_link' => $faker->word(),
                'seo_title' => $faker->word(),
                'status' => $faker->randomElement([0, 1]),
                'created_by' => $faker->randomElement([2, 1]),
                'created_at' => $faker->dateTimeBetween('-10 days', 'now'),
            ];
        }

        DB::table('pages')->insert($pages);

        $this->enableForeignKeys();
    }
}
