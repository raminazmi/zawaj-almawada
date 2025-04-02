<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\MarriageRequest;

class AdditionalDataNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $marriageRequest;

    public function __construct(MarriageRequest $marriageRequest)
    {
        $this->marriageRequest = $marriageRequest;
    }

    public function build()
    {
        return $this->view('emails.additional_data')
            ->with([
                'full_name' => $this->marriageRequest->full_name,
                'village' => $this->marriageRequest->village,
                'test_link' => $this->marriageRequest->test_link,
            ]);
    }
}
