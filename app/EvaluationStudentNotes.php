<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ModuleStudent;
use App\Evaluation;
use App\Category;
use App\EvaluationStudent;

class evaluationstudentnotes extends Model
{
    //
    protected $table = 'evaluationstudentnotes';

    public function ModuleStudent()
    {
        return $this->belongsTo(ModuleStudent::class, 'idModuleStudent', 'id');
    }
    public function Category()
    {
        return  $this->belongsTo(Category::class, 'idCategory', 'id');
    }
}
