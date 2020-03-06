<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Module;
use App\Student;
use App\evaluationstudentnotes;
use App\EvaluationStudent;

class ModuleStudent extends Model
{
    //
    protected $table = 'modulestudent';

    public function Module()
    {
        return $this->belongsTo(Moduel::class, 'idModule', 'id');
    }
    public function Student()
    {
        return $this->belongsTo(Student::class, 'idStudent', 'id');
    }
    //notal final del modulo de cada estudiante
    public function EvaluationStudent()
    {
        return $this->hasMany(EvaluationStudent::class, 'idModuleStudent', 'id');
    }
    //notas individuales de categorias
    public function EvaluationStudentNotes()
    {
        return $this->hasMany(evaluationstudentnotes::class, 'idModuleStudent', 'id');
    }
}
