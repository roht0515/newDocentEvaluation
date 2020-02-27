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

//use App\Http\Controllers\ProfessorsController;

Route::get('/', function () {
    return view('auth.login');
});
//Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

//Error Routes
Route::get('/denied', function () {
    return view('error.permissionError');
})->name('permissionError');

Route::get('/denied/login', function () {
    return view('error.authenticated');
})->name('authenticated');

//Admin
Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
Route::get('home', 'HomeController@admin')->name('admin');
//Rutas de Administrador Users
Route::get('users/list', 'UsersController@index')->name('users.list'); //ver lista de usaurios
Route::post('users/store', 'UsersController@store')->name('users.store'); //registrar registors
//Rutas de Administrador Evaluacion
//Evaluations
Route::get('evaluation/index', 'EvaluationsController@index')->name('evaluations.list'); //obtener las tabla de evaluacion
Route::post('evaluation/store', 'EvaluationsController@store')->name('evaluations.store'); //guardar datos de la evaluacion
Route::Get('evaluation/{id}', 'EvaluationsController@get')->name('evaluations.get');
//Certificates
Route::get('certificates/list', 'CertificatesController@list')->name('certificates.list');
Route::get('certificates/index', 'CertificatesController@indexCertificate')->name('certificates.indexcertificate'); //obtener los datos de certificados
Route::get('certificates/register', 'CertificatesController@createCertificate')->name('certificates.register');
Route::post('certificates/store', 'CertificatesController@storeCertificate')->name('certificates.store');
Route::get('certificates/delivery/{id}', 'CertificatesController@getCertificate')->name('certificates.getCertificate');
//Diplomas
Route::get('Diplomas/list', 'CertificatesController@listDiplomat')->name('certificates.listdiplomat');
Route::get('Diplomas/index', 'CertificatesController@indexDiplomat')->name('certificates.indexdiplomat');
Route::get('Diplomas/register', 'CertificatesController@createDiplomat')->name('certificates.registerdiplomat');
Route::post('Diplomas/register', 'CertificatesController@storeDiplomat')->name('certificates.storediplomat');
Route::get('Diplomas/delivery/{id}', 'CertificatesController@getDiplomat')->name('certificates.getDiplomat');
//Entregas
//Ver Entregas Estudaintes
Route::get('certificate/list/student', 'CertificatesController@HistoryCertificateStudent')->name('certificates.historyStudent');
Route::get('diploma/list/student', 'CertificatesController@HistoryDiplomatStudent')->name('diplomats.historyStudent');
//Tutores
Route::get('certificate/list/tutor', 'CertificatesController@HistoryCertificateTutor')->name('certificates.historyTutor');
Route::get('diploma/list/tutor', 'CertificatesController@HistoryDiplomatTutor')->name('diplomats.historyTutor');
//Entregas de Certificado
Route::post('Delivery/Certificate/store/Student', 'DeliveryController@storeStudent')->name('deliveryStudent.store');
Route::post('Delivery/Certificate/store/Tutor', 'DeliveryController@storeTutor')->name('deliveryTutor.store');
//Diplomados-Carreras
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

});

//RUTAS PROFESSOR
Route::group(['prefix' => 'professor', 'middleware' => ['professor']], function () {
Route::get('home', 'ProfessorsController@indexProfessor')->name('professor.mainIndex');
Route::get('list', 'ProfessorsController@studentsList')->name('professor.students');
Route::get('history', 'ProfessorsController@studentsHistory')->name('professor.history');
Route::get('listStudents/{id}', 'ProfessorsController@studentsEvaluation')->name('listStudents');
});


//Rutas Estudainte
Route::group(['prefix' => 'student', 'middleware' => ['student']], function () {
Route::get('home', 'StudentsController@indexStudent')->name('student.mainIndex'); //retornar al inicio
Route::get('Modules/{id}', 'EvaluationStudentController@listModule')->name('student.module'); //obtener todos los modulos el cual esta registrado el estudainte
Route::get('Evaluation/{id}', 'EvaluationStudentController@getEvaluation')->name('student.getEvaluation');
Route::get('Questions/{id}', 'EvaluationStudentController@listQuestions')->name('student.questions');
Route::post('registerEvaluation', 'EvaluationStudentController@store')->name('evaluationStudent.store');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
