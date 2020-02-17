<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Trained;
use App\Delivery;

class Certificate extends Model
{
    //
    protected $table = 'certificate';

    public function Trained()
    {
        return $this->belongsTo(Trained::class, 'idTrained', 'id');
    }
    public function Delivery()
    {
        return $this->hasMany(Delivery::class, 'idCertificate', 'id');
    }
}
