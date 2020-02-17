<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Evaluation;

class EvaluationCategory extends Model
{
    //
    protected $table = 'evaluationcategory';

    public function Category()
    {
        return $this->belongsTo(Category::class, 'idCategory', 'id');
    }
    public function Evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'idEvaluation', 'id');
    }
}
