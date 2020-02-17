<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Module;
use PhpParser\Node\Expr\AssignOp\Mod;

class Professor extends Model
{
    //
    protected $table = 'professor';

    public function User()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }
    public function Module()
    {
        return $this->hasMany(Module::class, 'idProfessor', 'id');
    }
}
