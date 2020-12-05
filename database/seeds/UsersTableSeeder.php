<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([

        'name' => 'Admin',
        'email' => 'Admin@gmail.com',
        'password' => bcrypt('Admin'), // secret
        'remember_token' => str_random(10),
        'cedula'=> '05054372',
        'addres'=>'',
        'phone'=>'',
        'role'=>'Admin',
            
        ]);
        factory(User::class, 50)->create();
    }
}
