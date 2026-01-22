<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizSubmission extends Model
{
    protected $table = 'quiz_submissions';
    protected $fillable = [
        'user_id',
        'quiz_id',
        'total_questions',
        'correct_answers',
        'incorrect_answers',
        'percentage',
        'passed'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class);
    }
}
