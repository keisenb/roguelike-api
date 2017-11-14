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
        $this->command->info('Creating 100 sample users...');
        $faker = Faker::create();
        foreach (range(1,100) as $index) {
            $user = new User;
            $user->email = $faker->unique()->email;
            $user->display_name = $faker->userName;
            $user->password = bcrypt('password');
            $user->save();
        }
    }
}
