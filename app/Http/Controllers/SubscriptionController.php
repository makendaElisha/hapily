<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Mailjet\ContactSubscriptionService;

class SubscriptionController extends Controller
{
    public function newsletterWebsiteSubscription(Request $request) {

        // (new ContactSubscriptionService)->handleWebsiteSubscription($request);

        // response()->json(['success' => 'success'], 200);

        $lead = $request->json()->get('lead');
        $lead = $request->get('lead');
        $customer = [
            'email' => $request->get('lead')['email'],
            'firstName' => $request->get('lead')['firstName'],
            'lastName' => $request->get('lead')['lastName']
        ];

        $customer_object = (object) $customer;

        (new ContactSubscriptionService)->handleWebsiteSubscription($customer_object);

        return $request->json()->all();
    }
}
