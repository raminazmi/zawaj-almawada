<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class MarriageProposalNotification extends Mailable
{
    public $user;
    public $target;

    public function __construct($user, $target)
    {
        $this->user = $user;
        $this->target = $target;
    }

    public function build()
    {
        return $this->subject('طلب خطوبة جديد')
            ->view('emails.proposal')
            ->with(['user' => $this->user, 'target' => $this->target]);
    }
}
