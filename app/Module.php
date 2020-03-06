<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Diplomat;
use App\Professor;
use App\EvaluationModule;
use App\ModuleStudent;

class Module extends Model
{
    protected $table = 'module';

    public function Diplomat()
    {
        return $this->belongsTo(Diplomat::class, 'idDiplomat', 'id');
    }
    public function Professor()
    {
        return $this->belongsTo(Professor::class, 'idProfessor', 'id');
    }
    public function ModuleStudent()
    {
        return $this->hasMany(ModuleStudent::class, 'idModule', 'id');
    }
}
