<?php

use Database\DisableForeignKeys;
use Database\TruncateTable;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class EmailTemplateSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    /**
     * Run the database seeds.
     */
    public function run(Faker $faker)
    {
        $this->disableForeignKeys();
        $this->truncate('email_templates');

        $pages = [];

        for ($i = 0; $i < 50; $i++) {
            $title = $faker->sentence(4);

            $pages[] = [
                'title' => $title,
                'slug' => Str::slug($title),
                'content' => $faker->paragraph(),
                'status' => $faker->randomElement([0, 1]),
                'created_by' => $faker->randomElement([2, 1]),
                'created_at' => $faker->dateTimeBetween('-10 days', 'now'),
            ];
        }

        DB::table('email_templates')->insert($pages);

        $this->enableForeignKeys();
    }
}
