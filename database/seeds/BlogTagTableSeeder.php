<?php

use App\Models\BlogTag;
use App\Models\Auth\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BlogTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        if (! \App::environment(['production'])) {
            Model::unguard();

            factory(BlogTag::class, 10)->create([
                'created_by' => factory(User::class)->state('active')->create()->id,
            ]);

            Model::reguard();
        }
    }
}
