<?php

namespace App\Actions\Exam;

use App\Mail\AdminMarriageProposalNotification;
use App\Models\Exam;
use App\Models\Question;
use App\Models\User;
use App\Models\UserAnswer;
use App\Models\MarriageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SaveUserAnswer
{
    public function handle(array $data): array
    {
        try {
            $user = Auth::user();
            if (!$user) {
                throw new \Exception('User not authenticated');
            }

            $exam = Exam::findOrFail($data['exam_id']);
            $showUrl = $exam->male_user_id && $exam->female_user_id ? false : true;

            $this->saveAnswer($user, $data['question_id'], $data['answer'], $exam, $data['is_important']);

            $nextQuestion = Question::where('id', '>', $data['question_id'])->first();
            $questionsCount = Question::count();

            $lastQuestion = $this->handleQuestionsSession($user, $questionsCount, $exam);

            if ($lastQuestion) {
                $this->handleExamCompletion($exam);
            }

            return [
                'question' => $nextQuestion,
                'exam' => $exam,
                'questionsCount' => $questionsCount,
                'showUrl' => $showUrl,
                'lastQuestion' => $lastQuestion
            ];
        } catch (\Exception $e) {
            Log::error('Error saving user answer: ' . $e->getMessage());
            throw $e;
        }
    }

    private function handleExamCompletion(Exam $exam): void
    {
        $exam->refresh();
        if ($exam->male_finished && $exam->female_finished) {
            $this->sendAdminNotification($exam);
        }
    }

    private function sendAdminNotification(Exam $exam): void
    {
        try {
            $marriageRequest = MarriageRequest::where('exam_id', $exam->id)
                ->where('admin_approval_status', 'pending')
                ->first();

            if ($marriageRequest) {
                $admins = User::where('is_admin', true)->get();
                foreach ($admins as $admin) {
                    Mail::to($admin->email)->send(
                        new AdminMarriageProposalNotification($marriageRequest)
                    );
                }

                Log::info('Admin notification sent for completed exam: ' . $exam->id);
            }
        } catch (\Exception $e) {
            Log::error('Failed to send admin notification: ' . $e->getMessage());
        }
    }

    private function saveAnswer(User $user, int $questionId, int $answer, Exam $exam, string $isImportant): void
    {
        $column = $user->gender . '_answer';
        $isImportant = $isImportant == "true" ? 1 : 0;

        UserAnswer::create([
            'exam_id' => $exam->id,
            'question_id' => $questionId,
            $column => $answer,
            'important' => $isImportant
        ]);
    }

    private function handleQuestionsSession(User $user, int $questionsCount, Exam $exam): bool
    {
        $currentQuestion = session('currentQuestion', 1) + 1;
        session(['currentQuestion' => $currentQuestion]);

        if ($currentQuestion > $questionsCount) {
            session()->put('currentQuestion', -1);
            $exam->update([
                $user->gender . '_finished' => true,
            ]);
            return true;
        }

        return false;
    }
}