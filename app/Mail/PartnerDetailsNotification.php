<?php

namespace App\Mail;

use App\Models\MarriageRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PartnerDetailsNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $marriageRequest;

    public function __construct(MarriageRequest $marriageRequest)
    {
        $this->marriageRequest = $marriageRequest;
    }

    public function build()
    {
        return $this->subject('تفاصيل الطرف الآخر')
            ->view('emails.partner-details');
    }
}
