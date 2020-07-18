<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Entities\Customer;
use App\Entities\Teachable;
use Illuminate\Http\Request;
use App\Mail\StudentEnrolled;
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

        $event_type     = $request->get('type');
        $event_id       = $request->get('id');
        $event_livemode = $request->get('livemode');
        $event_date     = $request->get('created');

        $event_data     = $request->get('object');
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
        $teachable->enrollment_date             = Carbon::parse($event_date)->format('Y-m-d h:i:s');
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


    public function testApp()
    {
        $fileApi = Storage::get("teachable-api.txt");
        $webhookData = json_decode($fileApi, true);

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
        $teachable->enrollment_date             = Carbon::parse($event_date)->format('Y-m-d h:i:s');
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
        
        return 'All processing done!';
    }

}
