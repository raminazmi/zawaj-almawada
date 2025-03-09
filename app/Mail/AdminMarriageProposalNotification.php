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
    public $admin;

    public function __construct(MarriageRequest $marriageRequest, $admin)
    {
        $this->marriageRequest = $marriageRequest;
        $this->admin = $admin;
    }

    public function build()
    {
        return $this->subject('طلب خطوبة جديد يحتاج للمراجعة')
            ->view('emails.admin-marriage-proposal');
    }
}
