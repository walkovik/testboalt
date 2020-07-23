<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserNotification;
use Faker\Generator as Faker;
use App\User;


$factory->define(UserNotification::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->text(150),
        'is_read' => false,
        'user_id' => function () {
            return factory(User::class)->create()->id;
        }
    ];
});
