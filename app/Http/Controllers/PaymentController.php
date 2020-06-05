<?php

namespace App\Http\Controllers;

use App\Entities\Payment;
use App\Entities\Customer;
use Illuminate\Http\Request;
use App\Services\Mailjet\ContactSubscriptionService;

class PaymentController extends Controller
{
    //define( 'IPN_PASSPHRASE', '' );
    //CONST IPN_PASSPHRASE = 'IPN_PASS_#_2020';
    CONST IPN_PASSPHRASE ='';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entities\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }


    /**
     * Returning Digistore Signature
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  var $ipn_passphrase
     * @return var $sha_sign
     */
    function digistore_signature($ipn_passphrase, Request $request)
    {
        $request->except('sha_sign');
        $keys = array_keys($request->post());
        sort($keys);
        $sha_string = "";
        foreach ($keys as $key)
        {
            $value = html_entity_decode($request->post($key));
            $is_empty = !isset($value) || $value === "" || $value === false;
            if ($is_empty)
            {
                continue;
            }
            $sha_string .= "$key=$value$ipn_passphrase";
        }
        $sha_sign = strtoupper(hash("sha512", $sha_string));
        return $sha_sign;
    }


    /**
     * Returning posted var value
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  var $varname
     * @return var $var value
    */
    public function posted_value($varname, Request $request)
    {
        return empty($request->post($varname)) ? '' : $request->post($varname);
    }


    /**
     * Returning posted var value
     *
     * @param  \Illuminate\Http\Request  $request
     * @return $vars /posted values
    */
    public function digiStore(Request $request) {

        $event    = $this->posted_value($request->post('event'), $request);
        $api_mode = $this->posted_value($request->post('api_mode'), $request); // 'live' or 'test'
        $ipn_data = $request->all();
        $must_validate_signature = SELF::IPN_PASSPHRASE != '';

        try {
            if ($must_validate_signature)
            {
                $received_signature = $this->posted_value('sha_sign', $request);
                $expected_signature = $this->digistore_signature(SELF::IPN_PASSPHRASE, $request);
                $sha_sign_valid = $received_signature == $expected_signature;
            
                if (!$sha_sign_valid)
                {
                    die('ERROR: invalid sha signature');
                }
            }

            //find customer if he exists based on the email
            $customer = Customer::where('email', $request->post('email'))->first();
            if(!is_null($customer)){
                $customerId = $customer->id;
            } else {
                $customerId = null;
            }

            //insert into db and do  [see doc for more details]
            $payment = new Payment();
            $payment->customer_id           = $customerId;
            $payment->payment_type          = $request->post('event');
            $payment->payment_method        = $request->post('pay_method');
            $payment->product_name          = $request->post('product_name');
            $payment->order_date_time       = $request->post('order_date');
            $payment->transaction_amount    = $request->post('transaction_amount');
            $payment->buyer_email           = $request->post('email');
            $payment->address_first_name    = $request->post('address_first_name');
            $payment->address_last_name     = $request->post('address_last_name');
            $payment->save();


            //subscribe the user to the paid user list 
            //if integration to mailjet has an issue, have a notice on the form that we are writting this because you have purchased
            (new ContactSubscriptionService)->handlePaidUserSubscription($payment);


            //one of our product
            //table can have customer_id that we can find using the email / 
            //customer_id will be nullable and on the payment, customer will take to survey result

            $file_name = 'payment-result.txt';   
            $is_created = Storage::put($file_name, "==== PAYMENT DETAILS ====");
            Storage::append($file_name, '<br />API Mode: ' . $request->post('api_mode'));
            Storage::append($file_name, '<br />Payment Type: ' . $request->post('event'));
            Storage::append($file_name, '<br />Payment Method: ' . $request->post('pay_method'));
            Storage::append($file_name, '<br />Product Name: ' . $request->post('product_name'));
            Storage::append($file_name, '<br />Order Date: ' . $request->post('order_date_time'));
            Storage::append($file_name, '<br />Transaction Amount: ' . $request->post('transaction_amount'));
            Storage::append($file_name, '<br /> Buyer Email: ' . $request->post('email'));
            Storage::append($file_name, '<br /> Buyer First Name: ' . $request->post('address_first_name'));
            Storage::append($file_name, '<br /> Buyer Last Name: ' . $request->post('address_last_name'));
            Storage::append($file_name, '<br />================<br />');

            Storage::put('request.txt', $request->post());
            response()->json(['success' => 'success'], 200);
       } catch (\Exception $e) {
            Storage::put('error.txt', $e);
       }
    }
}
