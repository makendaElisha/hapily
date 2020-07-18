<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Mailjet\ContactSubscriptionService;

class SubscriptionController extends Controller
{
    public function newsletterWebsiteSubscription(Request $request) {

        (new ContactSubscriptionService)->handleWebsiteSubscription($request);

        response()->json(['success' => 'success'], 200);
    }
}
