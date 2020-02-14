<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Diplomat;

class Module extends Model
{
     protected $table = 'module';

     public function Diplomat(){

        return $this->belongsTo(Diplomat::class,'idDiplomat','id');
    }
}
