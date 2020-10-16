<?php

use App\Models\Auth\User;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class BlogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        if (! \App::environment(['production'])) {
            Model::unguard();

            factory(Blog::class, 10)->create([
                'created_by' => factory(User::class)->state('active')->create()->id,
            ])->each(function ($blog) {
                $blogCategory = factory(BlogCategory::class)->create([
                    'created_by' => $blog->created_by,
                ]);

                $blog->categories()->sync([$blogCategory->id]);

                $blogTag = factory(BlogTag::class)->create([
                    'created_by' => $blog->created_by,
                ]);

                $blog->tags()->sync([$blogTag->id]);
            });

            Model::reguard();
        }
    }
}
