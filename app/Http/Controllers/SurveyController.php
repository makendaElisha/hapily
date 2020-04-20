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
        $score = Score::create([
            'customer_id' => $customer->id,
        ]);

        $getAreas = Question::where('reference', 'like', 'symptoms_%')->pluck('reference');
        $data = [];
        $userScore = 0;
        $maxPotential = 0; 

        foreach ($getAreas as $area) {
            $areaObject = (object)[];
            $stgToRemove = ['symptoms_', '_user'];
            $areaName = str_replace($stgToRemove, '', $area);

            $areaObject->name = str_replace('symptoms_','', $area);
            $symptoms = Answer::where('customer_id', $customer->id)
                                        ->where('reference', 'like', $area)
                                        ->leftJoin('symptoms', 'answers.name', '=', 'symptoms.name')
                                        ->orderBy('anger', 'DESC')
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
            $score->save();

            $userScore += $areaScore;

            $getPerAreaScores = Score::pluck($areaName);
            $averageAreaScore = is_null($getPerAreaScores) ? 0 : (($getPerAreaScores)->sum() / count($getPerAreaScores));

            $areaObject->symptoms = $symptoms;
            $areaObject->areaScore = $areaScore;
            $areaObject->averageAreaScore = $averageAreaScore;

            array_push($data, $areaObject);
        }
    
        $score->total_areas = $userScore;
        $score->save();

        $numberAreas = count($getAreas);
        $maxPotential = round($userScore  * 100 / (10 * $numberAreas)); 
        
        $averageScores = Score::pluck('total_areas');
        $averageHappinessAllParticipants = is_null($averageScores) ? 0 : (($averageScores)->sum() / count($averageScores));


        return view('surveys.result', compact([
            'customer', 
            'data', 
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

        if($dataArray){
            
            $resultToken = md5(uniqid(rand(), true)); //Make shorter
            $answers = $dataArray["form_response"]["answers"];
            // $questions = $dataArray["form_response"]["definition"]["fields"];

            //Create A New Customer User
            $customer = Customer::create([
                'first_name' => $answers[0]["text"],
                'last_name' => $answers[0]["text"],
                'email' => $answers[1]["email"],
                'birth' => $answers[2]["date"],
                'gender' => $answers[3]["choice"]["label"],
                'postal_code' => $answers[4]["number"],
                'time_invest_willingness' => $answers[21]["choice"]["label"],
                'money_invest_willingness' => $answers[22]["choice"]["label"],
                'call_opt_in' => $answers[23]["boolean"],
                'phone_number' => "0999015",
                'newsletter_opt_in' => $answers[24]["boolean"],
                'network_id' => "10",
                'submit_date' => $dataArray["form_response"]["submitted_at"],
                'start_date' => $dataArray["form_response"]["landed_at"],
                'survey_url' => "/survey/result/". $resultToken,
                'token' => $resultToken,
            ]);

            //Create answers
            foreach ($answers as $answer) {
                if (array_key_exists('choice', $answer)) {
                    $question = Question::where('reference', $answer['field']['ref'])->first();
                    !is_null($question) ? $question_id = $question->id : $question_id = null;
                    
                    Answer::create([
                        'name' => $answer['choice']['label'],
                        'reference' => $answer['field']['ref'],
                        'customer_id' => $customer->id,
                        'question_id' => $question_id,
                    ]);
                }elseif(array_key_exists('choices', $answer)) {
                    foreach ($answer['choices']['labels'] as $item) {
                        $question = Question::where('reference', $answer['field']['ref'])->first();
                        !is_null($question) ? $question_id = $question->id : $question_id = null;
                        
                        Answer::create([
                            'name' =>$item,
                            'reference' => $answer['field']['ref'],
                            'customer_id' => $customer->id,
                            'question_id' => $question_id,
                        ]);
                    }
                }
                else{
                    $question = Question::where('reference', $answer['field']['ref'])->first();
                    !is_null($question) ? $question_id = $question->id : $question_id = null;
                    $key = array_keys($answer)[1];

                    Answer::create([
                        'reference' => $answer['field']['ref'],
                        'customer_id' => $customer->id,
                        'name' => $answer[$key],
                        'question_id' => $question_id,
                    ]);
                }
            }

        }

        //send survey email with its own data
        $data = [
            'name'          => $customer->first_name,
            'surveyLink'    => url($customer->survey_url) //url helper to take the base url of the project
        ];

        Mail::to('python.gralf@gmail.com')
            ->send(new SendSurveyLink($data));

       return redirect('/survey')->with("success", "Survey received and saved successfully");
    }

    
}
