<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Exam;

class FinalApprovalNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $recipient;
    public $partner;
    public $testLink;
    public $testResult;
    public $maleImportantScore;
    public $femaleImportantScore;
    public $totalImportant;

    public function __construct(User $recipient, User $partner, $testLink, $testResult, Exam $exam)
    {
        $this->recipient = $recipient;
        $this->partner = $partner;
        $this->testLink = $testLink;
        $this->testResult = $testResult;

        $this->maleImportantScore = $exam->importantScore('male');
        $this->femaleImportantScore = $exam->importantScore('female');
        $this->totalImportant = $this->maleImportantScore['total'] + $this->femaleImportantScore['total'];
    }

    public function build()
    {
        return $this->subject('موافقة نهائية - زواج المودة')
            ->view('emails.final-approval')
            ->with([
                'recipient' => $this->recipient,
                'partner' => $this->partner,
                'testLink' => $this->testLink,
                'testResult' => $this->testResult,
                'maleImportantScore' => $this->maleImportantScore,
                'femaleImportantScore' => $this->femaleImportantScore,
                'totalImportant' => $this->totalImportant,
            ]);
    }
}
