<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Evaluation;
use App\Diplomat;

class EvaluationDiplomat extends Model
{
    //
    protected $table = 'evaluationdiplomat';

    public function Evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'idEvaluation', 'id');
    }
    public function Diplomat()
    {
        return $this->belongsTo(Diplomat::class, 'idDiplomat', 'id');
    }
}
