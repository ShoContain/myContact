<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use App\Comments;
use Faker\Generator as Faker;

$factory->define(Comments::class, function (Faker $faker) {
    return [
      'message_id'=>factory(App\Message::class),
      'comment'=>$faker->realText(10),
      'body'=>$faker->realText(20),
    ];
});
