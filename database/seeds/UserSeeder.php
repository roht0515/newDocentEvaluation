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
            'username' => 'Administrador',
            'password' => Hash::make('Administrador'),
            'role' => 'Administrador',
            'email' => 'Administrador@hotmail.com',
            'email_verified_at' => $now
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'username' => 'AdministradorSecretaria',
            'password' => Hash::make('AdministradorSecretaria'),
            'role' => 'Administrador Secretaria',
            'email' => 'AdministradorSecretaria@hotmail.com',
            'email_verified_at' => $now
        ]);
        DB::table('users')->insert([
            'id' => 3,
            'username' => 'AdministradorEvaluacion',
            'password' => Hash::make('AdministradorEvaluacion'),
            'role' => 'Administrador Evaluacion',
            'email' => 'AdministradorEvaluacion@hotmail.com',
            'email_verified_at' => $now
        ]);
        //professors
        DB::table('users')->insert([
            'id' => 4,
            'username' => 'ProfessorAriel',
            'password' => Hash::make('ProfessorAriel'),
            'role' => 'Professor',
            'email' => 'Ariel@hotmail.com',
            'email_verified_at' => $now
        ]);
        DB::table('users')->insert([
            'id' => 5,
            'username' => 'ProfessroBrenda',
            'password' => Hash::make('ProfessorBrenda'),
            'role' => 'Professor',
            'email' => 'Brenda@hotmail.com',
            'email_verified_at' => $now
        ]);
        //estudiantes
        DB::table('users')->insert([
            'id' => 6,
            'username' => 'StudentOliver',
            'password' => Hash::make('StudentOliver'),
            'role' => 'Student',
            'email' => 'Oliver@hotmail.com',
            'email_verified_at' => $now
        ]);
        DB::table('users')->insert([
            'id' => 7,
            'username' => 'StudentAlisson',
            'password' => Hash::make('StudentAlisson'),
            'role' => 'Student',
            'email' => 'Alisson@hotmail.com',
            'email_verified_at' => $now
        ]);
    }
}
