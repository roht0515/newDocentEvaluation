<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EvaluationModule;
use App\EvaluationCategory;
use App\StudentEvaluation;
use App\EvaluationDiplomat;

class Evaluation extends Model
{
    //
    protected $table = 'evaluation';
    //Categorias que tendra la evaluacion
    public  function EvaluationCategory()
    {
        return $this->hasMany(EvaluationCategory::class, 'idEvaluation', 'id');
    }
    //diplomados-evaluacion
    public function EvaluationDiplomat()
    {
        return $this->hasMany(EvaluationDiplomat::class, 'idEvaluation', 'id');
    }
}
