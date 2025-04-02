<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\MarriageRequest;

class RequestRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $marriageRequest;
    public $dashboardLink;
    public $reason;

    public function __construct(User $user, MarriageRequest $marriageRequest, $reason)
    {
        $this->user = $user;
        $this->marriageRequest = $marriageRequest;
        $this->dashboardLink = route('exam.pledge');
        $this->reason = $reason;
    }

    public function build()
    {
        return $this->subject('تم رفض طلب الخطوبة')
            ->view('emails.request_rejected');
    }
}
