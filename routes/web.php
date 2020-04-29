<?php

use App\Entities\Score;
use App\Entities\Answer;
use App\Entities\Customer;
use Illuminate\Support\Facades\Cache;
use Omniphx\Forrest\Providers\Laravel\Facades\Forrest;

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
    // Route::resource('/symptom', 'SymptomController'); //To go

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

    Route::view('/profile', 'profile.index');

});


Route::get('/leadata', function(){

    $scoreCustomer      = Score::where('customer_id', 1)->first();
    $answersCustomer    = Answer::where('customer_id', 1)->get();
    $customerData       = Customer::where('id', 1)->first();

    $symptomsCarrer         = '';
    $symptomsLove           = '';
    $symptomsSexuality      = '';
    $symptomsBodayHealth    = '';
    $symptomsFriendship     = '';
    $symptomsFamily         = '';
    $symptomsSpirituality   = '';
    $symptomDefault         = '';

    foreach($answersCustomer as $answer) {
        switch ($answer->reference) {
            case 'symptoms_beruf_und_karriere_user':
                $symptomsCarrer .= $answer->name . '\n';
                break;
            case 'symptoms_partnerschaft_user':
                $symptomsLove .= $answer->name . '\n';
                break;
            case 'symptoms_sexualitaet_user':
                $symptomsSexuality .= $answer->name . '\n';
                break;
            case 'symptoms_koerper_und_gesundheit_user':
                $symptomsBodayHealth .= $answer->name . '\n';
                break;
            case 'symptoms_freundschaften_user':
                $symptomsFriendship .= $answer->name . '\n';
                break;
            case 'symptoms_familie_user':
                $symptomsFamily .= $answer->name . '\n';
                break;
            case 'symptoms_spiritualitaet_user':
                $symptomsSpirituality .= $answer->name . '\n';
                break;
            default:
                $symptomDefault = 'No symptom found';
        }
    }

    //'Gender'                        => $customerData->gender == 'Männlich' ? 'Male' : 'Female',
    if($customerData->gender == 'Männlich'){
        $gender = 'Male';
    }elseif($customerData->gender == 'Weiblich'){
        $gender = 'Female';
    }else{
        $gender = 'Other';
    }

    $leadSalesForce = [
        'FirstName'                     => $customerData->prename,
        'email'                         => $customerData->email,
        'Gender'                        => $gender, 
        'MobilePhone'                   => $customerData->phone_number,
        'Overall_Happiness_Score'       => $scoreCustomer->total_areas,
        'Happiness_Score_Career'        => $scoreCustomer->beruf_und_karriere,
        'Happiness_Score_Love'          => $scoreCustomer->partnerschaft,
        'Happiness_Score_Sexuality'     => $scoreCustomer->sexualitaet,
        'Happiness_Score_Body_Health'   => $scoreCustomer->koerper_und_gesundheit,
        'Happiness_Score_Friendship'    => $scoreCustomer->freundschaften,
        'Happiness_Score_Family'        => $scoreCustomer->familie,
        'Happiness_Score_Spirituality'  => $scoreCustomer->spiritualitaet,
        'Symptoms_Career'               => $symptomsCarrer,
        'Symptoms_Love'                 => $symptomsLove,
        'Symptoms_Sexuality'            => $symptomsSexuality,
        'Symptoms_Body_Health'          => $symptomsBodayHealth,
        'Symptoms_Friendship'           => $symptomsFriendship,
        'Symptoms_Family'               => $symptomsFamily,
        'Symptoms_Spirituality'         => $symptomsSpirituality,
        'Time_Invest_Willingness'       => $customerData->time_invest_willingness,
        'Money_Invest_Willingness'      => $customerData->money_invest_willingness,
        'Newsletter_Opt_in'             => $customerData->newsletter_opt_in,
        'Call_Opt_in'                   => $customerData->call_opt_in,
        'Survey_Result_URL'             => url($customerData->survey_url),
    ];

    return $leadSalesForce;

});

// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/authenticate', function() {
    // return Forrest::getmytoken();
    dd(Forrest::getmytoken());
});

Route::get('/curl-authenticate', function() {
    dd(Forrest::curlGetToken());
});

Route::get('/callback/salesforce', function() {
    Forrest::callback();
});

Route::get('/sessions', function(){

    $data = [
        'session' => session()->all(),
        //'forrestVersion' => Forrest::versions(),
        'forrestToken' => Cache::get('forrest_token'),
    ];

    dd($data);
});


Route::post('/callback/survey', 'SurveyController@surveyHook')->name('survey.surveyHook');


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

