<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;
use App\EvaluationStudent;

class QuestionStudent extends Model
{
    //
    protected $table = 'questionstudent';

    public function Question()
    {
        return $this->belongsTo(Question::class, 'idQuestion', 'id');
    }
    public function EvaluationStudent()
    {
        return $this->belongsTo(EvaluationStudent::class, 'idEvaluationStudent', 'id');
    }
}
