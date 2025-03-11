<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\MarriageRequest;

class AdminMarriageProposalNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $marriageRequest;

    public function __construct(MarriageRequest $marriageRequest)
    {
        $this->marriageRequest = $marriageRequest;
    }

    public function build()
    {
        return $this->subject('طلب خطوبة جديد يحتاج للمراجعة')
            ->view('emails.admin-marriage-proposal')
            ->with([
                'marriageRequest' => $this->marriageRequest,
            ]);
    }
}
