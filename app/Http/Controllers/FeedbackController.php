<?php

namespace App\Http\Controllers;

use App\Entities\Customer;
use App\Entities\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function feedback(Request $request)
    {
        $token = $request->get('token');
        $option = $request->get('option');
        $customer = Customer::where('token', $token)->first();
        $feedback = Feedback::where('customer_id', $customer->id)->first();

        $response = [];

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
