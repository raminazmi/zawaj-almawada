<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\MarriageRequest;

class RequestApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $marriageRequest;
    public $dashboardLink;

    public function __construct(User $user, MarriageRequest $marriageRequest, $dashboardLink)
    {
        $this->user = $user;
        $this->marriageRequest = $marriageRequest;
        $this->dashboardLink = $dashboardLink;
    }

    public function build()
    {
        return $this->subject('تمت الموافقة على طلب الخطوبة')
            ->view('emails.request_approved');
    }
}
