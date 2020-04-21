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
    return redirect('/login');
});

Route::get('/logout', 'Auth\LoginController@logout');

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    
    //Areas of Life
    Route::get('/area-of-life', 'AreaOfLifeController@index')->name('area.index');
    Route::get('/area-of-life/create', 'AreaOfLifeController@create')->name('area.create');
    Route::post('/area-of-life', 'AreaOfLifeController@store')->name('area.store');
    Route::get('/area-of-life/{areaOfLife}/edit', 'AreaOfLifeController@edit')->name('area.edit');
    Route::put('/area-of-life/{areaOfLife}', 'AreaOfLifeController@update')->name('area.update');
    Route::get('/area-of-life/{areaOfLife}', 'AreaOfLifeController@edit')->name('area.show');

    //Symptom
    Route::resource('/symptom', 'SymptomController'); //To go

    //User
    Route::resource('user', 'UserController'); //To be fixed

    //Symptoms
    Route::get('/area/{areaOfLife}/symptom/', 'SymptomController@index')->name('symptom.index');
    Route::get('/area/{areaOfLife}/symptom/create', 'SymptomController@create')->name('symptom.create');
    Route::post('/area/{areaOfLife}/symptom/', 'SymptomController@store')->name('symptom.store');
    Route::get('/area/{areaOfLife}/symptom/{symptom}/edit', 'SymptomController@edit')->name('symptom.edit');
    Route::put('/area/{areaOfLife}/symptom/{symptom}', 'SymptomController@update')->name('symptom.update');
    Route::get('/area/{areaOfLife}/symptom/{symptom}', 'SymptomController@show')->name('symptom.show');
    Route::delete('/area/{areaOfLife}/symptom/{symptom}', 'SymptomController@destroy')->name('symptom.destroy');

    //Survey
    Route::get('/survey', 'SurveyController@index')->name('survey.index');
    Route::get('/survey/submit', 'SurveyController@receiveSurvey')->name('survey.simulate');
    //Route::post('/survey/result/{token}', 'SurveyController@userResult')->name('survey.result');
    Route::get('/survey/result/{token}', 'SurveyController@userResult')->name('survey.result');

});


// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/', function () {
//     return view('welcome');
// });




Route::get('/table', function () {
    return view('table');
});

Route::get('/form', function () {
    return view('form');
});


Route::get('/symptoms', function () {
    return view('symptoms');
});

Route::get('/surveys', function() {
    return view('surveys');
});


// Route::get('/login', function() {
//     return view('login');
// });

Route::get('/survey-email', function(){
    return view('surveys.email');
});

