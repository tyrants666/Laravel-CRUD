<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [ 
                'name' => 'Akash Yadav',
                'email' => 'akashyadav.iiita@gmail.com',
                'password' => bcrypt('qwerty'),
            ],[
                'name' => 'Saurav Jha',
                'email' => 'jhasaurav.iiita@gmail.com',
                'password' => bcrypt('bbbbbbbb')
            ]
        ]);
    }
}
