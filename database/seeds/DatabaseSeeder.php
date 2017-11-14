<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(PowerUpsSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(WeaponTableSeeder::class);
        $this->call(ArmorTableSeeder::class);
        $this->call(CharacterClassSeeder::class);

        Model::reguard();
    }
}
