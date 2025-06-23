<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\CourseExamResult;

class CourseExamCertificate extends Mailable
{
    use Queueable, SerializesModels;

    public $pdf;
    public $result;

    public function __construct($pdf, CourseExamResult $result)
    {
        $this->pdf = $pdf;
        $this->result = $result;
    }

    public function build()
    {
        return $this->view('emails.course-exam-certificate')
            ->subject('شهادة إتمام الاختبار')
            ->attachData($this->pdf->output(), 'certificate.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}