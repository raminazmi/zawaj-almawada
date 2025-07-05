<?php

namespace App\Actions\Exam;

use App\Models\Exam;
use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class InitExamAction
{
    public ?Exam $exam;
    public User $user;
    public ?Exam $activeExam;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->activeExam = $this->user->activeExam();
        $this->exam = $this->getExam();
    }

    public function handle(): array
    {
        $exam = $this->createExam(request('token'));

        $questions = Question::all();
        $currentQuestion = null;

        if ($exam->answers()->exists()) {
            $activeExamAnsweredQuestion = $exam->answers()
                ->whereNotNull($this->user->gender . '_answer')
                ->latest()
                ->first();

            if ($activeExamAnsweredQuestion) {
                $questions = $questions->where('id', '>', $activeExamAnsweredQuestion->question_id);
                $currentQuestion = $activeExamAnsweredQuestion->question_id + 1;
            }
        }

        session(['currentQuestion' => $currentQuestion ?? 1]);

        return [
            'questions' => $questions,
            'exam' => $exam
        ];
    }


    public function doesntHaveGender(): bool
    {
        if (!request('token') && !auth()->user()->gender) {
            return true;
        }
        return false;
    }


    public function canShowExam(): bool
    {
        if (!$this->exam) {
            return false;
        }
        return ($this->user->id == $this->exam->male_user_id && $this->exam->male_finished) || ($this->user->id == $this->exam->female_user_id && $this->exam->female_finished);
    }


    private function abortInvalidUser(): void
    {
        if (
            $this->exam && $this->exam->male_user_id && $this->exam->female_user_id && !in_array($this->user->id, [$this->exam->male_user_id, $this->exam->female_user_id])
        ) {
            abort(403);
        }
    }

    private function updateGender(): void
    {
        if ($this->user->gender) {
            return;
        }
        $gender = $this->exam->male_user_id ? 'female' : 'male';
        $this->user->update([
            'gender' => $gender
        ]);
    }

    private function updateExamUserId(): void
    {
        if ($this->user->gender) {
            $column = $this->user->gender . '_user_id';
        } else {
            $column = $this->exam->male_user_id ? 'female_user_id' : 'male_user_id';
        }
        $this->exam->update([
            $column => $this->user->id
        ]);
    }

    private function getExam(): ?Exam
    {
        if (!$this->user->gender && !request()->token) {
            return null;
        }

        if (request()->token) {
            return Exam::where('token', request()->token)->first();
        }

        return $this->user->activeExam();
    }

    public function createExam(?string $token = null): Exam
    {
        $user = Auth::user();

        if ($token) {
            $exam = Exam::where('token', $token)->first();

            if (!$exam) {
                $exam = Exam::create([
                    'token' => $token,
                    $user->gender . '_user_id' => $user->id
                ]);
            } else {
                $column = $user->gender ? $user->gender . '_user_id' : ($exam->male_user_id ? 'female_user_id' : 'male_user_id');
                $exam->update([$column => $user->id]);
            }
        } else {
            $exam = Exam::firstOrCreate([
                $user->gender . '_user_id' => $user->id,
                'male_finished' => false,
                'female_finished' => false
            ], [
                'token' => Str::random(60)
            ]);
        }

        return $exam;
    }
}