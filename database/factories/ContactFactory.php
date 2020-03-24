<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use App\User;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    static $seed =0;
    $faker->seed($seed++);
    return [
      'user_id'=>factory(User::class),
      'name'=>$faker->name,
      'email'=>$faker->email,
      'birthday'=>'05/08/1993',
      'company'=>$faker->company,
    ];
});
