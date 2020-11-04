<?php

namespace App\Http\Controllers;

use App\Mail\SendPdfBook;
use App\Entities\Customer;
use App\Entities\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Services\Mailjet\ContactSubscriptionService;

class FeedbackController extends Controller
{
    public function feedback(Request $request)
    {
        $token = $request->get('token');
        $option = $request->get('option');
        $customer = Customer::where('token', $token)->first();
        $feedback = Feedback::where('customer_id', $customer->id)->first();

        $response = [];

        if ($option == "option5") { // do subscribption
            $customer->newsletter_opt_in = 1;
            $customer->save();

            if(!$feedback){
                $feedback = new Feedback();
                $feedback->customer_id = $customer->id;
                $feedback->token = $token;
                $feedback->option5 = true;
                $feedback->save();
            } else {
                $feedback->option5 = true;
                $feedback->save();
            }

            //subscribe the user to the newsletter
            (new ContactSubscriptionService)->handleNewsletterSubscription($customer);

            //send pdf email
            $data = [
                'name'          => $customer->prename,
                'bookLink'    => "https://drive.google.com/file/d/1wbCcpje5X_8bEZE4sPBUlGfS4bHU4j9f/view"
            ];
    
            try{
                Mail::to($customer->email)
                    ->send(new SendPdfBook($data));
            } catch (\Exception $e) {
                // Never reached
            }

            $response = [
                'message' => 'set-to-true'
            ];

            return $response;

        } else {

            if(!$feedback){
                $feedback = new Feedback();
                $feedback->customer_id = $customer->id;
                $feedback->token = $token;
                if($feedback->{$option} == false) {
                    $feedback->{$option} = true;
                    $response = [
                        'message' => 'set-to-true'
                    ];
                } else {
                    $feedback->{$option} = false;
                    $response = [
                        'message' => 'set-to-false'
                    ];
                }
            } else {
                if($feedback->{$option} == false) {
                    $feedback->{$option} = true;
                    $response = [
                        'message' => 'set-to-true'
                    ];
                } else {
                    $feedback->{$option} = false;
                    $response = [
                        'message' => 'set-to-false'
                    ];
                }
            }
    
            $feedback->save();
            
            return $response;
        }
    }
}
