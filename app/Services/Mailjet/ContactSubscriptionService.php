<?php

namespace App\Services\Mailjet;


use Mailjet\Resources;
use Illuminate\Support\Facades\Storage;
use Mailjet\LaravelMailjet\Facades\Mailjet;
use Mailjet\LaravelMailjet\Contracts\CampaignDraftContract;


/**
 * Class ContactSubscriptionService
 * @package App\Services\Mailjet
 */
class ContactSubscriptionService
{

    protected const AUTOMATION_USER_LIST = 25890;
    protected const NEWSLETTER_USER_LIST = 25335;
    protected const WEBINAR_PAID_USER_LIST = 28521;
    protected const AUTOMATION_NON_SUBSCRIBER_USER_LIST = 34235; //29766 for non subscribers transational list
    protected const NON_CALL_USERS_LIST_TRANSACTIONAL = 33405;
    protected const NON_CALL_USERS_LIST_AUTOMATION = 33840;
    protected const TEST_LIST = 35338;

    /**
     * @param mixed $handleAutomationSubscription
     * @param mixed $customer
     */

    public function handleAutomationSubscription($customer)
    {
        // Body request
        /*
        $body = [
            'Name' => $customer->prename,
            'Properties' => ['vorname' => $customer->prename], //use Vorname to match the list vorname
            'Action' => "addnoforce",
            'Email' => $customer->email,
        ];*/

        $body = [
            'Action' => "addnoforce",
            'Contacts' => [
              [
                'Email' => $customer->email,
                'Name' => $customer->prename,
                'Properties' => ['vorname' => $customer->prename],
              ]
            ]
        ];

        try {
            $response = Mailjet::post(Resources::$ContactslistManagemanycontacts, ['id' => self::AUTOMATION_USER_LIST, 'body' => $body]);
        } catch (\Exception $e) {
            logger()->error('Error adding subscriber to list: ' . $e->getMessage(), $customer->prename);
        }
    }


    /**
     * @param mixed $handleNewsletterSubscription
     * @param mixed $customer
     */

    public function handleNewsletterSubscription($customer)
    {
        /* Body request */
        /*
        $body = [
            'Name' => $customer->prename,
            'Properties' => ['vorname' => $customer->prename], //use Vorname to match the list vorname
            'Action' => "addnoforce",
            'Email' => $customer->email,
        ];
        */

        $body = [
            'Action' => "addnoforce",
            'Contacts' => [
              [
                'Email' => $customer->email,
                'Name' => $customer->prename,
                'Properties' => ['vorname' => $customer->prename],
              ]
            ]
        ];

        try {
            $response = Mailjet::post(Resources::$ContactslistManagemanycontacts, ['id' => self::NEWSLETTER_USER_LIST, 'body' => $body]);
        } catch (\Exception $e) {
            logger()->error('error adding subscriber to list: ' . $e->getMessage(), $customer->prename);
        }
    }


    /**
     * @param mixed $handleNonSubscribersAutomation
     * @param mixed $customer
     */

    public function handleNonSubscribersAutomation($customer)
    {
        // Body request
        /*
        $body = [
            'Name' => $customer->prename,
            'Properties' => ['vorname' => $customer->prename], //use Vorname to match the list vorname
            'Action' => "addnoforce",
            'Email' => $customer->email,
        ];*/

        $body = [
            'Action' => "addnoforce",
            'Contacts' => [
              [
                'Email' => $customer->email,
                'Name' => $customer->prename,
                'Properties' => ['vorname' => $customer->prename],
              ]
            ]
        ];

        try {
            $response = Mailjet::post(Resources::$ContactslistManagemanycontacts, ['id' => self::AUTOMATION_NON_SUBSCRIBER_USER_LIST, 'body' => $body]);
        } catch (\Exception $e) {
            logger()->error('Error adding subscriber to list: ' . $e->getMessage(), $customer->prename);
        }
    }
    

    /**
     * @param mixed $handlePaidUserSubscription
     * @param mixed $payment
     */

    public function handlePaidUserSubscription($payment)
    {
        /* Body request */
        /*
        $body = [
            'Name' => $payment->buyer_first_name,
            'Properties' => ['vorname' => $payment->buyer_first_name], //need to add webinar session properties but error
            'Action' => "addnoforce",
            'Email' => $payment->buyer_email,
        ];*/

		$body = [
            'Action' => "addnoforce",
            'Contacts' => [
              [
                'Email' => $payment->buyer_email,
                'Name' => $payment->buyer_first_name,
                'Properties' => ['vorname' => $payment->buyer_first_name,],
              ]
            ]
        ];

        try {
            $response = Mailjet::post(Resources::$ContactslistManagemanycontacts, ['id' => self::WEBINAR_PAID_USER_LIST, 'body' => $body]);
        } catch (\Exception $e) {
            // logger()->error('error adding subscriber to list: ' . $e->getMessage(), $payment->buyer_first_name);
            Storage::put('error.txt', $e);
        }
    }

    /**
     * @param mixed $handleNonCallOptinUsers
     * @param mixed $payment
     */

    public function handleNonCallOptinUsers($customer)
    {
        // Body request
        // $body = [
        //     'Name' => $customer->prename,
        //     'Properties' => ['vorname' => $customer->prename], //use Vorname to match the list vorname
        //     'Action' => "addnoforce",
        //     'Email' => $customer->email,
        // ];

        $body = [
            'Action' => "addnoforce",
            'Contacts' => [
              [
                'Email' => $customer->email,
                'Name' => $customer->prename,
                'Properties' => ['vorname' => $customer->prename],
              ]
            ]
        ];

        try {
            $response = Mailjet::post(Resources::$ContactslistManagemanycontacts, ['id' => self::NON_CALL_USERS_LIST_TRANSACTIONAL, 'body' => $body]);
        } catch (\Exception $e) {
            logger()->error('Error adding subscriber to list: ' . $e->getMessage(), $customer->prename);
        }
    }


    public function handleNonCallOptinUsersAutomation($customer)
    {
        // Body request
        // $body = [
        //     'Name' => $customer->prename,
        //     'Properties' => ['vorname' => $customer->prename], //use Vorname to match the list vorname
        //     'Action' => "addnoforce",
        //     'Email' => $customer->email,
        // ];

        $body = [
            'Action' => "addnoforce",
            'Contacts' => [
              [
                'Email' => $customer->email,
                'Name' => $customer->prename,
                'Properties' => ['vorname' => $customer->prename],
              ]
            ]
        ];

        try {
            $response = Mailjet::post(Resources::$ContactslistManagemanycontacts, ['id' => self::NON_CALL_USERS_LIST_AUTOMATION, 'body' => $body]);
        } catch (\Exception $e) {
            logger()->error('Error adding subscriber to list: ' . $e->getMessage(), $customer->prename);
        }
    }
    
    //Test List
    public function handleTestSubscription($customer)
    {
        // Body request
		$body = [
		  'Action' => "addnoforce",
		  'Contacts' => [
			[
			  'Email' => $customer->email,
			  'Name' => $customer->prename,
			  'Properties' => ['vorname' => $customer->prename],
			]
		  ]
		];

        try {
            $response = Mailjet::post(Resources::$ContactslistManagemanycontacts, ['id' => self::TEST_LIST, 'body' => $body]);
        } catch (\Exception $e) {
            logger()->error('Error adding subscriber to list: ' . $e->getMessage(), $customer->prename);
        }
	}

}
