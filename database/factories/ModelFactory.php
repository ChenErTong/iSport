<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $interest = ['Run', 'Swimming', 'Basketball', 'Volleyball', 'Soccer', 'PingPong', 'Badminton', 'Fitness'];

    return [
        'name' => $faker->unique()->userName,
        'email' => $faker->unique()->safeEmail,
        'address' => $faker->address,
        'preference' => implode(',', $faker->randomElements($interest, 3)),
        'password' => bcrypt('123456'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Activity::class, function (Faker\Generator $faker) {
    static $interest = ['Run', 'Swimming', 'Basketball', 'Volleyball', 'Soccer', 'PingPong', 'Badminton', 'Fitness'];

    $user_id = DB::table('users')->select('name')->inRandomOrder()->first();
    $city = $faker->city;
    $room = $faker->numberBetween(1, 200);
    return [
        'name' => $city.' '.$faker->randomElement($interest).' Contest',
        'location' => $faker->streetAddress.', '.$city,
        'date' => $faker->dateTimeBetween('now', '+30 days'),
        'info' => $faker->paragraphs(4, true),
        'room' => $room,
        'remain' => $room,
        'host' => $user_id->name,
    ];
});

$factory->define(App\UserActivity::class, function (Faker\Generator $faker) {
    $user = DB::table('users')->select('name')->inRandomOrder()->first()->name;
    $activity = \App\Activity::select('id')
        ->where('host', '<>', '"'.$user.'"')
        ->where('remain', '>', 0)
        ->whereRaw('"id" not in (select "activity" from "user_activities" where "user" = "'.$user.'")')
        ->inRandomOrder()
        ->first()->id;
    App\Activity::where('id', $activity)->decrement('remain');
    return [
        'relation' => 'participate',
        'activity' => $activity,
        'user' => $user,
    ];
});

$factory->define(App\Follow::class, function (Faker\Generator $faker) {
    $user_ids = DB::table('users')->select('name')->inRandomOrder()->take(2)->get();

    return [
        'follower' => $user_ids[0]->name,
        'following' => $user_ids[1]->name,
    ];
});

$factory->define(App\Moment::class, function (Faker\Generator $faker) {
    $user_id = DB::table('users')->select('name')->inRandomOrder()->first();

    return [
        'content' => $faker->sentences(3, true),
        'host' => $user_id->name,
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    $user_id = DB::table('users')->select('name')->inRandomOrder()->first();

    return [
        'content' => $faker->sentences(3, true),
        'host' => $user_id->name,
    ];
});

$factory->define(App\Record::class, function (Faker\Generator $faker) {
    return [
        'started_at' => $faker->dateTimeBetween('-30 days', 'now'),
        'duration' => $faker->numberBetween(10, 600),
    ];
});