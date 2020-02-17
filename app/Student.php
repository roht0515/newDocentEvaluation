<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\EvaluationStudent;
use App\DiplomatStudent;
use App\ModuleStudent;

class Student extends Model
{
    //
    protected $table = 'student';

    public function User()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }
    public function EvaluationStudent()
    {
        return $this->hasMany(EvaluationStudent::class, 'idStudent', 'id');
    }
    public function DiplomatStudent()
    {
        return $this->hasMany(DiplomatStudent::class, 'idStudent', 'id');
    }
    public function ModuleStudent()
    {
        return $this->hasMany(ModuleStudent::class, 'idStudent', 'id');
    }
}
