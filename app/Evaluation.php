<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EvaluationModule;
use App\EvaluationCategory;
use App\StudentEvaluation;

class Evaluation extends Model
{
    //
    protected $table = 'evaluation';
    //evaluaciones que mandara de cada modulo
    public function EvaluationModule()
    {
        return $this->hasMany(EvaluationModule::class, 'idEvaluation', 'id');
    }
    //Categorias que tendra la evaluacion
    public  function EvaluationCategory()
    {
        return $this->hasMany(EvaluationCategory::class, 'idEvaluation', 'id');
    }
    //Estudiantes
    public function EvaluationStudent()
    {
        return $this->hasMany(StudentEvaluation::class, 'idEvaluation', 'id');
    }
}
