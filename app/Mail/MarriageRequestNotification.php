<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MarriageRequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    public $request;

    public function __construct($sender, $request)
    {
        $this->sender = $sender;
        $this->request = $request;
    }

    public function build()
    {
        return $this->subject('طلب خطوبة جديد - زواج المودة')
            ->view('emails.marriage-proposal');
    }
}
