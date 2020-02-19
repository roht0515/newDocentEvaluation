<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder
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

        DB::table('users')->insert([
            'id' => 1,
            'username' => 'Admnistrador',
            'password' => 'Administrador',
            'role' => 'Administrador',
            'email' => 'Administrador@hotmail.com',
            'email_verified_at' => $now
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'username' => 'AdmnistradorSecretaria',
            'password' => 'AdministradorSecretaria',
            'role' => 'Administrado Secretariar',
            'email' => 'AdministradorSecretaria@hotmail.com',
            'email_verified_at' => $now
        ]);
        DB::table('users')->insert([
            'id' => 3,
            'username' => 'AdmnistradorEvaluacion',
            'password' => 'AdministradorEvaluacion',
            'role' => 'Administrador Evaluacion',
            'email' => 'AdministradorEvaluacion@hotmail.com',
            'email_verified_at' => $now
        ]);
        //professors
        DB::table('users')->insert([
            'id' => 4,
            'username' => 'ProfessorAriel',
            'password' => 'ProfessorAriel',
            'role' => 'Professor',
            'email' => 'Ariel@hotmail.com',
            'email_verified_at' => $now
        ]);
        DB::table('users')->insert([
            'id' => 5,
            'username' => 'ProfessroBrenda',
            'password' => 'ProfessorBrenda',
            'role' => 'Professor',
            'email' => 'Brenda@hotmail.com',
            'email_verified_at' => $now
        ]);
        //estudiantes
        DB::table('users')->insert([
            'id' => 6,
            'username' => 'StudentOliver',
            'password' => 'StudentOliver',
            'role' => 'Student',
            'email' => 'Oliver@hotmail.com',
            'email_verified_at' => $now
        ]);
        DB::table('users')->insert([
            'id' => 7,
            'username' => 'StudentAlisson',
            'password' => 'StudentAlisson',
            'role' => 'Student',
            'email' => 'Alisson@hotmail.com',
            'email_verified_at' => $now
        ]);
    }
}
