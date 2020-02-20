<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|eqweqweqwe
*/


Route::get('/', function () {
    return view('auth.login');
});
//Login
Route::get('/login', function () {
    return view('auth.login');
});

//Admin
Route::get('/admin', function () {
    return view('admin.admin');
});
//Rutas de Administrador Users
Route::get('users/list', 'UsersController@index')->name('users.list'); //ver lista de usaurios
Route::post('users/store', 'UsersController@store')->name('users.store'); //registrar registors
//Rutas de Administrador Evaluacion
//Evaluations
Route::get('evaluation/index', 'EvaluationsController@index')->name('evaluations.list'); //obtener las tabla de evaluacion
Route::post('evaluation/store', 'EvaluationsController@store')->name('evaluations.store'); //guardar datos de la evaluacion
Route::Get('evaluation/{id}', 'EvaluationsController@get')->name('evaluations.get');
//Certificates
Route::get('certificate/list', 'CertificatesController@list')->name('certificates.list');
Route::get('certificate/indexCertificate', 'CertificatesController@indexCertificate')->name('certificates.indexcertificate'); //obtener los datos de certificados
Route::get('certificate/register', 'CertificatesController@createCertificate')->name('certificates.register');
Route::post('certificate/store', 'CertificatesController@storeCertificate')->name('certificates.store');
Route::get('certificate/listDiplomat', 'CertificatesController@listDiplomat')->name('certificates.listdiplomat');
Route::get('certificate/indexDiplomat', 'CertificatesController@indexDiplomat')->name('certificates.indexdiplomat');
Route::get('certificate/registerDiplomat', 'CertificatesController@createDiplomat')->name('certificates.registerdiplomat');
Route::post('certificate/registerDiplomat', 'CertificatesController@storeDiplomat')->name('certificates.storediplomat');
//Diplomados
Route::get('diplomat/index', 'DiplomatsController@index')->name('diplomats.list');
Route::post('diplomat/store', 'DiplomatsController@store')->name('diplomats.store');
Route::get('diplomat/{id}', 'DiplomatsController@get')->name('diplomats.get');

Route::get('diplomat/list', 'ModuleController@index')->name('modules.list');
Route::post('diplomat/module', 'ModuleController@createModule')->name('diplomatModule');
//Professors
Route::get('professor/index', 'ProfessorsController@index')->name('professors.list'); //obtener los datos
Route::get('professor/register', 'ProfessorsController@create')->name('professors.create'); //mandar al formulario de registro
Route::post('professor/register', 'ProfessorsController@store')->name('professors.store'); //guardar el registro
//Students
Route::get('students/index', 'StudentsController@index')->name('students.list'); //obtener lista de estudiantes
Route::get('students/create', 'StudentsController@create')->name('students.register'); //mandar al formulario de registro
Route::post('students/store', 'StudentsController@store')->name('students.store'); //guardar registro del estudainte
//Categorias
Route::get('categories/list', 'CategoriesController@index')->name('categories.list'); //ver los registros
Route::post('categories/store', 'CategoriesController@store')->name('categories.store'); //registrar registors
Route::get('categories/{id}', 'CategoriesController@get')->name('categories.get'); //obtener id para registrar preguntas
Route::get('categories/name', 'CategoriesController@getName')->name('categories.getName');
//Questions
Route::get('question/index/{id}', 'QuestionsController@index')->name('questions.list'); //obtener los datos
Route::post('question/store', 'QuestionsController@store')->name('questions.store'); //agregar datos
Route::get('question/get', 'QuestionsController@get')->name('questions.get'); //obtener los datos para mandar al modal
Route::post('question/edit', 'QuestionsController@edit')->name('questions.update'); //actualizar los datos
Route::delete('question/{id}', 'QuestionsController@destroy')->name('questions.delete'); //eliminar preguntas 
//Categorias asignadas a evaluaciones
Route::get('evaluationCategory/index/{id}', 'EvaluationCategoryController@index')->name('evaluationcategories.list');
Route::get('evaluationCategory/{id}', 'EvaluationCategoryController@listQuestion')->name('evaluationcategories.listQuestion');
Route::post('evaluationCategory/store', 'EvaluationCategoryController@store')->name('evaluationcategories.store');
//modulos
Route::get('module/listDiplomat', 'ModuleController@listDiplomat')->name('modules.listDiplomat');
Route::get('module/index', 'ModuleController@index')->name('modules.index');
Route::get('module/listDate/{id}', 'ModuleController@listModuleDate')->name('modules.listDate');
//Modulos en Estudaintes
Route::post('moduleStudent/Register/{id}', 'ModuleStudentController@store')->name('moduleStudent.store');
//Diplomados en Estudaintes
Route::post('diplomatStudent/Register/{id}', 'DiplomatStudentController@store')->name('diplomatStudent.store');

//RUTAS PROFESSOR
Route::get('professor', 'ProfessorsController@indexProfessor')->name('professor.mainIndex');
//Rutas Estudainte
Route::get('student', 'StudentsController@indexStudent')->name('student.mainIndex');
Route::get('student/Evaluation', 'StudentsController@showEvaluation')->name('student.evaluation');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
