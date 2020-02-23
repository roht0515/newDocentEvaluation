<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Evaluation;
use App\Student;
use App\QuestionStudent;

class EvaluationStudent extends Model
{
    //
    protected $table = 'evaluationstudent';

    public function EvaluationModule()
    {
        return $this->belongsTo(EvaluationModule::class, 'idEvaluationModule', 'id');
    }
    public function Student()
    {
        return $this->belongsTo(Student::class, 'idStudent', 'id');
    }
    public function QuestionStudent()
    {
        return $this->hasMany(QuestionStudent::class, 'idEvaluationStudent', 'id');
    }
}
