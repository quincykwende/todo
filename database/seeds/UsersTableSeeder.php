<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*factory(App\Models\User::class, 50)->create()->each(function ($user) {
        	$user->tasks()->save(factory(App\Models\Post::class)->make());
    	});*/
    }
}
