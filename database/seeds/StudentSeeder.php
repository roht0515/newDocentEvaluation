<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $now = new DateTime();

        DB::table('student')->insert([
            'id' => 1,
            'idUser' => 6,
            'ci' => 9352017,
            'name' => 'Oliver',
            'lastname' => 'Ledezma',
            'email' => 'Oliver@hotmail.com',
            'phone' => '12345678',
            'address' => 'Mi casita',
            'registrationDate' => $now,
            'career' => 'Redes',
            'turn' => 'Mañana',
        ]);
        DB::table('student')->insert([
            'id' => 2,
            'idUser' => 7,
            'ci' => 159753258,
            'name' => 'Alisson',
            'lastname' => 'Villarroel',
            'email' => 'Alisson@hotmail.com',
            'phone' => '159753258',
            'address' => 'Mi casita por ahi',
            'registrationDate' => $now,
            'career' => 'Sistemas',
            'turn' => 'Tarde',
        ]);
    }
}
