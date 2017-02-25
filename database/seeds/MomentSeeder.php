<?php

use Illuminate\Database\Seeder;

class MomentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Moment::class, 100)->create()->each(
            function ($moment){
                factory(App\Comment::class, random_int(1, 3))->create(['moment' => $moment->id]);
            }
        );
    }
}
