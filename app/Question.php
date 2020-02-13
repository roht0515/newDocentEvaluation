<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Question extends Model
{
    //
    protected $table = 'question';

    public function Category()
    {
        return $this->belongsTo(Category::class, 'idCategory', 'id');
    }
}
