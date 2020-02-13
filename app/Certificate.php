<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Trained;

class Certificate extends Model
{
    //
    protected $table = 'certificate';

    public function Trained()
    {
        return $this->belongsTo(Trained::class, 'idTrained', 'id');
    }
}
