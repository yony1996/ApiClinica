<?php

use Illuminate\Database\Seeder;
use App\Specialty;
class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties=[
            'Oftalmologia',
            'Cardiologia',
            'Pediatria',
            'Dermatologia'
        ];
        foreach ($specialties as $specialty) {
            Specialty::create([
                'name'=>$specialty
            ]);
        }
        
    }
}
