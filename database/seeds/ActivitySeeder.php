<?php

use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Activity::class, 20)->create()->each(
            function ($activity){
                \App\UserActivity::create(['activity' => $activity->id, 'user' => $activity->host, 'relation' => 'own']);
            }
        );
    }
}
