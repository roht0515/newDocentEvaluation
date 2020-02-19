<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Diplomat;

class EvaluationSeeder extends Seeder
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
        DB::table('evaluation')->insert([
            'id' => '1',
            'name' => 'Evaluacion Aviones',
            'version' => '1',
            'startDate' => $now,
            'endDate' => $now
        ]);
        DB::table('evaluation')->insert([
            'id' => '2',
            'name' => 'Evaluacion Autos',
            'version' => '1',
            'startDate' => $now,
            'endDate' => $now
        ]);
    }
}
