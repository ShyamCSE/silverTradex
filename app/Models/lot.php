<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lot extends Model
{
    use HasFactory;

    Public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    
}
