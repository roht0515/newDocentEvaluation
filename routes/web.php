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
//RUTA DE REPORTES
Route::get('Report/Module/{id}', 'ModuleStudentController@generateReport')->name('modules.report');
//RUTAS NUEVAS
Route::get('Evaluations/State/list', 'EvaluationsController@listState')->name('evaluations.listState');
Route::get('Evaluations/State/Dates/{id}', 'EvaluationsController@getEvaluationState')->name('evaluations.getState');
Route::get('Evaluations/State/{id}', 'EvaluationsController@getEvaluationsDates')->name('evaluations.getDatesState');
Route::post('Evaluations/change/state', 'EvaluationsController@ChangeState')->name('evaluations.changeState');
Route::post('Student/Evaluation/Categories', 'EvaluationStudentNoteController@store')->name('evaluationnotes.store');
//Admin
Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    Route::get('home', 'HomeController@admin')->name('admin');
    //Rutas de Administrador Users
    Route::get('users/list', 'UsersController@index')->name('users.list'); //ver lista de usaurios
    Route::post('users/store', 'UsersController@store')->name('users.store'); //registrar registors
    //Rutas de Administrador Evaluacion
    //Evaluations
    Route::get('Evaluations/list', 'EvaluationsController@index')->name('evaluations.list'); //obtener las tabla de evaluacion
    Route::post('Evaluation/store', 'EvaluationsController@store')->name('evaluations.store'); //guardar datos de la evaluacion
    Route::Get('Evaluation/Categories/{id}', 'EvaluationsController@get')->name('evaluations.get');
    //Certificates
    Route::get('Certificates/index', 'CertificatesController@indexCertificate')->name('certificates.indexcertificate'); //obtener los datos de certificados
    Route::get('Certificates/list', 'CertificatesController@list')->name('certificates.list'); //obtener lista de certificados
    Route::get('Certificates/register', 'CertificatesController@createCertificate')->name('certificates.register');
    Route::post('Certificates/store', 'CertificatesController@storeCertificate')->name('certificates.store');
    Route::get('Certificates/delivery/{id}', 'CertificatesController@getCertificate')->name('certificates.getCertificate');
    //Diplomas
    Route::get('Diplomas/list', 'CertificatesController@listDiplomat')->name('certificates.listdiplomat');
    Route::get('Diplomas/index', 'CertificatesController@indexDiplomat')->name('certificates.indexdiplomat');
    Route::get('Diplomas/register', 'CertificatesController@createDiplomat')->name('certificates.registerdiplomat');
    Route::post('Diplomas/store', 'CertificatesController@storeDiplomat')->name('certificates.storediplomat');
    Route::get('Diplomas/delivery/{id}', 'CertificatesController@getDiplomat')->name('certificates.getDiplomat');
    //Entregas
    //Ver Entregas Estudaintes
    Route::get('Certificate/list/student', 'CertificatesController@HistoryCertificateStudent')->name('certificates.historyStudent');
    Route::get('Diploma/list/student', 'CertificatesController@HistoryDiplomatStudent')->name('diplomats.historyStudent');
    //Tutores
    Route::get('Certificate/list/tutor', 'CertificatesController@HistoryCertificateTutor')->name('certificates.historyTutor');
    Route::get('Diploma/list/tutor', 'CertificatesController@HistoryDiplomatTutor')->name('diplomats.historyTutor');
    //Entregas de Certificado
    Route::post('Delivery/Certificate/store/Student', 'DeliveryController@storeStudent')->name('deliveryStudent.store');
    Route::post('Delivery/Certificate/store/Tutor', 'DeliveryController@storeTutor')->name('deliveryTutor.store');
    //Diplomados-Carreras
    Route::get('Diplomats/list', 'DiplomatsController@index')->name('diplomats.list');
    Route::post('Diplomats/store', 'DiplomatsController@store')->name('diplomats.store');
    Route::get('Diplomat/Modules/{id}', 'DiplomatsController@get')->name('diplomats.get');
    //Professors
    Route::get('Professors/list', 'ProfessorsController@index')->name('professors.list'); //obtener los datos
    Route::get('Professors/register', 'ProfessorsController@create')->name('professors.create'); //mandar al formulario de registro
    Route::post('Professors/store', 'ProfessorsController@store')->name('professors.store'); //guardar el registro
    //Students
    Route::get('Students/list', 'StudentsController@index')->name('students.list'); //obtener lista de estudiantes
    Route::get('Students/register', 'StudentsController@create')->name('students.register'); //mandar al formulario de registro
    Route::post('Students/store', 'StudentsController@store')->name('students.store'); //guardar registro del estudainte
    //Categorias
    Route::get('Categories/list', 'CategoriesController@index')->name('categories.list'); //ver los registros
    Route::post('Categories/store', 'CategoriesController@store')->name('categories.store'); //registrar registors
    Route::get('Categories/Questions/{id}', 'CategoriesController@get')->name('categories.get'); //obtener id para registrar preguntas
    Route::get('Categories/name', 'CategoriesController@getName')->name('categories.getName');
    //Questions
    Route::get('Question/list/{id}', 'QuestionsController@index')->name('questions.list'); //obtener los datos
    Route::post('Question/store', 'QuestionsController@store')->name('questions.store'); //agregar datos
    Route::get('Question/get', 'QuestionsController@get')->name('questions.get'); //obtener los datos para mandar al modal
    Route::post('Question/edit', 'QuestionsController@edit')->name('questions.update'); //actualizar los datos
    Route::delete('Question/{id}', 'QuestionsController@destroy')->name('questions.delete'); //eliminar preguntas 
    //Categorias asignadas a evaluaciones
    Route::get('Evaluation/Category/list/{id}', 'EvaluationCategoryController@index')->name('evaluationcategories.list');
    Route::get('Evaluation/Category/{id}', 'EvaluationCategoryController@listQuestion')->name('evaluationcategories.listQuestion');
    Route::post('Evaluation/Category/store', 'EvaluationCategoryController@store')->name('evaluationcategories.store');
    //Modulos
    Route::post('Module/Diplomat/store', 'ModuleController@createModule')->name('diplomatModule');
    //modulos
    Route::get('Module/Student/list', 'ModuleStudentController@list')->name('modulesStudent.list'); //lista de modulos disponibles
    Route::get('ModuleStudent/list/{id}', 'ModuleStudentController@getModule')->name('moduleStudent.listStudent'); //obtener lista del estudiante
    Route::get('ModuleStudent/listRegister/{id}', 'ModuleStudentController@listModuleStudent')->name('moduleStudent.listRegister');
    Route::get('Modules/listDate/{id}', 'ModuleController@listModuleDate')->name('modules.listDate');
    //Modulos en Estudaintes
    Route::post('moduleStudent/Store', 'ModuleStudentController@store')->name('moduleStudent.store');
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
