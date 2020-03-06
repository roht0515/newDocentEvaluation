<?php

use App\Question;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProfessorSeeder::class);
        $this->call(StudentSeeder::class);
        //$this->call(EvaluationSeeder::class);
        //$this->call(DiplomatSeeder::class);
        // $this->call(CategoriesSeeder::class);
        //$this->call(QuestionSeeder::class);
    }
}
