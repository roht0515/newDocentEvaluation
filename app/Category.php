<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;

class Category extends Model
{
    //
    protected $table = 'category';

    public function Question()
    {
        return $this->hasOne(Question::class, 'idCategory', 'id');
    }
}
