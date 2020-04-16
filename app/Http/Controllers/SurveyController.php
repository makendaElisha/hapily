<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Survey;
use App\Entities\Question;
use App\Entities\Mapping;
use App\Entities\Answer;
use App\Entities\Customer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
  

    public function userResult($token)
    {
        $customer = Customer::where('token', 'like', $token)->first();

        // $userAnswers = Answer::where('customer_id', $customer->id)->get();

        // $userSymptoms = Answer::where('customer_id', $customer->id)
        //                         ->where('reference', 'like', 'symptoms_%')->get();

        // $userScores = Answer::where('customer_id', $customer->id)
        //                         ->where('reference', 'like', 'score_%')->get();

        $getAreas = Question::where('reference', 'like', 'symptoms_%')->pluck('reference');
        
        $allAreasResults = [];
        $totalAllAreasHappiness = 0;
        $percentageMaxPotential = 0;

        foreach ($getAreas as $area) {
            $areaObject = (object)[];
            $areaObject->name = str_replace('symptoms_','', $area);
            $symptoms = Answer::where('customer_id', $customer->id)
                                        ->where('reference', 'like', $area)->get();

            $stg = str_replace('symptoms', 'score', $area);
            $baseScore = (int) Answer::where('customer_id', $customer->id)
                                            ->where('reference', 'like', $stg)
                                            ->pluck('title')
                                            ->first();
            $maxSubNumber = 50 * $baseScore / 100;
            $symptomsNumber = 7; //Real value to be calculated
            $selectedSymptomsNumber = count($symptoms);
            $pointPerSymptom = $maxSubNumber / $symptomsNumber;
            $totalScoreSymptoms = $pointPerSymptom * $selectedSymptomsNumber;


            $scoreAreaOfLife = (int) floor($baseScore - $totalScoreSymptoms);
            
            $totalAllAreasHappiness += $scoreAreaOfLife;

            $averageHappinessPerArea = 25; //Real value to be calculated

            $areaObject->symptoms = $symptoms;
            $areaObject->scoreAreaOfLife = $scoreAreaOfLife;
            $areaObject->averageHappinessPerArea = $averageHappinessPerArea;

            array_push($allAreasResults, $areaObject);
        }

        $percentageMaxPotential = round($totalAllAreasHappiness  * 100 / (10 * count($getAreas))); 
        $numberAreas = count($getAreas);
        $totalScoreAverage = 0; //Must we recalculate everytime or me store it?
        $averagePerArea = 0; //Must recalculate for each or once!



        return view('surveys.result', compact([
            'customer', 
            'allAreasResults', 
            'percentageMaxPotential',
            'totalAllAreasHappiness',
            'numberAreas',
            ]));

    }


    public function receiveSurvey(Request $request)
    {
        try{
            $fileApi = File::get("E:/AA/file.txt");
            $dataJson = substr($fileApi, 0, strrpos( $fileApi, '}') + 1);
            $dataArray = json_decode($dataJson, true);

        }
        catch(\Exception $exception){
            
        }

        if($dataArray){
            
            $resultToken = md5(uniqid(rand(), true));
            $answers = $dataArray["form_response"]["answers"];
            $questions = $dataArray["form_response"]["definition"]["fields"];

            //Create A New Customer User
            $customer = Customer::create([
                // "name" => $answers[0]["text"],
                // "email" => $answers[0]["email"],
                'first_name' => $answers[0]["text"],
                'last_name' => $answers[0]["text"],
                'email' => $answers[1]["email"],
                'birth' => $answers[2]["date"],
                'gender' => $answers[3]["choice"]["label"],
                'postal_code' => $answers[4]["number"],
                'haveKids' => $answers[5]["boolean"],
                'time_invest_willingness' => $answers[21]["choice"]["label"],
                'money_invest_willingness' => $answers[22]["choice"]["label"],
                'call_opt_in' => $answers[23]["boolean"],
                // 'phone_number' => $answers[0][" "],
                'phone_number' => "0999015",
                'newsletter_opt_in' => $answers[24]["boolean"],
                'network_id' => "10",
                'submit_date' => $dataArray["form_response"]["submitted_at"],
                'start_date' => $dataArray["form_response"]["landed_at"],
                'survey_url' => "/survey/result/". $resultToken,
                'token' => $resultToken,
            ]);

           // Create questions
            foreach ($questions as $question) {
                Question::create([
                    'title' =>$question['title'],
                    'reference' =>$question['ref'],
                    'customer_id' =>$customer->id,
                ]);
            } // TO BE REMOVED

            //Create answers
            foreach ($answers as $answer) {
                if (array_key_exists('choice', $answer)) {
                    $question = Question::where('reference', $answer['field']['ref'])->first();
                    !is_null($question) ? $question_id = $question->id : $question_id = null;
                    
                    $title = $answer['choice']['label'];
                    $mapping = Mapping::where('symptom_title', $title)->first();
                    !is_null($mapping) ? $res_prio = $mapping->res_prio : $res_prio = null;

                    Answer::create([
                        'title' => $title,
                        'reference' => $answer['field']['ref'],
                        'customer_id' => $customer->id,
                        'res_prio' => $res_prio,
                        'question_id' => $question_id,
                    ]);
                }elseif(array_key_exists('choices', $answer)) {
                    foreach ($answer['choices']['labels'] as $item) {
                        $question = Question::where('reference', $answer['field']['ref'])->first();
                        !is_null($question) ? $question_id = $question->id : $question_id = null;
                        
                        $title = $item;
                        $mapping = Mapping::where('symptom_title', $title)->first();
                        !is_null($mapping) ? $res_prio = $mapping->res_prio : $res_prio = null;


                        Answer::create([
                            'title' =>$title,
                            'reference' => $answer['field']['ref'],
                            'customer_id' =>$customer->id,
                            'res_prio' => $res_prio,
                            'question_id' => $question_id,
                        ]);
                    }
                }
                else{
                    $question = Question::where('reference', $answer['field']['ref'])->first();
                    !is_null($question) ? $question_id = $question->id : $question_id = null;
                    
                    $title = $answer['field']['ref'];
                    $mapping = Mapping::where('symptom_title', $title)->first();
                    !is_null($mapping) ? $res_prio = $mapping->res_prio : $res_prio = null;

                    $key = array_keys($answer)[1];

                    Answer::create([
                        'reference' => $title,
                        'customer_id' => $customer->id,
                        'title' => $answer[$key],
                        'res_prio' => $res_prio,
                        'question_id' => $question_id,
                    ]);
                    
                }
            }

        }

       return redirect('/survey')->with("success", "Survey received and saved successfully");
    }

    
}
