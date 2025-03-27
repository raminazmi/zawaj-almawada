<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProfileApprovalNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $approvalLink;
    public $rejectionLink;

    public function __construct($user)
    {
        $this->user = $user;
        $this->approvalLink = route('admin.profile.approve', $user->id);
        $this->rejectionLink = route('admin.profile.reject', $user->id);
    }

    public function build()
    {
        return $this->subject('طلب موافقة على ملف شخصي جديد')
            ->view('emails.profile_approval');
    }
}
