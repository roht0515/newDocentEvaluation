<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;
use App\EvaluationCategory;

class Category extends Model
{
    //
    protected $table = 'category';

    public function Question()
    {
        return $this->hasOne(Question::class, 'idCategory', 'id');
    }
    public function EvaluationCategory()
    {
        return $this->hasMany(EvaluationCategory::class, 'idCategory', 'id');
    }
}
