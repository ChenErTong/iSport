<?php

use Illuminate\Database\Seeder;

class RecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::all();
        foreach ($users as $user){
            foreach (explode(',', $user->preference) as $interest){
                factory(App\Record::class, random_int(3, 7))->create(['host'=>$user->name, 'sport'=>$interest]);
            }
        }
    }
}
