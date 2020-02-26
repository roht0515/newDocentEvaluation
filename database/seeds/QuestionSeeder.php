<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //categoria uno es puntualidad
        DB::table('question')->insert([
            'idCategory' => 1,
            'text' => '¿Es puntual?'
        ]);
        DB::table('question')->insert([
            'idCategory' => 1,
            'text' => '¿Respeta el horario?'
        ]);
        //categoria dos es Enseñanza
        DB::table('question')->insert([
            'idCategory' => 2,
            'text' => '¿Explica los temas?'
        ]);
        DB::table('question')->insert([
            'idCategory' => 2,
            'text' => '¿Tiene conocimientos sobre los temas?'
        ]);
        //categoria 3 es informacion
        DB::table('question')->insert([
            'idCategory' => 3,
            'text' => 'Informa sobre alguna inconveniencia sobre la clase'
        ]);
        DB::table('question')->insert([
            'idCategory' => 3,
            'text' => 'Informa sobre algun cambio'
        ]);
    }
}
