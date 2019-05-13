<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Models\Cita::class, function (Faker $faker) {
    return [
        'recipient_id' => function () {
            return factory(User::class)->create();
        },
        'sender_id' => function () {
            return factory(User::class)->create();
        }
    ];
});
