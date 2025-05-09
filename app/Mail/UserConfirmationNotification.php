<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\MarriageRequest;

class UserConfirmationNotification extends Mailable
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
        return $this->subject('تمت الموافقة على طلب الخطوبة من كلا الطرفين')
            ->view('emails.user_confirmation')
            ->with([
                'user' => $this->user,
                'marriageRequest' => $this->marriageRequest,
            ]);
    }
}
