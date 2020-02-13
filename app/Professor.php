<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Professor extends Model
{
    //
    protected $table = 'professor';

    public function User()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }
}
