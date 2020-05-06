<?php

namespace App\Http\Controllers;

use App\Entities\Lead;
use App\Entities\Score;
use App\Entities\Answer;
use App\Entities\Survey;
use App\Entities\Symptom;
use App\Entities\Customer;
use App\Entities\Question;
use App\Entities\AreaOfLife;
use App\Mail\SendSurveyLink;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

use Omniphx\Forrest\Providers\Laravel\Facades\Forrest;
use Carbon\Carbon;
use DateTime;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();

        return view('surveys.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surveys.create');
    }

    /**
     * Display the user's survey result.
     *
     * @return \Illuminate\Http\Response
     */
    public function userResult(Request $request)
    {
        $token = $request->token;
        $customer = Customer::where('token', 'like', $token)->first();
        $score = Score::where('customer_id', $customer->id)->first();

        if(is_null($score)){
            $score = Score::create([
                'customer_id' => $customer->id,
            ]);
        }

        $getAreas = Question::where('reference', 'like', 'symptoms_%')->pluck('reference');
        $resultData = [];
        $userScore = 0;
        $maxPotential = 0; 
        $userBelives = [];

        foreach ($getAreas as $area) {
            $areaObject = (object)[];
            $stgToRemove = ['symptoms_', '_user'];
            $areaName = str_replace($stgToRemove, '', $area);
            
            $stgUserScore = str_replace('symptoms_','score_', $area);
            $userSelectedScore = (int) Answer::where('customer_id', $customer->id)
                                                ->where('reference', 'like', $stgUserScore)
                                                ->pluck('name')
                                                ->first();

            $areaObject->name = $this->areaInDbNameFormat($area);
            $symptoms = Answer::where('customer_id', $customer->id)
                                ->where('reference', 'like', $area)
                                ->join('symptoms', 'answers.name', '=', 'symptoms.name')
                                ->orderBy('res_prio', 'DESC')
                                ->get();

            foreach($symptoms as $symptom){
                $symptom->othersHavingThis = (int) ( count(Answer::where('name', $symptom->name)->get()) / (count(Customer::all())) * 100 );
            }

            $stg = str_replace('symptoms', 'score', $area);
            $baseScore = (int) Answer::where('customer_id', $customer->id)
                                        ->where('reference', 'like', $stg)
                                        ->pluck('name')
                                        ->first();
            $maxSubNumber = 50 * $baseScore / 100;
            
            $areaId = AreaOfLife::where('name', $areaName)->first();
            $symptomsNumber = count(Symptom::where('area_of_life_id', $areaId->id)->get());
            $selectedSymptomsNumber = count($symptoms);

            //All division exceptions to be attended.
            try {
                $pointPerSymptom = $maxSubNumber / $symptomsNumber;
            } catch (\Exception $exception) {
                $pointPerSymptom = 0;
            }

            $totalScoreSymptoms = $pointPerSymptom * $selectedSymptomsNumber;

            $areaScore = (int) floor($baseScore - $totalScoreSymptoms);
            
            $score->$areaName = $areaScore;

            $userScore += $areaScore;

            $getPerAreaScores = Score::pluck($areaName);
            $averageAreaScore = is_null($getPerAreaScores) ? 0 : (($getPerAreaScores)->sum() / count($getPerAreaScores));

            $areaObject->symptoms = $symptoms;
            $areaObject->areaScore = $areaScore;
            $areaObject->userSelectedSymptoms = $selectedSymptomsNumber;
            $areaObject->averageAreaScore = (int) $averageAreaScore;

            array_push($resultData, $areaObject);
        }

        $score->total_areas = $userScore;
        $score->save();

        $numberAreas = count($getAreas);
        $maxPotential = 100 - ( round($userScore  * 100 / (10 * $numberAreas)) ); 
        
        $averageScores = Score::pluck('total_areas');
        $averageHappinessAllParticipants = is_null($averageScores) ? 0 : ( (int) ( ($averageScores)->sum() / count($averageScores)) );

        usort($resultData, function ($item1, $item2) {
            return $item2->areaScore <=> $item1->areaScore;
        });
        
        for ($count = 0; $count < 2; $count++) { 
            foreach ($resultData as $area) {
                for ($i=0; $i < $area->symptoms->count(); $i++) {
                    $i == $count ? array_push($userBelives, $area->symptoms[$count]['belief']) : $i;
                }
            }
        }

        return view('surveys.result', compact([
            'customer', 
            'resultData', 
            'maxPotential',
            'userScore',
            'numberAreas',
            'userBelives',
            'averageHappinessAllParticipants',  
        ]));

    }
    
    /**
     * Display dashboard values.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        //Today's surveys
        $today = Carbon::now()->toArray();        
        $todaySurvey = DB::table('customers')
                            ->whereDay('submit_date', $today['day'])
                            ->whereMonth('submit_date', $today['month'])
                            ->whereYear('submit_date', $today['year'])
                            ->get()
                            ->count();
        //Total Subscriptions                   
        $totalSubscriptions = Customer::where('newsletter_opt_in', true)->count();

        //Total Leads
        $totalLeads = Customer::count();

        //TotalSurveys
        $totalSurveys = Score::count();

        //Male participants
        $maleSexSurveys = Customer::where('gender', 'männlich')->count();

        //Female participants
        $femaleSexSurveys = Customer::where('gender', 'weiblich')->count();

        //Other participants
        $otherSexSurveys = Customer::where('gender', 'Divers')->count();

        //Average scores per area of life
        $areasOfLife = [];

        $getAreas = Question::where('reference', 'like', 'symptoms_%')->pluck('reference');
        $totalSymptoms = Answer::where('reference', 'like', 'symptoms_%')->count();

        foreach ($getAreas as $key => $area) {
            $areaObject = (object)[];
            $areaName = strtr($area, ['symptoms_' => '','_user' => '']);
            $getPerAreaScores = Score::pluck($areaName);
            
            try {
                $averageAreaScore = is_null($getPerAreaScores) ? 0 : (int) (($getPerAreaScores)->sum() / count($getPerAreaScores));
            } catch (\Exception $exception) {
                $averageAreaScore = 0;
            }

            //Area of life name
            $areaObject->name = $this->areaInDbNameFormat($area);

            //Area of life average score of all users
            $areaObject->averageAreaScore = $averageAreaScore;

            array_push($areasOfLife, $areaObject);
        }

        return view('dashboard', compact([
            'todaySurvey',
            'totalSubscriptions',
            'totalLeads',
            'totalSurveys',
            'maleSexSurveys',
            'femaleSexSurveys',
            'otherSexSurveys',
            'areasOfLife'
        ]));
    }

    /**
     * Receive callback and store relevant data.
     *
     * @return \Illuminate\Http\Response
     */
    public function surveyHook(Request $request)
    {
        Storage::prepend('survey_submission.txt', '----' . json_encode($request->all()) . '----');

        $dataArray = json_decode(json_encode($request->all()), true);

        if ($dataArray) {
            $answers = $dataArray["form_response"]["answers"];
            $resultToken = md5(uniqid(rand(), true)); //Make shorter
            $customer = Customer::create();
    
            foreach ($answers as $answer) {

                $question = Question::where('reference', $answer['field']['ref'])->first();
                !is_null($question) ? $question_id = $question->id : $question_id = null;

                switch ($answer['field']['ref']) {
                    case 'prename_user':
                        $customer->prename = $answer['text'];
                        $customer->last_name = $answer['text'];
                        break;
    
                    case 'email_address_user':
                        $customer->email = $answer['email'];
                        break;
    
                    case 'date_of_birth_user':
                        $customer->birth = $answer['date'];
                        break;
    
                    case 'gender_user':
                        $customer->gender = $answer['choice']['label'];
                        break;
                        
                    case 'postal_code_user':
                        $customer->postal_code = $answer['number'];
                        break;
    
                    case 'score_overall_happiness_user':
                        Answer::create([
                            'name' => $answer['number'],
                            'reference' => $answer['field']['ref'],
                            'customer_id' => $customer->id,
                            'question_id' => $question_id,
                        ]);
                        break;
                        
                    case 'score_beruf_und_karriere_user':
                        Answer::create([
                            'name' => $answer['number'],
                            'reference' => $answer['field']['ref'],
                            'customer_id' => $customer->id,
                            'question_id' => $question_id,
                        ]);
                        break;

                    case 'symptoms_beruf_und_karriere_user':
                        if(!is_null($answer['choices']['labels'])) {
                            foreach ($answer['choices']['labels'] as $item) {
                                Answer::create([
                                    'name' =>$item,
                                    'reference' => $answer['field']['ref'],
                                    'customer_id' => $customer->id,
                                    'question_id' => $question_id,
                                ]);
                            }
                        }
                        if(array_key_exists('other', $answer['choices'])) {
                            Answer::create([
                                'name' =>$answer['choices']['other'],
                                'reference' => 'other_'. $answer['field']['ref'],
                                'customer_id' => $customer->id,
                                'question_id' => $question_id,
                            ]);
                        }
                        
                        break;

                    case 'score_partnerschaft_user':
                        Answer::create([
                            'name' => $answer['number'],
                            'reference' => $answer['field']['ref'],
                            'customer_id' => $customer->id,
                            'question_id' => $question->id,
                        ]);
                        break;

                    case 'symptoms_partnerschaft_user':
                        if(!is_null($answer['choices']['labels'])){
                            foreach ($answer['choices']['labels'] as $item) {
                                Answer::create([
                                    'name' =>$item,
                                    'reference' => $answer['field']['ref'],
                                    'customer_id' => $customer->id,
                                    'question_id' => $question_id,
                                ]);
                            }
                        }
                        if(array_key_exists('other', $answer['choices'])) {
                            Answer::create([
                                'name' =>$answer['choices']['other'],
                                'reference' => 'other_'. $answer['field']['ref'],
                                'customer_id' => $customer->id,
                                'question_id' => $question_id,
                            ]);
                        }
                        break;
    
                    case 'score_sexualitaet_user':
                        Answer::create([
                            'name' => $answer['number'],
                            'reference' => $answer['field']['ref'],
                            'customer_id' => $customer->id,
                            'question_id' => $question->id,
                        ]);
                        break;

                    case 'symptoms_sexualitaet_user':
                        if(!is_null($answer['choices']['labels'])){
                            foreach ($answer['choices']['labels'] as $item) {
                                Answer::create([
                                    'name' =>$item,
                                    'reference' => $answer['field']['ref'],
                                    'customer_id' => $customer->id,
                                    'question_id' => $question_id,
                                ]);
                            }
                        }
                        if(array_key_exists('other', $answer['choices'])) {
                            Answer::create([
                                'name' =>$answer['choices']['other'],
                                'reference' => 'other_'. $answer['field']['ref'],
                                'customer_id' => $customer->id,
                                'question_id' => $question_id,
                            ]);
                        }

                        break;
    
                    case 'score_koerper_und_gesundheit_user':
                        Answer::create([
                            'name' => $answer['number'],
                            'reference' => $answer['field']['ref'],
                            'customer_id' => $customer->id,
                            'question_id' => $question->id,
                        ]);
                        break;

                    case 'symptoms_koerper_und_gesundheit_user':
                        if(!is_null($answer['choices']['labels'])){
                            foreach ($answer['choices']['labels'] as $item) {
                                Answer::create([
                                    'name' =>$item,
                                    'reference' => $answer['field']['ref'],
                                    'customer_id' => $customer->id,
                                    'question_id' => $question_id,
                                ]);
                            }
                        }
                        if(array_key_exists('other', $answer['choices'])) {
                            Answer::create([
                                'name' =>$answer['choices']['other'],
                                'reference' => 'other_'. $answer['field']['ref'],
                                'customer_id' => $customer->id,
                                'question_id' => $question_id,
                            ]);
                        }

                        break;
                        
                    case 'score_freundschaften_user':
                        Answer::create([
                            'name' => $answer['number'],
                            'reference' => $answer['field']['ref'],
                            'customer_id' => $customer->id,
                            'question_id' => $question->id,
                        ]);
                        break;

                    case 'symptoms_freundschaften_user':
                        if(!is_null($answer['choices']['labels'])){
                            foreach ($answer['choices']['labels'] as $item) {
                                Answer::create([
                                    'name' =>$item,
                                    'reference' => $answer['field']['ref'],
                                    'customer_id' => $customer->id,
                                    'question_id' => $question_id,
                                ]);
                            }
                        }
                        if(array_key_exists('other', $answer['choices'])) {
                            Answer::create([
                                'name' =>$answer['choices']['other'],
                                'reference' => 'other_'. $answer['field']['ref'],
                                'customer_id' => $customer->id,
                                'question_id' => $question_id,
                            ]);
                        }

                        break;
    
                    case 'score_familie_user':
                        Answer::create([
                            'name' => $answer['number'],
                            'reference' => $answer['field']['ref'],
                            'customer_id' => $customer->id,
                            'question_id' => $question->id,
                        ]);
                        break;

                    case 'symptoms_familie_user':
                        if(!is_null($answer['choices']['labels'])){
                            foreach ($answer['choices']['labels'] as $item) {
                                Answer::create([
                                    'name' =>$item,
                                    'reference' => $answer['field']['ref'],
                                    'customer_id' => $customer->id,
                                    'question_id' => $question_id,
                                ]);
                            }
                        }
                        if(array_key_exists('other', $answer['choices'])) {
                            Answer::create([
                                'name' =>$answer['choices']['other'],
                                'reference' => 'other_'. $answer['field']['ref'],
                                'customer_id' => $customer->id,
                                'question_id' => $question_id,
                            ]);
                        }

                        break;
                        
                    case 'score_spiritualitaet_user':
                        Answer::create([
                            'name' => $answer['number'],
                            'reference' => $answer['field']['ref'],
                            'customer_id' => $customer->id,
                            'question_id' => $question->id,
                        ]);
                        break;

                    case 'symptoms_spiritualitaet_user':
                        if(!is_null($answer['choices']['labels'])){
                            foreach ($answer['choices']['labels'] as $item) {
                                Answer::create([
                                    'name' =>$item,
                                    'reference' => $answer['field']['ref'],
                                    'customer_id' => $customer->id,
                                    'question_id' => $question_id,
                                ]);
                            }
                        }
                        if(array_key_exists('other', $answer['choices'])) {
                            Answer::create([
                                'name' =>$answer['choices']['other'],
                                'reference' => 'other_'. $answer['field']['ref'],
                                'customer_id' => $customer->id,
                                'question_id' => $question_id,
                            ]);
                        }

                        break;
    
                    case 'time_invest_user':
                        $customer->time_invest_willingness = $answer['choice']['label'];
                        break;
    
                    case 'money_invest_user':
                        if(array_key_exists('other', $answer['choice'])) {
                            $customer->money_invest_willingness = $answer['choice']['other'];
                        }

                        if(array_key_exists('label', $answer['choice'])){
                            $customer->money_invest_willingness = $answer['choice']['label'];
                        }

                        break;
    
                    case 'call_optin_user':
                        $customer->call_opt_in = $answer['boolean'];
                        // $answer['boolean'] === true ?
                        //                         $customer->call_opt_in = true :
                        //                         $customer->call_opt_in = false;
                        break;
                   
                    case 'newsletter_optin_user':
                        $customer->newsletter_opt_in = $answer['boolean'];
                        // $answer['boolean'] === true ? 
                        //                         $customer->newsletter_opt_in = true :
                        //                         $customer->newsletter_opt_in = false;
                        break;
    
                    case 'phone_number_user':
                        $customer->phone_number = $answer['phone_number']; //If is_null($answer['phone_number]), make phone_number = '';
                        break;
                }
    
                $customer->submit_date = $dataArray["form_response"]["submitted_at"];
                $customer->start_date = $dataArray["form_response"]["landed_at"];
                $customer->survey_url = "/survey/result/". $resultToken;
                $customer->token = $resultToken;
                
                $customer->save();
            }

            //Store scores data of current survey.
            $getAreas = Question::where('reference', 'like', 'symptoms_%')->pluck('reference');
            $userScore= 0;
            $score = Score::create([
                'customer_id' => $customer->id,
            ]);
            foreach ($getAreas as $area) {
                $stgToRemove = ['symptoms_', '_user'];
                $areaName = str_replace($stgToRemove, '', $area);
                
                $symptoms = Answer::where('customer_id', $customer->id)
                                    ->where('reference', 'like', $area)
                                    ->join('symptoms', 'answers.name', '=', 'symptoms.name')
                                    ->orderBy('res_prio', 'DESC')
                                    ->get();

                $stg = str_replace('symptoms', 'score', $area);
                $baseScore = (int) Answer::where('customer_id', $customer->id)
                                            ->where('reference', 'like', $stg)
                                            ->pluck('name')
                                            ->first();
                $maxSubNumber = 50 * $baseScore / 100;
                
                $areaId = AreaOfLife::where('name', $areaName)->first();
                $symptomsNumber = count(Symptom::where('area_of_life_id', $areaId->id)->get());
                $selectedSymptomsNumber = count($symptoms);

                //All division exceptions to be attended.
                try {
                    $pointPerSymptom = $maxSubNumber / $symptomsNumber;
                } catch (\Exception $exception) {
                    $pointPerSymptom = 0;
                }

                $totalScoreSymptoms = $pointPerSymptom * $selectedSymptomsNumber;
                $areaScore = (int) floor($baseScore - $totalScoreSymptoms);                
                $score->$areaName = $areaScore;
                $userScore += $areaScore;
            }

            $score->total_areas = $userScore;
            $score->save();
        }

        //Create Salesforce Lead N.B. This wont work when using webhook test because webhook doesn't create score and all of that
        $this->createLead($customer); //Using curl
    
        //send survey email with its own data using Mailjet
        $data = [
            'name'          => $customer->prename,
            'surveyLink'    => url($customer->survey_url)
        ];

        Mail::to($customer->email)
            ->send(new SendSurveyLink($data));

       return redirect('/survey')->with("success", "Survey received and saved successfully");
    }


    /**
     * Format areas of life from db synthax to user friendly format.
     *
     * @return \Illuminate\Http\Response
     */
    public function areaInDbNameFormat($areaInDB)
    {
        switch ($areaInDB) {
            case 'symptoms_beruf_und_karriere_user':
                return 'Beruf & Karriere';

            case 'symptoms_familie_user':
                return 'Familie';

            case 'symptoms_freundschaften_user':
                return 'Freunde';

            case 'symptoms_koerper_und_gesundheit_user':
                return 'Körper & Gesundheit';

            case 'symptoms_sexualitaet_user':
                return 'Sexualität';

            case 'symptoms_spiritualitaet_user':
                return 'Spiritualität';

            case 'symptoms_partnerschaft_user':
                return 'Partnerschaft';
            
            default:
                return strtr($areaInDB, ['_' => ' ','user' => '', 'symptoms' => '']);
        }
    }

    /**
     * Get Salesforce Token
     * @return salesforce token
    */
    public function curlGetTokenSalesForce()
    {
        $url = 'https://login.salesforce.com/services/oauth2/token';
        $passwordAndToken = env("SF_PASSWORD") . env("SF_TOKEN_PASS");
        
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_URL            => $url,
                CURLOPT_POST           => TRUE,
                CURLOPT_POSTFIELDS     => http_build_query(
                    array(
                        'grant_type'    => 'password',
                        'client_id'     => env("SF_CONSUMER_KEY"),
                        'client_secret' => env("SF_CONSUMER_SECRET"),
                        'username'      => env("SF_USERNAME"),
                        'password'      => $passwordAndToken
                    )
                )
            )
        );

        $response = json_decode(curl_exec($curl), true); //true to get array
        curl_close($curl);

        return $response;
    }

    /**
     * Create Salesforce Lead
     * @param customer
     * @return salesforce lead
    */
    public function createLead($customer) {
        //$instanceUrl = "https://eu31.salesforce.com/services/data/v20.0/sobjects/Lead/";
        $tokenParent = $this->curlGetTokenSalesForce();
        $token = $tokenParent['access_token'];
        $instanceUrl = $tokenParent['instance_url'];
        $postUrl = $instanceUrl . '/services/data/v20.0/sobjects/Lead/';

        //Customer Data
        $scoreCustomer      = Score::where('customer_id', $customer->id)->first();
        $answersCustomer    = Answer::where('customer_id', $customer->id)->get();
        $customerData       = $customer;
    
        $symptomsCareer         = '';
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
                    $symptomsCareer .= $answer->name . PHP_EOL;
                    break;
                case 'symptoms_partnerschaft_user':
                    $symptomsLove .= $answer->name . PHP_EOL;
                    break;
                case 'symptoms_sexualitaet_user':
                    $symptomsSexuality .= $answer->name . PHP_EOL;
                    break;
                case 'symptoms_koerper_und_gesundheit_user':
                    $symptomsBodayHealth .= $answer->name . PHP_EOL;
                    break;
                case 'symptoms_freundschaften_user':
                    $symptomsFriendship .= $answer->name. PHP_EOL;
                    break;
                case 'symptoms_familie_user':
                    $symptomsFamily .= $answer->name . PHP_EOL;
                    break;
                case 'symptoms_spiritualitaet_user':
                    $symptomsSpirituality .= $answer->name . PHP_EOL;
                    break;
                default:
                    $symptomDefault = 'No symptom found';
            }
        }
    
        if($customerData->gender == 'Männlich'){
            $gender = 'Male';
            $title = 'Mr';
        }elseif($customerData->gender == 'Weiblich'){
            $gender = 'Female';
            $title = 'Mrs';
        }else{
            $gender = 'Other';
            $title = 'Other';
        }
        
        if($customerData->time_invest_willingness == null){
            $timeInvest = 0;
        }else {
            $timeInvest = $customerData->time_invest_willingness;
        }
        
        if($customerData->money_invest_willingness == null){
            $moneyInvest = 0;
        }else {
            $moneyInvest = $customerData->money_invest_willingness;
        }
        
        if($customerData->newsletter_opt_in == null){
            $newsletter = 0;
        }else {
            $newsletter = $customerData->newsletter_opt_in;
        }
        
        if($customerData->call_opt_in == null){
            $callOptin = 0;
        }else {
            $callOptin = $customerData->call_opt_in;
        }
        
        if(($customerData->call_opt_in == null) && (is_null($customerData->phone_number))){
            $phoneNumber = '';
        } else {
            $phoneNumber = $customerData->phone_number; //Should not be null
        }
        
        $leadContent = [
            'FirstName'                         => $customerData->prename,
            'LastName'                          => $customerData->prename,
            'Company'                           => $customerData->prename,
            'Email'                             => $customerData->email,
            'Title'                             => $title,
            'Gender__c'                         => $gender,
            'Date_of_Birth__c'                  => $customerData->birth,
            'MobilePhone'                       => $phoneNumber,
            'Overall_Happiness_Score__c'        => $scoreCustomer->total_areas,
            'Happiness_Score_Career__c'         => $scoreCustomer->beruf_und_karriere,
            'Happiness_Score_Love__c'           => $scoreCustomer->partnerschaft,
            'Happiness_Score_Sexuality__c'      => $scoreCustomer->sexualitaet,
            'Happiness_Score_Body_Health__c'    => $scoreCustomer->koerper_und_gesundheit,
            'Happiness_Score_Friendship__c'     => $scoreCustomer->freundschaften,
            'Happiness_Score_Family__c'         => $scoreCustomer->familie,
            'Happiness_Score_Spirituality__c'   => $scoreCustomer->spiritualitaet,
            'Symptoms_Career__c'                => $symptomsCareer,
            'Symptoms_Love__c'                  => $symptomsLove,
            'Symptoms_Sexuality__c'             => $symptomsSexuality,
            'Symptoms_Body_Health__c'           => $symptomsBodayHealth,
            'Symptoms_Friendship__c'            => $symptomsFriendship,
            'Symptoms_Family__c'                => $symptomsFamily,
            'Symptoms_Spirituality__c'          => $symptomsSpirituality,
            'Time_Invest_Willingness__c'        => $timeInvest,
            'Money_Invest_Willingness__c'       => $moneyInvest,
            'Newsletter_Opt_in__c'              => $newsletter,
            'Call_Opt_in__c'                    => $callOptin,
            'Survey_Result_URL__c'              => url($customerData->survey_url),
        ];
    
        $content = json_encode($leadContent);

        $curl = curl_init($postUrl);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
                array("Authorization: OAuth $token",
                    "Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
    
        $json_response = curl_exec($curl);
    
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    
        if ( $status != 201 ) {
            die("Error: call to URL $postUrl failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        }
        
        curl_close($curl);
    
        $response = json_decode($json_response, true);
    
        $id = $response["id"];
    
    }

    /**
     * receiveSurvey for testing purposes
     */

    public function receiveSurvey(Request $request)
    {
        //Get the results' file form public location in app. 

        try{
            $fileApi = File::get("simulate/survey_api.txt");
            $dataJson = substr($fileApi, 0, strrpos( $fileApi, '}') + 1);
            $dataArray = json_decode($dataJson, true);

        }
        catch(\Exception $exception){
            
        }

        die("Inside survey dummy data ");

        //Check if result data is not null.

        if ($dataArray) {
            $answers = $dataArray["form_response"]["answers"];
            $resultToken = md5(uniqid(rand(), true)); //Make shorter
            $customer = Customer::create();
    
            //Create Answer data.

            foreach ($answers as $answer) {

                $question = Question::where('reference', $answer['field']['ref'])->first();
                !is_null($question) ? $question_id = $question->id : $question_id = null;

                switch ($answer['field']['ref']) {
                    case 'prename_user':
                        $customer->prename = $answer['text'];
                        $customer->last_name = $answer['text'];
                        break;
    
                    case 'email_address_user':
                        $customer->email = $answer['email'];
                        break;
    
                    case 'date_of_birth_user':
                        $customer->birth = $answer['date'];
                        break;
    
                    case 'gender_user':
                        $customer->gender = $answer['choice']['label'];
                        break;
                        
                    case 'postal_code_user':
                        $customer->postal_code = $answer['number'];
                        break;
    
                    case 'score_overall_happiness_user':
                        Answer::create([
                            'name' => $answer['number'],
                            'reference' => $answer['field']['ref'],
                            'customer_id' => $customer->id,
                            'question_id' => $question_id,
                        ]);
                        break;
                        
                    case 'score_beruf_und_karriere_user':
                        Answer::create([
                            'name' => $answer['number'],
                            'reference' => $answer['field']['ref'],
                            'customer_id' => $customer->id,
                            'question_id' => $question_id,
                        ]);
                        break;

                    case 'symptoms_beruf_und_karriere_user':
                        if(!is_null($answer['choices']['labels'])) {
                            foreach ($answer['choices']['labels'] as $item) {
                                Answer::create([
                                    'name' =>$item,
                                    'reference' => $answer['field']['ref'],
                                    'customer_id' => $customer->id,
                                    'question_id' => $question_id,
                                ]);
                            }
                        }
                        if(array_key_exists('other', $answer['choices'])) {
                            Answer::create([
                                'name' =>$answer['choices']['other'],
                                'reference' => 'other_'. $answer['field']['ref'],
                                'customer_id' => $customer->id,
                                'question_id' => $question_id,
                            ]);
                        }
                        
                        break;

                    case 'score_partnerschaft_user':
                        Answer::create([
                            'name' => $answer['number'],
                            'reference' => $answer['field']['ref'],
                            'customer_id' => $customer->id,
                            'question_id' => $question->id,
                        ]);
                        break;

                    case 'symptoms_partnerschaft_user':
                        if(!is_null($answer['choices']['labels'])){
                            foreach ($answer['choices']['labels'] as $item) {
                                Answer::create([
                                    'name' =>$item,
                                    'reference' => $answer['field']['ref'],
                                    'customer_id' => $customer->id,
                                    'question_id' => $question_id,
                                ]);
                            }
                        }
                        if(array_key_exists('other', $answer['choices'])) {
                            Answer::create([
                                'name' =>$answer['choices']['other'],
                                'reference' => 'other_'. $answer['field']['ref'],
                                'customer_id' => $customer->id,
                                'question_id' => $question_id,
                            ]);
                        }
                        break;
    
                    case 'score_sexualitaet_user':
                        Answer::create([
                            'name' => $answer['number'],
                            'reference' => $answer['field']['ref'],
                            'customer_id' => $customer->id,
                            'question_id' => $question->id,
                        ]);
                        break;

                    case 'symptoms_sexualitaet_user':
                        if(!is_null($answer['choices']['labels'])){
                            foreach ($answer['choices']['labels'] as $item) {
                                Answer::create([
                                    'name' =>$item,
                                    'reference' => $answer['field']['ref'],
                                    'customer_id' => $customer->id,
                                    'question_id' => $question_id,
                                ]);
                            }
                        }
                        if(array_key_exists('other', $answer['choices'])) {
                            Answer::create([
                                'name' =>$answer['choices']['other'],
                                'reference' => 'other_'. $answer['field']['ref'],
                                'customer_id' => $customer->id,
                                'question_id' => $question_id,
                            ]);
                        }

                        break;
    
                    case 'score_koerper_und_gesundheit_user':
                        Answer::create([
                            'name' => $answer['number'],
                            'reference' => $answer['field']['ref'],
                            'customer_id' => $customer->id,
                            'question_id' => $question->id,
                        ]);
                        break;

                    case 'symptoms_koerper_und_gesundheit_user':
                        if(!is_null($answer['choices']['labels'])){
                            foreach ($answer['choices']['labels'] as $item) {
                                Answer::create([
                                    'name' =>$item,
                                    'reference' => $answer['field']['ref'],
                                    'customer_id' => $customer->id,
                                    'question_id' => $question_id,
                                ]);
                            }
                        }
                        if(array_key_exists('other', $answer['choices'])) {
                            Answer::create([
                                'name' =>$answer['choices']['other'],
                                'reference' => 'other_'. $answer['field']['ref'],
                                'customer_id' => $customer->id,
                                'question_id' => $question_id,
                            ]);
                        }

                        break;
                        
                    case 'score_freundschaften_user':
                        Answer::create([
                            'name' => $answer['number'],
                            'reference' => $answer['field']['ref'],
                            'customer_id' => $customer->id,
                            'question_id' => $question->id,
                        ]);
                        break;

                    case 'symptoms_freundschaften_user':
                        if(!is_null($answer['choices']['labels'])){
                            foreach ($answer['choices']['labels'] as $item) {
                                Answer::create([
                                    'name' =>$item,
                                    'reference' => $answer['field']['ref'],
                                    'customer_id' => $customer->id,
                                    'question_id' => $question_id,
                                ]);
                            }
                        }
                        if(array_key_exists('other', $answer['choices'])) {
                            Answer::create([
                                'name' =>$answer['choices']['other'],
                                'reference' => 'other_'. $answer['field']['ref'],
                                'customer_id' => $customer->id,
                                'question_id' => $question_id,
                            ]);
                        }

                        break;
    
                    case 'score_familie_user':
                        Answer::create([
                            'name' => $answer['number'],
                            'reference' => $answer['field']['ref'],
                            'customer_id' => $customer->id,
                            'question_id' => $question->id,
                        ]);
                        break;

                    case 'symptoms_familie_user':
                        if(!is_null($answer['choices']['labels'])){
                            foreach ($answer['choices']['labels'] as $item) {
                                Answer::create([
                                    'name' =>$item,
                                    'reference' => $answer['field']['ref'],
                                    'customer_id' => $customer->id,
                                    'question_id' => $question_id,
                                ]);
                            }
                        }
                        if(array_key_exists('other', $answer['choices'])) {
                            Answer::create([
                                'name' =>$answer['choices']['other'],
                                'reference' => 'other_'. $answer['field']['ref'],
                                'customer_id' => $customer->id,
                                'question_id' => $question_id,
                            ]);
                        }

                        break;
                        
                    case 'score_spiritualitaet_user':
                        Answer::create([
                            'name' => $answer['number'],
                            'reference' => $answer['field']['ref'],
                            'customer_id' => $customer->id,
                            'question_id' => $question->id,
                        ]);
                        break;

                    case 'symptoms_spiritualitaet_user':
                        if(!is_null($answer['choices']['labels'])){
                            foreach ($answer['choices']['labels'] as $item) {
                                Answer::create([
                                    'name' =>$item,
                                    'reference' => $answer['field']['ref'],
                                    'customer_id' => $customer->id,
                                    'question_id' => $question_id,
                                ]);
                            }
                        }
                        if(array_key_exists('other', $answer['choices'])) {
                            Answer::create([
                                'name' =>$answer['choices']['other'],
                                'reference' => 'other_'. $answer['field']['ref'],
                                'customer_id' => $customer->id,
                                'question_id' => $question_id,
                            ]);
                        }

                        break;
    
                    case 'time_invest_user':
                        $customer->time_invest_willingness = $answer['choice']['label'];
                        break;
    
                    case 'money_invest_user':
                        if(array_key_exists('other', $answer['choice'])) {
                            $customer->money_invest_willingness = $answer['choice']['other'];
                        }

                        if(array_key_exists('label', $answer['choice'])){
                            $customer->money_invest_willingness = $answer['choice']['label'];
                        }

                        break;
    
                    case 'call_optin_user':
                        $customer->call_opt_in = $answer['boolean'];
                        break;
                   
                    case 'newsletter_optin_user':
                        $customer->newsletter_opt_in = $answer['boolean'];
                        break;
    
                    case 'phone_number_user':
                        $customer->phone_number = $answer['phone_number'];
                        break;
                }
    
                $customer->submit_date = $dataArray["form_response"]["submitted_at"];
                $customer->start_date = $dataArray["form_response"]["landed_at"];
                $customer->survey_url = "/survey/result/". $resultToken;
                $customer->token = $resultToken;
                
                $customer->save();        

            }

            //Store scores data of current survey.

            $getAreas = Question::where('reference', 'like', 'symptoms_%')->pluck('reference');
            $userScore= 0;
            $score = Score::create([
                'customer_id' => $customer->id,
            ]);
            foreach ($getAreas as $area) {
                $stgToRemove = ['symptoms_', '_user'];
                $areaName = str_replace($stgToRemove, '', $area);
                
                $symptoms = Answer::where('customer_id', $customer->id)
                                    ->where('reference', 'like', $area)
                                    ->join('symptoms', 'answers.name', '=', 'symptoms.name')
                                    ->orderBy('res_prio', 'DESC')
                                    ->get();

                $stg = str_replace('symptoms', 'score', $area);
                $baseScore = (int) Answer::where('customer_id', $customer->id)
                                            ->where('reference', 'like', $stg)
                                            ->pluck('name')
                                            ->first();
                $maxSubNumber = 50 * $baseScore / 100;
                
                $areaId = AreaOfLife::where('name', $areaName)->first();
                $symptomsNumber = count(Symptom::where('area_of_life_id', $areaId->id)->get());
                $selectedSymptomsNumber = count($symptoms);

                //All division exceptions to be attended.
                try {
                    $pointPerSymptom = $maxSubNumber / $symptomsNumber;
                } catch (\Exception $exception) {
                    $pointPerSymptom = 0;
                }

                $totalScoreSymptoms = $pointPerSymptom * $selectedSymptomsNumber;
                $areaScore = (int) floor($baseScore - $totalScoreSymptoms);                
                $score->$areaName = $areaScore;
                $userScore += $areaScore;
            }

            $score->total_areas = $userScore;
            $score->save();

        }

        //Create Salesforce Lead / To DO & Continue (WORKING FINE)
        //$this->createSalesForceLead($customer);
        //THIS IS THE ONE TO USE THAT WORKS WELL
        //$this->createLead($customer); 
        
        // //send survey email with its own data
        // $data = [
        //     'name'          => $customer->prename,
        //     'surveyLink'    => url($customer->survey_url) //url helper to take the base url of the project
        // ];

        // Mail::to($customer->email)
        //     ->send(new SendSurveyLink($data));

       return redirect('/survey')->with("success", "Survey received and saved successfully");
    }

        /**
     * Create Salesforce Lead | Not being used for now
     * @param customer
     * @return salesforce lead
    */
    public function createSalesForceLead($customer)
    {
        $scoreCustomer      = Score::where('customer_id', $customer->id)->first();
        $answersCustomer    = Answer::where('customer_id', $customer->id)->get();
        $customerData       = $customer;
    
        $symptomsCareer         = '';
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
                    $symptomsCareer .= $answer->name . PHP_EOL;
                    break;
                case 'symptoms_partnerschaft_user':
                    $symptomsLove .= $answer->name . PHP_EOL;
                    break;
                case 'symptoms_sexualitaet_user':
                    $symptomsSexuality .= $answer->name . PHP_EOL;
                    break;
                case 'symptoms_koerper_und_gesundheit_user':
                    $symptomsBodayHealth .= $answer->name . PHP_EOL;
                    break;
                case 'symptoms_freundschaften_user':
                    $symptomsFriendship .= $answer->name. PHP_EOL;
                    break;
                case 'symptoms_familie_user':
                    $symptomsFamily .= $answer->name . PHP_EOL;
                    break;
                case 'symptoms_spiritualitaet_user':
                    $symptomsSpirituality .= $answer->name . PHP_EOL;
                    break;
                default:
                    $symptomDefault = 'No symptom found';
            }
        }
    
        //'Gender' => $customerData->gender == 'Männlich' ? 'Male' : 'Female',
        if($customerData->gender == 'Männlich'){
            $gender = 'Male';
        }elseif($customerData->gender == 'Weiblich'){
            $gender = 'Female';
        }else{
            $gender = 'Other';
        }
    
        //Get Salesforce token
        //Forrest::getmytoken();
        Forrest::curlGetToken();

        //Create Lead TODO: Before creating a new lead, do a Lead::where('email', $customerData->email) THIS SHOULD BE NULL
        $lead = new Lead();
        $lead->LastName                         = $customerData->prename; //required by SForce
        $lead->Company                          = $customerData->prename; //required by SForce
        $lead->FirstName                        = $customerData->prename; //required by SForce
        $lead->email                            = $customerData->email; //required by SForce
        $lead->Gender__c                        = $gender;
        $lead->Date_of_Birth__c                 = $customerData->birth;
        $lead->MobilePhone                      = $customerData->phone_number;
        $lead->Overall_Happiness_Score__c       = $scoreCustomer->total_areas;
        $lead->Happiness_Score_Career__c        = $scoreCustomer->beruf_und_karriere;
        $lead->Happiness_Score_Love__c          = $scoreCustomer->partnerschaft;
        $lead->Happiness_Score_Sexuality__c     = $scoreCustomer->sexualitaet;
        $lead->Happiness_Score_Body_Health__c   = $scoreCustomer->koerper_und_gesundheit;
        $lead->Happiness_Score_Friendship__c    = $scoreCustomer->freundschaften;
        $lead->Happiness_Score_Family__c        = $scoreCustomer->familie;
        $lead->Happiness_Score_Spirituality__c  = $scoreCustomer->spiritualitaet;
        $lead->Symptoms_Career__c               = $symptomsCareer;
        $lead->Symptoms_Love__c                 = $symptomsLove;
        $lead->Symptoms_Sexuality__c            = $symptomsSexuality;
        $lead->Symptoms_Body_Health__c          = $symptomsBodayHealth;
        $lead->Symptoms_Friendship__c           = $symptomsFriendship;
        $lead->Symptoms_Family__c               = $symptomsFamily;
        $lead->Symptoms_Spirituality__c         = $symptomsSpirituality;
        $lead->Time_Invest_Willingness__c       = $customerData->time_invest_willingness;
        $lead->Money_Invest_Willingness__c      = $customerData->money_invest_willingness;
        $lead->Newsletter_Opt_in__c             = $customerData->newsletter_opt_in;
        $lead->Call_Opt_in__c                   = $customerData->call_opt_in;
        $lead->Survey_Result_URL__c             = url($customerData->survey_url);

        $lead->save();
    
        // return $lead;
    }
    
}
