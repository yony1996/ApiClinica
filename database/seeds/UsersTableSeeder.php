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
        'password' => bcrypt('root123'), // secret
        'remember_token' => str_random(10),
        'role'=>'Admin',
            
        ]);
        User::create([

            'name' => 'Paciente 1',
            'email' => 'Patient@gmail.com',
            'password' => bcrypt('root123'), // secret
            'remember_token' => str_random(10),
            'role'=>'patient',
                
            ]);
            User::create([

                'name' => 'Medico 1',
                'email' => 'Doctor@gmail.com',
                'password' => bcrypt('roo123'), // secret
                'remember_token' => str_random(10),
                'role'=>'doctor',
                    
                ]);
        factory(User::class, 50)->create();
    }
}
