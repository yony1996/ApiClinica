<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::middleware(['auth','Admin'])->namespace('Admin')->group(function(){
    /**
 * Speciality
 */
Route::get('/specialties', 'SpecialtyController@index')->name('Speciality.index');
Route::get('/specialties/create', 'SpecialtyController@create')->name('Speciality.create'); //visualiza el form
Route::get('/specialties/{specialty}/edit', 'SpecialtyController@edit')->name('Speciality.edit');
Route::post('/specialties', 'SpecialtyController@store')->name('Speciality.store'); //envia el form
Route::put('/specialties/{specialty}', 'SpecialtyController@update')->name('Speciality.update');
Route::delete('/specialties/{specialty}', 'SpecialtyController@destroy')->name('Speciality.destroy');

/**
 * Doctors
 */
Route::get('/doctors', 'DoctorController@index')->name('Doctor.index');
Route::get('/doctors/create', 'DoctorController@create')->name('Doctor.create'); //visualiza el form
Route::get('/doctors/{doctor}/edit', 'DoctorController@edit')->name('Doctor.edit');
Route::post('/doctors', 'DoctorController@store')->name('Doctor.store'); //envia el form
Route::put('/doctors/{doctor}', 'DoctorController@update')->name('Doctor.update');
Route::delete('/doctors/{doctor}', 'DoctorController@destroy')->name('Doctor.destroy');
/**
 * Patients
 */
Route::get('/patients', 'PatientController@index')->name('Patient.index');
Route::get('/patients/create', 'PatientController@create')->name('Patient.create'); //visualiza el form
Route::get('/patients/{patient}/edit', 'PatientController@edit')->name('Patient.edit');
Route::post('/patients', 'PatientController@store')->name('Patient.store'); //envia el form
Route::put('/patients/{patient}', 'PatientController@update')->name('Patient.update');
Route::delete('/patients/{patient}', 'PatientController@destroy')->name('Patient.destroy');

});


Route::middleware(['auth','doctor'])->namespace('Doctor')->group(function(){

    Route::get('/schedule', 'ScheduleController@edit')->name('schedule');
    Route::post('/schedule', 'ScheduleController@store')->name('schedule.store');

});


Route::middleware('auth')->group(function(){
    Route::get('/appointment/create', 'AppointmentController@create')->name('Appointment.create');
    Route::post('/appointment', 'AppointmentController@store')->name('Appointment.store');
    
    //json
    Route::get('/specialties/{specialty}/doctors','Api\SpecialtyController@doctors');
    Route::get('/schedule/hours','Api\ScheduleController@hours');
    
});
    

