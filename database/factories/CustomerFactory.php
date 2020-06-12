<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use App\Models\Company;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'mobile'=>$faker->randomNumber($nbDigits = NULL, $strict = false),
        'email'=>$faker->unique()->safeEmail,
        'about'=>$faker->text,
        'company_id'=>factory(Company::class),
        'active'=>rand(0,1)
    ];
});
