<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\MarriageRequest;

class NewMarriageRequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $marriageRequest;

    public function __construct(MarriageRequest $marriageRequest)
    {
        $this->marriageRequest = $marriageRequest;
    }

    public function build()
    {
        return $this->subject('طلب زواج جديد يحتاج للمراجعة')
            ->view('emails.new_marriage_request');
    }
}
