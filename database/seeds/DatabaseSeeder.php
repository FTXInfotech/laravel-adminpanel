<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DatabaseSeeder.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(AccessTableSeeder::class);
        $this->call(HistoryTypeTableSeeder::class);
        $this->call(EmailTemplateTypeTableSeeder::class);
        $this->call(EmailTemplatePlaceholderTableSeeder::class);
        $this->call(EmailTemplateTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(StateTableSeeder::class);
        $this->call(CmsPagesTableSeeder::class);
        $this->call(ModulesTableSeeder::class);
        $this->call(MenuTableSeeder::class);

        Model::reguard();
    }
}
