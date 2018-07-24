<?php

use App\Models\Access\User\User;
use App\Models\Blogs\Blog;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    $status = [
        'Published',
        'Draft',
        'InActive',
        'Scheduled',
    ];

    return [
        'name'             => $faker->sentence,
        'publish_datetime' => $faker->dateTime(),
        'featured_image'   => 'logo.png',
        'content'          => $faker->paragraph(3),
        'status'           => $status[$faker->numberBetween(0, 3)],
        'created_by'       => function () {
            return factory(User::class)->create()->id;
        },
    ];
});
