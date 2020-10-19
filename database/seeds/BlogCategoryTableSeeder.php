<?php

use App\Models\Auth\User;
use App\Models\BlogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BlogCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        if (! \App::environment(['production'])) {
            Model::unguard();

            factory(BlogCategory::class, 10)->create([
                'created_by' => factory(User::class)->state('active')->create()->id,
            ]);

            Model::reguard();
        }
    }
}
