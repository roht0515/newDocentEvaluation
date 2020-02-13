<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Certificate;

class Trained extends Model
{
    //
    protected $table = 'trained';

    public function Certificate()
    {
        return $this->hasOne(Certificate::class, 'idTrained', 'id');
    }
}
