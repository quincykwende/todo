<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Task;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Task::class, function (Faker $faker) {
    return [
    	'text' => $faker->realText(30),
        'is_completed' => rand(0, 1),
        'user_id' => function () {
        	if (rand(0, 1) == 1 && App\Models\User::count() > 0) {
				return App\Models\User::inRandomOrder()->first()->id;
			} else {
				return factory(App\Models\User::class)->create()->id;
			}
        }
    ];
});
