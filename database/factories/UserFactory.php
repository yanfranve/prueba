<?php



use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('password'), // Cambia 'password' por la contraseña que deseas
        'remember_token' => Str::random(10),
    ];
});

