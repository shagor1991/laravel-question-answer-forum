<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersQuestionsAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->delete();
        DB::table('questions')->delete();
        // DB::table('users')->delete();
        

        Factory(App\User::class,3)->create()->each(function($user){
            $user->questions()->saveMany(
                factory(App\Question::class,rand(1,5))->make()
            )->each(function($q){
                $q->answers()->saveMany(Factory(App\Answer::class,rand(1,5))->make());
            });
        });
    }
}
