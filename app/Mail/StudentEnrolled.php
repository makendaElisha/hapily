<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class StudentEnrolled extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('gluecks-challenge@hapily.de',  'hapily Academy')
                    ->subject('=?utf-8?Q?=E2=98=98=EF=B8=8F?= Herzlich Willkommen bei deiner hapily Glücks-Challenge')
                    ->view('mails.student-enrolled')
                    ->with('data', $this->data);
    }
}
