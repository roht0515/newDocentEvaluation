<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Module;
use App\Student;

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
}
