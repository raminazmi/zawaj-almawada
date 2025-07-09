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
    public $path;
    public $type;

    public function __construct($result, $path, $type = 'success')
    {
        $this->result = $result;
        $this->path = $path;
        $this->type = $type;
    }

    public function build()
    {
        $subject = $this->type === 'attendance'
            ? 'شهادة حضور الدورة'
            : 'شهادة اجتياز الدورة';

        return $this->view('emails.exam-certificate')
            ->subject($subject)
            ->with(['type' => $this->type])
            ->attach($this->path, [
                'as' => 'certificate.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}
