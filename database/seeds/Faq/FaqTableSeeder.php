<?php

use App\Models\Faq;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class FaqTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        if (! \App::environment(['production'])) {
            Model::unguard();

            factory(Faq::class, 10)->create();

            Model::reguard();
        }
    }
}
