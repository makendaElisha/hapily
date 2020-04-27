<?php

namespace App\Entities;

use Lester\EloquentSalesForce\Model;

class Lead extends Model
{
    /**
     * @param salesforceColumns
     * @return array
     */

    public $columns = [
        'FirstName__c',
        'email__c',
        'Gender__c',
        'Date_of_Birth__c',
        'MobilePhone__c',
        'Overall_Happiness_Score__c',
        'Happiness_Score_Career__c',
        'Happiness_Score_Love__c',
        'Happiness_Score_Sexuality__c',
        'Happiness_Score_Body_Health__c',
        'Happiness_Score_Friendship__c',
        'Happiness_Score_Family__c',
        'Happiness_Score_Spirituality__c',
        'Symptoms_Career__c',
        'Symptoms_Love__c',
        'Symptoms_Sexuality__c',
        'Symptoms_Body_Health__c',
        'Symptoms_Friendship__c',
        'Symptoms_Family__c',
        'Symptoms_Spirituality__c',
        'Time_Invest_Willingness__c',
        'Money_Invest_Willingness__c',
        'Newsletter_Opt_in__c',
        'Call_Opt_in__c',
        'Survey_Result_URL__c',
    ];
}
