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
    protected const AUTOMATION_NON_SUBSCRIBER_USER_LIST = 29767; //29766 for non subscribers transational list
    protected const WEBSITE_SUBSCRIBER_LIST = 33512;
    protected const NON_CALL_USERS_LIST = 33405;

    /**
     * @param mixed $handleAutomationSubscription
     * @param mixed $customer
     */

    public function handleAutomationSubscription($customer)
    {
        // Body request
        $body = [
            'Name' => $customer->prename,
            'Properties' => ['vorname' => $customer->prename], //use Vorname to match the list vorname
            'Action' => "addnoforce",
            'Email' => $customer->email,
        ];

        try {
            $response = Mailjet::post(Resources::$ContactslistManagecontact, ['id' => self::AUTOMATION_USER_LIST, 'body' => $body]);
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
        $body = [
            'Name' => $customer->prename,
            'Properties' => ['vorname' => $customer->prename], //use Vorname to match the list vorname
            'Action' => "addnoforce",
            'Email' => $customer->email,
        ];

        try {
            $response = Mailjet::post(Resources::$ContactslistManagecontact, ['id' => self::NEWSLETTER_USER_LIST, 'body' => $body]);
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
        $body = [
            'Name' => $customer->prename,
            'Properties' => ['vorname' => $customer->prename], //use Vorname to match the list vorname
            'Action' => "addnoforce",
            'Email' => $customer->email,
        ];

        try {
            $response = Mailjet::post(Resources::$ContactslistManagecontact, ['id' => self::AUTOMATION_NON_SUBSCRIBER_USER_LIST, 'body' => $body]);
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
        $body = [
            'Name' => $payment->buyer_first_name,
            'Properties' => ['vorname' => $payment->buyer_first_name], //need to add webinar session properties but error
            'Action' => "addnoforce",
            'Email' => $payment->buyer_email,
        ];

        try {
            $response = Mailjet::post(Resources::$ContactslistManagecontact, ['id' => self::WEBINAR_PAID_USER_LIST, 'body' => $body]);
        } catch (\Exception $e) {
            // logger()->error('error adding subscriber to list: ' . $e->getMessage(), $payment->buyer_first_name);
            Storage::put('error.txt', $e);
        }
    }

    /**
     * @param mixed $handlePaidUserSubscription
     * @param mixed $payment
     */

    public function handleWebsiteSubscription($request)
    {
        /* Body request */
        $body = [
            'Name' => $request->firstName . " " . $request->lastName,
            'Properties' => ['vorname' => $request->firstName],
            'Action' => "addnoforce",
            'Email' => $request->email,
        ];

        try {
            $response = Mailjet::post(Resources::$ContactslistManagecontact, ['id' => self::WEBSITE_SUBSCRIBER_LIST, 'body' => $body]);
        } catch (\Exception $e) {
            logger()->error('Error adding subscriber to list: ' . $e->getMessage(), $request->firstName);
        }
    }

    /**
     * @param mixed $handleNonCallOptinUsers
     * @param mixed $payment
    */

    public function handleNonCallOptinUsers($customer)
    {
        // Body request
        $body = [
            'Name' => $customer->prename,
            'Properties' => ['vorname' => $customer->prename], //use Vorname to match the list vorname
            'Action' => "addnoforce",
            'Email' => $customer->email,
        ];

        try {
            $response = Mailjet::post(Resources::$ContactslistManagecontact, ['id' => self::NON_CALL_USERS_LIST, 'body' => $body]);
        } catch (\Exception $e) {
            logger()->error('Error adding subscriber to list: ' . $e->getMessage(), $customer->prename);
        }
    }

}