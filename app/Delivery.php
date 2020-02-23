<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Certificate;
use App\Accredited;
use App\User;

class Delivery extends Model
{
    //
    protected $table = 'delivery';

    public function Users()
    {
        return $this->belongsTo(User::class, 'idSecretary', 'id');
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
