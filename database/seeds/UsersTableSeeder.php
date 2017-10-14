<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        //
        for($i = 1; $i <= 10;$i++)
        {
            DB::table('Users')->insert(
                [
                    'name' => 'User_'.$i,
                    'email' => 'user_'.$i.'@mymail.com',
                    'password' => bcrypt('123456'),
                    'quyen'=> 0,
                    'created_at' => new DateTime(),
                ]
            );
        }
    }
}
