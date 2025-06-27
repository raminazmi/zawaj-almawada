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
    public $pdfPath;

    public function __construct($result, $pdfPath)
    {
        $this->result = $result;
        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        return $this->view('emails.exam-certificate')
            ->subject('شهادة إتمام الاختبار')
            ->attach($this->pdfPath, [
                'as' => 'certificate.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}
