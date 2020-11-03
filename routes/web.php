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

Route::get('/survey/result/{token}', 'SurveyController@userResult')->name('survey.result');

Route::get('/subscription', function() {
    return view('surveys.subscription-email');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', "SurveyController@dashboard");
    
    //Areas of Life
    Route::get('/area-of-life', 'AreaOfLifeController@index')->name('area.index');
    Route::get('/area-of-life/create', 'AreaOfLifeController@create')->name('area.create');
    Route::post('/area-of-life', 'AreaOfLifeController@store')->name('area.store');
    Route::get('/area-of-life/{areaOfLife}/edit', 'AreaOfLifeController@edit')->name('area.edit');
    Route::put('/area-of-life/{areaOfLife}', 'AreaOfLifeController@update')->name('area.update');
    Route::get('/area-of-life/{areaOfLife}', 'AreaOfLifeController@edit')->name('area.show');

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
    Route::view('/profile', 'profile.index');

    //Payment
    Route::get('/payments', 'PaymentController@index')->name('payment.index');

});

//Survey Callback
Route::post('/callback/survey', 'SurveyController@surveyHook')->name('survey.surveyHook');

//Digistore Webhook
Route::post('digistore/webhook', 'PaymentController@digiStore');

//Teachable Webhook
Route::post('teachable/webhook', 'TeachableController@store');
Route::get('teachable/api', 'TeachableController@testApp');

Route::get('/mailjet', 'SurveyController@listSubscribe')->name('subscribe.list');

Route::get('/testemail', 'SurveyController@testEmail')->name('test.email');

Route::post('/website/subcriber/webhook', 'SubscriptionController@newsletterWebsiteSubscription');

Route::post('/survey/feedback', 'FeedbackController@feedback');
