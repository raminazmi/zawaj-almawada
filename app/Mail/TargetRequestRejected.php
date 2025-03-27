<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class TargetRequestRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $rejecter;
    public $request;
    public $reason;

    public function __construct(User $rejecter, $request = null, $reason = null)
    {
        $this->rejecter = $rejecter;
        $this->request = $request;
        $this->reason = $reason ?? 'لم يتم تقديم سبب محدد';
    }

    public function build()
    {
        return $this->subject('إشعار برفض طلب الخطوبة - زواج المودة')
            ->view('emails.target_request_rejected');
    }
}
