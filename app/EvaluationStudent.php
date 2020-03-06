<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Evaluation;
use App\Student;
use App\ModuleStudent;

class EvaluationStudent extends Model
{
    //
    protected $table = 'evaluationstudent';

    public function ModuleStudent()
    {
        return $this->belongsTo(ModuleStudent::class, 'idModuleStudent', 'id');
    }
}
