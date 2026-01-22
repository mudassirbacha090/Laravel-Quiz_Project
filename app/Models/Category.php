<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name', 'creator'];

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function mcqs()
    {
        return $this->hasMany(Mcq::class);
    }
}