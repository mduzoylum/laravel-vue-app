<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Jenssegers\Mongodb\Auth\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        User::create([
//            'id' => 1,
//            'name' => 'Mehmet Duzoylum',
//            'email' => 'duzoylummehmet@gmail.com'
//        ]);

        $faker = Factory::create('tr_TR');
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'id' => $i++,
                'name' => $faker->name,
                'email' => $faker->email(),
            ]);
        }

    }
}
