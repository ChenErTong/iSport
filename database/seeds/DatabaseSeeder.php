<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(UserSeeder::class);
        $this->call(RecordSeeder::class);
//        $this->call(ActivitySeeder::class);
//        $this->call(UserActivitySeeder::class);
//            $this->call(FollowSeeder::class);
//        $this->call(MomentSeeder::class);
    }
}
