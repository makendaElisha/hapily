<?php

namespace App\Services\Survey;

use App\Entities\Score;
use App\Entities\Answer;
use App\Entities\Symptom;
use App\Entities\Customer;
use App\Entities\Question;
use App\Entities\AreaOfLife;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ReceivedSurveyDataService 
{
    /**
     * Create Customer and save both Answers and Scores.
     *
     * @return App\Entities\Customer
     */
    public function save($dataArray) : Customer
    {
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
                        $customer->birth = $answer['date']; //N.B. If date is giving issues, send a null or '' to SF
                        break;
    
                    case 'gender_user':
                        $customer->gender = $answer['choice']['label'];
                        break;

                    case 'become_coach':
                        if(array_key_exists('label', $answer['choices']) && !is_null($answer['choices']['label'])){
                            $customer->become_coach = $answer['choice']['label'];
                        } else {
                            if(array_key_exists('other', $answer['choices'])) {
                                $customer->become_coach = $answer['choice']['label'];
                            } else {
                                $customer->become_coach = null;
                            }
                        }
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

                    case 'priority_area_of_life_user':
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

        return $customer;
    }

}