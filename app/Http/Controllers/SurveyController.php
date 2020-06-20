<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
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
use Illuminate\Support\Facades\Notification;

use App\Notifications\SurveySlackNotification;
use App\Services\Mailjet\ContactSubscriptionService;
use App\Services\Survey\ReceivedSurveyDataService;
use App\Services\Salesforce\LeadCreationService;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$customers = Customer::all();
        $customers = Customer::orderBy('id', 'desc')->get();

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
        // the start of each age-range.
        $ranges = [
            '18-30' => 18,
            '31-45' => 31,
            '46-60' => 46,
            '60+' => 60
        ];
        
        $customersPerAgeRanges = Customer::all()
            ->map(function ($customer) use ($ranges) {
                $age = Carbon::parse($customer->birth)->age;
                foreach($ranges as $key => $breakpoint)
                {
                    if ($breakpoint >= $age)
                    {
                        $customer->range = $key;
                        break;
                    }
                }
        
                return $customer;
            })
            ->mapToGroups(function ($customer, $key) {
                return [$customer->range => $customer];
            })
            ->map(function ($group) {
                return count($group);
            })
            ->sortKeys();

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
            'areasOfLife',
            'customersPerAgeRanges',
        ]));
    }

    /**
     * Receive callback and store relevant data.
     *
     * @return \Illuminate\Http\Response
     */
    public function surveyHook(Request $request)
    {
        try {
            Storage::prepend('survey_submission.txt', '----' . json_encode($request->all()) . '----');
        } catch (\Exception $e) {
            logger()->error('Error appending new survey to file: ' . $e->getMessage());
        }

        $dataArray = json_decode(json_encode($request->all()), true);

        //Save data received from survey and return the customer created.
        $customer = (new ReceivedSurveyDataService)->save($dataArray);
    
        //send survey email with its own data using Mailjet
        $data = [
            'name'          => $customer->prename,
            'surveyLink'    => url($customer->survey_url)
        ];

        Mail::to($customer->email)
            ->send(new SendSurveyLink($data));
        
        //Create Salesforce Lead N.B. This wont work when using webhook test because webhook doesn't create score and all of that
        //$this->createLead($customer); //Using curl
        (new LeadCreationService)->createLead($customer);

        //Subscribe User to list for automation
        (new ContactSubscriptionService)->handleAutomationSubscription($customer);

        //Subscribe User to newsletter if opted to newsletter
        //If subscriber didn't opt, put him in the non subscriber list for one automation only
        if ($customer->newsletter_opt_in == 1) {
            (new ContactSubscriptionService)->handleNewsletterSubscription($customer);
        } else {
            (new ContactSubscriptionService)->handleNonSubscribersAutomation($customer);
        }

        //Send a slack notification
        Notification::route('slack', config('services.slack.webhook'))->notify(new SurveySlackNotification($customer));

       //return redirect('/survey')->with("success", "Survey received and saved successfully");
       return 'Survey received and saved successfully';
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

    //get salesforce token was here

    //createLead function was here

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

        } catch(\Exception $e){
            logger()->error('Error getting survey file to simulate: ' . $e->getMessage());
        }
    
        $customer = (new ReceivedSurveyDataService)->save($dataArray);

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

    //createLead old function was here
    
}
