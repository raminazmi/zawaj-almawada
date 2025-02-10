<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exam extends Model
{
    public function calculateScore(){
        if(!$this->male_finished || !$this->female_finished){
            return 0;
        }

        $maleAnswers = UserAnswer::where('exam_id', $this->id)->whereNotNull('male_answer')->get();
        $femaleAnswers = UserAnswer::where('exam_id', $this->id)->whereNotNull('female_answer')->get();

        if($maleAnswers->count() != $femaleAnswers->count()){
            return 0;
        }
        $score = 0;
        foreach($maleAnswers as $key => $maleAnswer){
            $answerSequence = $maleAnswer->male_answer . $femaleAnswers[$key]->female_answer;
            if(!in_array($answerSequence,$maleAnswer->question->wrong_answers)){
                $score++;
            }
        }
        return round($score / $maleAnswers->count() * 100);
    }

    // public function importantScore(){

    //     if(!$this->male_finished || !$this->female_finished){
    //         return [
    //             'total' => 0,
    //             'score' => 0
    //         ];
    //     }

    //     $maleImportantAnswers = UserAnswer::where('exam_id', $this->id)
    //                     ->whereNotNull('male_answer')
    //                     ->where('important', true)
    //                     ->get();
    //     $maleAllAnswers = UserAnswer::where('exam_id', $this->id)
    //     ->whereNotNull('male_answer')
    //     ->get();

    //     $femaleImportantAnswers = UserAnswer::where('exam_id', $this->id)
    //                                 ->whereNotNull('female_answer')
    //                                 ->where('important', true)
    //                                 ->get();

    //     $femaleAllAnswers = UserAnswer::where('exam_id', $this->id)
    //     ->whereNotNull('female_answer')
    //     ->get();

    //     $score = 0;
    //     foreach($maleImportantAnswers as $maleAnswer){
    //         $answerSequence = $maleAnswer->male_answer . $femaleAllAnswers->where('question_id', $maleAnswer->question_id)->first()->female_answer;
    //         if(in_array($answerSequence,$maleAnswer->question->wrong_answers)){
    //             $score++;
    //         }
    //     }

    //     foreach($femaleImportantAnswers as $femaleAnswer){
    //         $answerSequence = $maleAllAnswers->where('question_id', $femaleAnswer->question_id)->first()->male_answer . $femaleAnswer->female_answer;
    //         if(in_array($answerSequence,$femaleAnswer->question->wrong_answers)){
    //             $score++;
    //         }
    //     }

    //     return [
    //         'total' => $maleImportantAnswers->count() + $femaleImportantAnswers->count(),
    //         'score' => $score
    //     ];
    // }

    public function importantScore($gender = null){
        $gender = $gender ?? auth()->user()->gender;
        $otherGender = $gender == 'male' ? 'female' : 'male';
        $genderAnswers = UserAnswer::where('exam_id', $this->id)
                            ->whereNotNull($gender . '_answer')
                            ->where('important', true)
                            ->get();
       
        $otherGenderAnsers = UserAnswer::where('exam_id', $this->id)
                                        ->whereNotNull($otherGender . '_answer')
                                        ->get();

        $score = 0;
        if($genderAnswers->count() == 0 ||  $otherGenderAnsers->count() == 0){
            return [
                'total' => 0,
                'score' => 0
            ];
        }
        foreach($genderAnswers as $genderAnswer){
            $answerSequence = $genderAnswer->{$gender . '_answer'} . $otherGenderAnsers->where('question_id', $genderAnswer->question_id)->first()->{$otherGender . '_answer'};
            if(in_array($answerSequence,$genderAnswer->question->wrong_answers)){
                $score++;
            }
        }
        return [
            'total' => $genderAnswers->count(),
            'score' => $score
        ];
    }

    public function answers(): HasMany
    {
        return $this->hasMany(UserAnswer::class);
    }


    public function male(){
        return $this->belongsTo(User::class, 'male_user_id');
    }
    public function female(){
        return $this->belongsTo(User::class, 'female_user_id');
    }
}
