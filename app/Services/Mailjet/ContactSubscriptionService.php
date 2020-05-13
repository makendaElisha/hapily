<?php

namespace App\Services\Mailjet;


use Mailjet\Resources;
use Mailjet\LaravelMailjet\Facades\Mailjet;
use Mailjet\LaravelMailjet\Contracts\CampaignDraftContract;


/**
 * Class VideoPaymentService
 * @package App\Services\Mailjet
 */
class ContactSubscriptionService
{

    /**
     * @param mixed $handleSubscription
     */

    public function handleSubscription($customer)
    {

        // Survey_Users;
        $list_id = 25221;

        $body = [
            'Name' => $customer->prename,
            'Properties' => ['vorname' => $customer->prename], //use Vorname to match the list vorname
            'Action' => "addnoforce",
            'Email' => $customer->email,
        ];

        try {
            $response = Mailjet::post(Resources::$ContactslistManagecontact, ['id' => $list_id, 'body' => $body]);
        } catch (\Exception $e) {
            logger()->error('error adding subscriber to list: ' . $e->getMessage(), $customer->prename);
        }
    }
}