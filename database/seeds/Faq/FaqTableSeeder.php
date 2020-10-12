<?php

use Database\TruncateTable;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;

class FaqTableSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    /**
     * Run the database seeds.
     */
    public function run(Faker $faker)
    {
        $this->disableForeignKeys();
        $this->truncate('faqs');

        $faqs = [];

        for ($i = 0; $i < 50; $i++) {
            $title = $faker->sentence(4);

            $faqs[] = [
                'question' => $faker->sentence(),
                'answer' => $faker->paragraph(),
                'status' => $faker->randomElement([0, 1]),
                'created_at' => $faker->dateTimeBetween('-10 days', 'now'),
            ];
        }

        DB::table('faqs')->insert($faqs);

        $this->enableForeignKeys();
    }
}
