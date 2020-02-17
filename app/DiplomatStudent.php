<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Student;
use App\Diplomat;

class DiplomatStudent extends Model
{
    //
    protected $table = 'diplomatstudent';

    public function Student()
    {
        return $this->belongsTo(Student::class, 'idStudent', 'id');
    }
    public function Diplomat()
    {
        return $this->belongsTo(Diplomat::class, 'idDiplomat', 'id');
    }
}
