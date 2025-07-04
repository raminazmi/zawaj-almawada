<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\MarriageRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserExamController extends Controller
{
    public function index()
    {
        if (!auth()->user()->age || !auth()->user()->gender) {
            session(['previous_url' => route('exam.user.index')]);
            return redirect()->route('personal-info');
        }
        $exams = $this->getExams()->get();
        return view('exam.user.index', compact('exams'));
    }

    public function show($id)
    {
        $exam = $this->getExams()->findOrFail($id);
        $user = Auth::user();
        $marriageRequest = MarriageRequest::where('exam_id', $exam->id)
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhere('target_user_id', $user->id);
            })
            ->first();

        if ($exam->male_finished && $exam->female_finished) {
            if ($marriageRequest && ($marriageRequest->status === 'approved')) {
                return redirect()->route('marriage-requests.showResultsAndConfirm', $marriageRequest->id);
            }
        }

        $score = $exam->calculateScore();
        $maleImportantScore = $exam->importantScore('male');
        $femaleImportantScore = $exam->importantScore('female');
        $totalImportant = $maleImportantScore['total'] + $femaleImportantScore['total'];

        $activeRequest = MarriageRequest::where(function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->orWhere('target_user_id', $user->id);
        })->where('status', 'pending')->first();

        if ($activeRequest && !$activeRequest->compatibility_test_link) {
            $activeRequest->update([
                'compatibility_test_link' => route('exam.index', ['token' => $exam->token]),
                'exam_id' => $exam->id
            ]);
        }

        $otherPartyName = null;
        if ($marriageRequest) {
            $otherPartyName = $marriageRequest->user_id === $user->id
                ? ($marriageRequest->target->name ?? 'غير محدد')
                : ($marriageRequest->user->name ?? 'غير محدد');
        }

        return view('exam.user.show', [
            'exam' => $exam,
            'marriageRequest' => $marriageRequest,
            'score' => $score,
            'maleImportantScore' => $maleImportantScore,
            'femaleImportantScore' => $femaleImportantScore,
            'totalImportant' => $totalImportant,
            'otherPartyName' => $otherPartyName
        ]);
    }

    private function getExams()
    {
        $user = Auth::user();
        return $user->exams();
    }
}