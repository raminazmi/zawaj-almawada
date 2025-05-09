<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\MarriageRequest;

class UserRejectedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $marriageRequest;

    public function __construct(User $user, MarriageRequest $marriageRequest)
    {
        $this->user = $user;
        $this->marriageRequest = $marriageRequest;
    }

    public function build()
    {
        return $this->subject('تم رفض طلب الخطوبة')
            ->view('emails.user_rejected')
            ->with([
                'user' => $this->user,
                'marriageRequest' => $this->marriageRequest,
            ]);
    }
}
