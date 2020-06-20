<?php

namespace App\Services\Salesforce;

use App\Entities\Score;
use App\Entities\Answer;
use Illuminate\Support\Facades\Log;


/**
 * Class ContactSubscriptionService
 * @package App\Services\Mailjet
 */
class LeadCreationService
{

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

        $priorityAreaOfLife     = '';
    
        //Normal Symptoms
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

        //Saving Other Symptoms choosen by user per area of life
        foreach($answersCustomer as $answer) {
            switch ($answer->reference) {
                case 'other_symptoms_beruf_und_karriere_user':
                    $symptomsCareer .= 'Other Symptom - ' . $answer->name . PHP_EOL;
                    break;
                case 'other_symptoms_partnerschaft_user':
                    $symptomsLove .= 'Other Symptom - ' . $answer->name . PHP_EOL;
                    break;
                case 'other_symptoms_sexualitaet_user':
                    $symptomsSexuality .= 'Other Symptom - ' . $answer->name . PHP_EOL;
                    break;
                case 'other_symptoms_koerper_und_gesundheit_user':
                    $symptomsBodayHealth .= 'Other Symptom - ' . $answer->name . PHP_EOL;
                    break;
                case 'other_symptoms_freundschaften_user':
                    $symptomsFriendship .= 'Other Symptom - ' . $answer->name. PHP_EOL;
                    break;
                case 'other_symptoms_familie_user':
                    $symptomsFamily .= 'Other Symptom - ' . $answer->name . PHP_EOL;
                    break;
                case 'other_symptoms_spiritualitaet_user':
                    $symptomsSpirituality .= 'Other Symptom - ' . $answer->name . PHP_EOL;
                    break;
                default:
                    $symptomDefault = '';
            }
        }

        //saving priority area of life
        foreach($answersCustomer as $answer) {
            switch ($answer->reference) {
                case 'priority_area_of_life_user':
                    $priorityAreaOfLife .= $answer->name . PHP_EOL;
                    break;
                default:
                    $priorityAreaOfLife = '';
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
            $timeInvest = '';
        }else {
            $timeInvest = $customerData->time_invest_willingness;
        }
        
        if($customerData->money_invest_willingness == null){
            $moneyInvest = '';
        }else {
            $moneyInvest = $customerData->money_invest_willingness;
        }
        
        if($customerData->newsletter_opt_in == 0){
            $newsletter = 0;
        }else {
            $newsletter = $customerData->newsletter_opt_in;
        }
        
        if($customerData->call_opt_in == 0){
            $callOptin = 0;
        }else {
            $callOptin = $customerData->call_opt_in;
        }
        
        if(($customerData->call_opt_in == 0) || (is_null($customerData->phone_number))){
            $phoneNumber = '';
        } else {
            $phoneNumber = $customerData->phone_number; //Should not be null
        }
        
        $leadContent = [
            'FirstName'                         => $customerData->prename, //required by Salesforce
            'LastName'                          => $customerData->prename, //required by Salesforce
            'Company'                           => $customerData->prename, //required by Salesforce
            'Email'                             => $customerData->email, //required by Salesforce
            'Title'                             => $title,
            'PostalCode'                        => $customerData->postal_code,
            'Gender__c'                         => $gender,
            'Date_of_Birth__c'                  => $customerData->birth,
            'MobilePhone'                       => $phoneNumber,
            'Overall_Happiness_Score__c'        => $scoreCustomer->total_areas ?? 0,
            'Happiness_Score_Career__c'         => $scoreCustomer->beruf_und_karriere ?? 0,
            'Happiness_Score_Love__c'           => $scoreCustomer->partnerschaft ?? 0,
            'Happiness_Score_Sexuality__c'      => $scoreCustomer->sexualitaet ?? 0,
            'Happiness_Score_Body_Health__c'    => $scoreCustomer->koerper_und_gesundheit ?? 0,
            'Happiness_Score_Friendship__c'     => $scoreCustomer->freundschaften ?? 0,
            'Happiness_Score_Family__c'         => $scoreCustomer->familie ?? 0,
            'Happiness_Score_Spirituality__c'   => $scoreCustomer->spiritualitaet ?? 0,
            'Symptoms_Career__c'                => $symptomsCareer ?? '',
            'Symptoms_Love__c'                  => $symptomsLove ?? '',
            'Symptoms_Sexuality__c'             => $symptomsSexuality ?? '',
            'Symptoms_Body_Health__c'           => $symptomsBodayHealth ?? '',
            'Symptoms_Friendship__c'            => $symptomsFriendship ?? '',
            'Symptoms_Family__c'                => $symptomsFamily ?? '',
            'Symptoms_Spirituality__c'          => $symptomsSpirituality ?? '',
            'Priority_Area_of_Life__c'          => $priorityAreaOfLife ?? '',
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
            Log::error("Error: call to URL $postUrl failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl), ['context' => 'Salesforce API Create Lead']);
            die("Error: call to URL $postUrl failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        }
        
        curl_close($curl);
    
        $response = json_decode($json_response, true);
    
        $id = $response["id"];
    
    }


    /**
     * Get Salesforce Token
     * @return salesforce token
    */
    public function curlGetTokenSalesForce()
    {
        $url = 'https://login.salesforce.com/services/oauth2/token';
        $client_id      = config('services.salesforce.client_id');
        $client_secret  = config('services.salesforce.client_secret');
        $username       = config('services.salesforce.username');
        $password       = config('services.salesforce.password');
        $token          = config('services.salesforce.token');

        $passwordAndToken = $password . $token;
        
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
                        'client_id'     => $client_id,
                        'client_secret' => $client_secret,
                        'username'      => $username,
                        'password'      => $passwordAndToken
                    )
                )
            )
        );

        $response = json_decode(curl_exec($curl), true); //true to get array
        curl_close($curl);

        return $response;
    }

}
