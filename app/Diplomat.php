<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Module;
use App\DiplomatStudent;

class Diplomat extends Model
{
    //
    protected $table = 'diplomat';

    public function Module()
    {
        return $this->hasOne(Module::class, 'idDiplomat', 'id');
    }
    public function DiplomatStudent()
    {
        return $this->hasMany(DiplomatStudent::class, 'idDiplomat', 'id');
    }
}
