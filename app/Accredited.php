<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Delivery;

class Accredited extends Model
{
    //
    protected $table = 'accredited';

    public function Delivery()
    {
        return $this->hasMany(Delivery::class, 'idAccredited', 'id');
    }
}
