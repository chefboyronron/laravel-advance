<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'phone' => $faker->phoneNumber
    ];
});

/**
 * php artisan tinker
 * Company::all()->pluck('name') // display all company name
 * factory(\App\Company::class, 10)->create();
 */