<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ExamCertificate extends Mailable
{
    use Queueable, SerializesModels;

    public $result;
    public $imagePath;

    public function __construct($result, $imagePath)
    {
        $this->result = $result;
        $this->imagePath = $imagePath;
    }

    public function build()
    {
        return $this->view('emails.exam-certificate')
            ->subject('شهادة إتمام الاختبار')
            ->attach($this->imagePath, [
                'as' => 'certificate.png',
                'mime' => 'image/png',
            ]);
    }
}
