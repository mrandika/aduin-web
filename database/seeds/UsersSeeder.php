<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $data = [];

        // for ($q = 1; $q <= 2; $q++) { 
            //     $handler = new User;

            //     $handler->username = $faker->userName;
            //     $handler->first_name = $faker->firstName;
            //     $handler->last_name = $faker->lastName;
            //     $handler->photo_url = url('assets/img/avatar/avatar-3.png');
            //     $handler->email = $faker->email;
            //     $handler->password = bcrypt('petugasinstansipemprov');
            //     $handler->role = '2';
            //     $handler->status = 1;

            //     $handler->save();
            // }

        // Pemprov
        for ($i = 1; $i <= 34; $i++) {
            $admin = new User;

            $admin->username = $faker->userName;
            $admin->first_name = $faker->firstName;
            $admin->last_name = $faker->lastName;
            $admin->photo_url = url('assets/img/avatar/avatar-1.png');
            $admin->email = $faker->email;
            $admin->password = bcrypt('operatorinstansipemprov');
            $admin->role = '3';
            $admin->status = 1;

            $admin->save();
        }

        // Pemprov unit
        for ($i = 1; $i <= 34; $i++) {
            $admin = new User;

            $admin->username = $faker->userName;
            $admin->first_name = $faker->firstName;
            $admin->last_name = $faker->lastName;
            $admin->photo_url = url('assets/img/avatar/avatar-2.png');
            $admin->email = $faker->email;
            $admin->password = bcrypt('operatorunitinstansipemprov');
            $admin->role = '3';
            $admin->status = 1;

            $admin->save();
        }
    }
}
