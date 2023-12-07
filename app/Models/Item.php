<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function image(){
        return $this->belongsTo(ItemImage::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
