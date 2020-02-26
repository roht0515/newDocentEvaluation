<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
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
        DB::table('category')->insert([
            'name' => 'Puntualidad',
            'year' => $now
        ]);
        DB::table('category')->insert([
            'name' => 'Enseñanza',
            'year' => $now
        ]);
        DB::table('category')->insert([
            'name' => 'Informacion',
            'year' => $now
        ]);
    }
}
