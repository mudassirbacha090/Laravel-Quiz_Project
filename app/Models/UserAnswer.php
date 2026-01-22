<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    protected $table = 'user_answers';
    protected $fillable = [
        'quiz_submission_id',
        'mcq_id',
        'user_answer',
        'is_correct'
    ];

    public function quizSubmission()
    {
        return $this->belongsTo(QuizSubmission::class);
    }

    public function mcq()
    {
        return $this->belongsTo(Mcq::class);
    }
}
