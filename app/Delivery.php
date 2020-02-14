<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Secretary;
use App\Certificate;
use App\Accredited;

class Delivery extends Model
{
    //
    protected $table = 'delivery';

    public function Secretary()
    {
        return $this->belongsTo(Secretary::class, 'idSecretary', 'id');
    }
    public function Certificate()
    {
        return $this->belongsTo(Certificate::class, 'idCertificate', 'id');
    }
    public function Accredited()
    {
        return $this->belongsTo(Accredited::class, 'idAccredited', 'id');
    }
}
