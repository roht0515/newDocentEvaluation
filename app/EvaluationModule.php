<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Module;
use App\Evaluation;
use PhpParser\Node\Expr\AssignOp\Mod;

class EvaluationModule extends Model
{
    //
    protected $table = 'evaluationmodule';

    public function Module()
    {
        return $this->belongsTo(Module::class, 'idModule', 'id');
    }
    public function Evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'idEvaluation', 'id');
    }
}
