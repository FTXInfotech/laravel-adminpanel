<?php

use App\Models\Faq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

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
