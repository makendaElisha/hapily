<?php

namespace App\Http\Controllers;

use App\Entities\Customer;
use App\Entities\Teachable;
use App\Mail\StudentEnrolled;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class TeachableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fileApi = Storage::get("teachable-api.txt");
        // $dataJson = substr($fileApi, 0, strrpos( $fileApi, '}') + 1);
        // $dataArray = json_decode($dataJson, true);

        $json_arr = json_decode($fileApi, true);

        //dd($json_arr);

        $event_type     = $json_arr[0]['type'];
        $event_id       = $json_arr[0]['id'];
        $event_livemode = $json_arr[0]['livemode'];
        $event_date     = $json_arr[0]['created'];

        $event_data     = $json_arr[0]['object'];
        $student        = $event_data['user'];
        $student_name   = $student['name'];

        $course             = $event_data['course'];
        $course_id          = $course['id'];
        $course_name        = $course['name'];
        $course_description = $course['meta_description'];
        $course_url         = $course['url'];

        dd($course);

        try{
            $fileApi = Storage::get("teachable-api.txt");
            // $dataJson = substr($fileApi, 0, strrpos( $fileApi, '}') + 1);
            // $dataArray = json_decode($dataJson, true);

           // dd($fileApi);

           $file_name = 'teachable_enrollment.txt';   
           $is_created = Storage::put($file_name, "==== ENROLLEMENT DETAILS ====");
           Storage::append($file_name, '<br />Data: ' . json_decode($fileApi));
           // Storage::append($file_name, '<br />Payment Type: ' . $request->post('event'));
           // Storage::append($file_name, '<br />Payment Method: ' . $request->post('pay_method'));
           // Storage::append($file_name, '<br />Product Name: ' . $request->post('product_name'));
           // Storage::append($file_name, '<br />Order Date: ' . $request->post('order_date_time'));
           // Storage::append($file_name, '<br />Transaction Amount: ' . $request->post('transaction_amount'));
           // Storage::append($file_name, '<br /> Buyer Email: ' . $request->post('email'));
           // Storage::append($file_name, '<br /> Buyer First Name: ' . $request->post('address_first_name'));
           // Storage::append($file_name, '<br /> Buyer Last Name: ' . $request->post('address_last_name'));
           Storage::append($file_name, '<br />================<br />');
   
           Storage::put('request-newstudent.txt', json_decode($fileApi));
           response()->json(['success' => 'success'], 200);

        } catch(\Exception $e){
            logger()->error('Error getting survey file to simulate: ' . $e->getMessage());
        }

        return 'All processing done!';
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
        //Getting data from the webhook post

        $webhookData    = json_decode($request->all(), true);
        $event_type     = $webhookData[0]['type'];
        $event_id       = $webhookData[0]['id'];
        $event_livemode = $webhookData[0]['livemode'];
        $event_date     = $webhookData[0]['created'];

        $event_data     = $webhookData[0]['object'];
        $student        = $event_data['user'];
        $student_name   = $student['name'];
        $student_email  = $student['email'];

        $course             = $event_data['course'];
        $course_id          = $course['id'];
        $course_name        = $course['name'];
        $course_description = $course['meta_description'];
        $course_url         = $course['url'];


        //check if student is a customer on our platform
        $customer = Customer::where('email', $student_email)->first();
        if(!is_null($customer)){
            $customer_id = $customer->id;
        } else {
            $customer_id = null;
        }

        //save the above in to the table / can use switch case to target only certain event
        $teachable = new Teachable();
        $teachable->customer_id                 = $customer_id;
        $teachable->event_type                  = $event_type;
        $teachable->enrollment_date             = $event_date;
        $teachable->student_name                = $student_name;
        $teachable->student_email               = $student_email;
        $teachable->course_name                 = $course_name;
        $teachable->course_description          = $course_description;
        $teachable->save();

        //send email to the student - create an event listener or something an send an email
        $data = [
            'name'          => $student_name,
            'schoolLink'    => url("https://hapily.teachable.com/")
        ];

        Mail::to($student_email)
            ->send(new StudentEnrolled($data));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\Teachable  $teachable
     * @return \Illuminate\Http\Response
     */
    public function show(Teachable $teachable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entities\Teachable  $teachable
     * @return \Illuminate\Http\Response
     */
    public function edit(Teachable $teachable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Teachable  $teachable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teachable $teachable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\Teachable  $teachable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teachable $teachable)
    {
        //
    }
}
