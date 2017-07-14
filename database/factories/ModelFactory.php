<?php

use App\Utils\Definitions;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
*/

/**
 * User Object factory model, generates default values for quickly testing the DB.
 */
$factory->define(App\Models\User::class, function ($faker) {
    return [
        'fbID' => int_random(10),
        'userHash' => md5(str_random(10)),
        'name' => $faker->name,
        'email' => $faker->email,
        'userType' => Definitions::USER_TYPE_MEMBER,
        'enabled' => true
    ];
});


