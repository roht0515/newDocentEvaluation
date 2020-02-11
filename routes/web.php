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

use App\Http\Controllers\UserController;

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
Route::get('/admin/categories', 'CategoryController@list')->name('category.list');
Route::get('admin/certificate', 'CertificateController@list')->name('certificate.list');
Route::get('/admin/class', function () {
    return view('admin.adminClass');
});
Route::get('/admin/docentes-Estudiantes', function () {
    return view('admin.adminDocentStudent');
});

//controlador de diplomas
Route::get('/admin/listdiplomat', 'DiplomatController@list')->name('diplomat.list');
//Evaluacion
Route::get('/admin/evaluations', function () {
    return view('admin.adminEvaluations');
});
//hisotiral
Route::get('/admin/history', function () {
    return view('admin.adminHistory');
});
//usuario
Route::get('/admin/listUser', 'UserController@list')->name('users.list');
Route::post('admin/store', 'UserController@store')->name('users.store');
Route::get('/admin/register', function () {
    return view('admin.adminRegister');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
