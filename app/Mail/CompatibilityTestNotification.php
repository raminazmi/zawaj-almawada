<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompatibilityTestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    public $request;

    public function __construct($sender, $request)
    {
        $this->sender = $sender;
        $this->request = $request;
    }

    public function build()
    {
        return $this->subject('طلب إرسال رابط المقياس - زواج المودة')
            ->view('emails.compatibility-test');
    }
}
