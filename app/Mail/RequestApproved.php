<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\MarriageRequest;
use App\Models\Exam;

class RequestApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $recipient;
    public $partner;
    public $marriageRequest;
    public $exam;
    public $testLink;

    public function __construct(User $recipient, User $partner, MarriageRequest $marriageRequest, Exam $exam)
    {
        $this->recipient = $recipient;
        $this->partner = $partner;
        $this->marriageRequest = $marriageRequest;
        $this->exam = $exam;
        $this->testLink = route('exam.pledge', ['token' => $exam->token]);
    }

    public function build()
    {
        return $this->subject('تمت الموافقة على طلب الخطوبة')
            ->view('emails.request_approved')
            ->with([
                'user' => $this->recipient,
                'partner' => $this->partner,
                'testLink' => $this->testLink,
            ]);
    }
}
