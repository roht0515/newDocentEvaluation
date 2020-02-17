<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Module;



class Diplomat extends Model
{
    //
    protected $table = 'diplomat';
    public function Module(){

        return $this->hasOne(Module::class,'idDiplomat','id');
    }


}
