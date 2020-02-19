<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Diplomat;

class DiplomatSeeder extends Seeder
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
        DB::table('diplomat')->insert([
            'id' => '1',
            'name' => 'Diplomado para aviones',
            'version' => '1',
            'startDate' => $now
        ]);
        DB::table('diplomat')->insert([
            'id' => '2',
            'name' => 'Diplomado para autos',
            'version' => '1',
            'startDate' => $now
        ]);
    }
}
