<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Student extends Model
{
    //
    protected $table = 'student';

    public function User()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }
}
