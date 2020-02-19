<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Professor;

class ProfessorSeeder extends Seeder
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

        DB::table('professor')->insert([
            'id' => 1,
            'idUser' => 4,
            'ci' => '39486910',
            'name' => 'Ariel',
            'lastname' => 'Barco',
            'email' => 'Ariel@hotmail.com',
            'phone' => '132153',
            'address' => 'Por ahi choquito',
            'startDate' => $now,
            'career' => 'Redes',
            'turn' => 'Mañana'
        ]);
        DB::table('professor')->insert([
            'id' => 2,
            'idUser' => 5,
            'ci' => '159753258',
            'name' => 'Brenda',
            'lastname' => 'Flores',
            'email' => 'Brenda@hotmail.com',
            'phone' => '164815',
            'address' => 'Por ahi choquito',
            'startDate' => $now,
            'career' => 'Sistemas',
            'turn' => 'Tarde'
        ]);
    }
}
