<?php

namespace App\Http\Controllers;

use App\Entities\Survey;
use App\Entities\Question;
use App\Entities\Symptom;
use App\Entities\AreaOfLife;
use App\Entities\Answer;
use App\Entities\Customer;
use App\Entities\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendSurveyLink;

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

    public function showResult(Customer $customer)
    {

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

        foreach ($getAreas as $area) {
            $areaObject = (object)[];
            $stgToRemove = ['symptoms_', '_user'];
            $areaName = str_replace($stgToRemove, '', $area);
            
            $stgUserScore = str_replace('symptoms_','score_', $area);
            $userSelectedScore = (int) Answer::where('customer_id', $customer->id)
                                                ->where('reference', 'like', $stgUserScore)
                                                ->pluck('name')
                                                ->first();

            $areaObject->name = str_replace('symptoms_','', $area);
            $symptoms = Answer::where('customer_id', $customer->id)
                                ->where('reference', 'like', $area)
                                ->join('symptoms', 'answers.name', '=', 'symptoms.name')
                                ->orderBy('res_prio', 'DESC')
                                ->get();
            foreach($symptoms as $symptom){
                $symptom->othersHavingThis = (int) ( count(Answer::where('name', $symptom->name)->get()) / (count(Score::all())) * 100 );
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
            $areaObject->userSelectedScore = $userSelectedScore;
            $areaObject->averageAreaScore = (int) $averageAreaScore;

            array_push($resultData, $areaObject);
        }

        $score->total_areas = $userScore;
        $score->save();

        $numberAreas = count($getAreas);
        $maxPotential = round($userScore  * 100 / (10 * $numberAreas)); 
        
        $averageScores = Score::pluck('total_areas');
        $averageHappinessAllParticipants = is_null($averageScores) ? 0 : ( (int) ( ($averageScores)->sum() / count($averageScores)) );

        return view('surveys.result', compact([
            'customer', 
            'resultData', 
            'maxPotential',
            'userScore',
            'numberAreas',
            'averageHappinessAllParticipants'
        ]));

    }


    public function receiveSurvey(Request $request)
    {
        try{
            $fileApi = File::get("simulate/survey_api.txt");
            $dataJson = substr($fileApi, 0, strrpos( $fileApi, '}') + 1);
            $dataArray = json_decode($dataJson, true);

        }
        catch(\Exception $exception){
            
        }

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
                        foreach ($answer['choices']['labels'] as $item) {
                            Answer::create([
                                'name' =>$item,
                                'reference' => $answer['field']['ref'],
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
                        foreach ($answer['choices']['labels'] as $item) {
                            Answer::create([
                                'name' =>$item,
                                'reference' => $answer['field']['ref'],
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
                        foreach ($answer['choices']['labels'] as $item) {
                            Answer::create([
                                'name' =>$item,
                                'reference' => $answer['field']['ref'],
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
                        foreach ($answer['choices']['labels'] as $item) {
                            Answer::create([
                                'name' =>$item,
                                'reference' => $answer['field']['ref'],
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
                        foreach ($answer['choices']['labels'] as $item) {
                            Answer::create([
                                'name' =>$item,
                                'reference' => $answer['field']['ref'],
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
                        foreach ($answer['choices']['labels'] as $item) {
                            Answer::create([
                                'name' =>$item,
                                'reference' => $answer['field']['ref'],
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
                        foreach ($answer['choices']['labels'] as $item) {
                            Answer::create([
                                'name' =>$item,
                                'reference' => $answer['field']['ref'],
                                'customer_id' => $customer->id,
                                'question_id' => $question_id,
                            ]);
                        }
                        break;
    
                    case 'time_invest_user':
                        $customer->time_invest_willingness = $answer['choice']['label'];
                        break;
    
                    case 'money_invest_user':
                        $customer->money_invest_willingness = $answer['choice']['label'];
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
        }

        //send survey email with its own data
        $data = [
            'name'          => $customer->prename,
            'surveyLink'    => url($customer->survey_url) //url helper to take the base url of the project
        ];

        Mail::to($customer->email)
            ->send(new SendSurveyLink($data));

       return redirect('/survey')->with("success", "Survey received and saved successfully");
    }

    public function surveyHook(Request $request)
    {
        // Storage::put('typeform-file.txt', $request);
        // $fileApi = Storage::disk('local')->get('typeform-file.txt');

        // $start= strpos($fileApi, '{');
        // $end= strrpos( $fileApi, '}') + 1;
        // $dataJson = substr($fileApi, $start, $end);
        // $dataArray = json_decode($dataJson, true);

        $dataArray = json_decode(json_encode($request->all()), true);
        //$dataArray = $request->all();

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
                        foreach ($answer['choices']['labels'] as $item) {
                            Answer::create([
                                'name' =>$item,
                                'reference' => $answer['field']['ref'],
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
                        foreach ($answer['choices']['labels'] as $item) {
                            Answer::create([
                                'name' =>$item,
                                'reference' => $answer['field']['ref'],
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
                        foreach ($answer['choices']['labels'] as $item) {
                            Answer::create([
                                'name' =>$item,
                                'reference' => $answer['field']['ref'],
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
                        foreach ($answer['choices']['labels'] as $item) {
                            Answer::create([
                                'name' =>$item,
                                'reference' => $answer['field']['ref'],
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
                        foreach ($answer['choices']['labels'] as $item) {
                            Answer::create([
                                'name' =>$item,
                                'reference' => $answer['field']['ref'],
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
                        foreach ($answer['choices']['labels'] as $item) {
                            Answer::create([
                                'name' =>$item,
                                'reference' => $answer['field']['ref'],
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
                        foreach ($answer['choices']['labels'] as $item) {
                            Answer::create([
                                'name' =>$item,
                                'reference' => $answer['field']['ref'],
                                'customer_id' => $customer->id,
                                'question_id' => $question_id,
                            ]);
                        }
                        break;
    
                    case 'time_invest_user':
                        $customer->time_invest_willingness = $answer['choice']['label'];
                        break;
    
                    case 'money_invest_user':
                        $customer->money_invest_willingness = $answer['choice']['label'];
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
        }

        //send survey email with its own data
        $data = [
            'name'          => $customer->prename,
            'surveyLink'    => url($customer->survey_url) //url helper to take the base url of the project
        ];

        // Mail::to('ubuntu.le.kush@gmail.com')
        //     ->send(new SendSurveyLink($data));

       return redirect('/survey')->with("success", "Survey received and saved successfully");
    }
    
}
