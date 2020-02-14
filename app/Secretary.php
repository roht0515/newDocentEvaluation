<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Delivery;

class Secretary extends Model
{
    //
    protected $table = 'secretary';

    public function User()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }
    public function Delivery()
    {
        return $this->hasMany(Delivery::class, 'idSecretary', 'id');
    }
}
