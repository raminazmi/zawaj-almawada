<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $marriageRequest;

    public function __construct($user, $marriageRequest)
    {
        $this->user = $user;
        $this->marriageRequest = $marriageRequest;
    }

    public function build()
    {
        return $this->subject('تم رفض طلبك')
            ->view('emails.request-rejected');
    }
}
