<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $this->command->info('Creating 100 sample users...');

        //generate 1 user to use
        $user = new User;
        $user->email = "test@test.com";
        $user->display_name = "test";
        $user->password = app('hash')->make('password');//bcrypt('password');
        $user->save();

        $faker = Faker::create();
        foreach (range(1,99) as $index) {
            $user = new User;
            $user->email = $faker->unique()->email;
            $user->display_name = $faker->userName;
            $user->password = app('hash')->make('password');//bcrypt('password');
            $user->save();
        }
    }
}
