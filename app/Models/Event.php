<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['category_id', 'title', 'description', 'date', 'location', 'price', 'stock', 'poster_path'])]
class Event extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
