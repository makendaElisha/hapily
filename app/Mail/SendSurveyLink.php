<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSurveyLink extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

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
        //Shmock code = =?utf-8?Q?=26=23x2618=3B?=   OR =?utf-8?Q?=E2=98=98=EF=B8=8F?=
        return $this->from('hallo@hapily.de',  'hapily')
                    ->subject('=?utf-8?Q?=E2=98=98=EF=B8=8F?= Dein Glücks-Bericht') //Added Emoji
                    ->view('surveys.email')
                    ->with('data', $this->data);
     }
}
