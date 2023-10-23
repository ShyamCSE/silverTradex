<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchase extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'category_id',
        'supplier_id',
        'phone',
        'quantity',
        'current_quantity',
        'rate',
        'date',
        'photo',
        'receipt',
        'status',
    ];
    

    Public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    Public function supplier(){
        return $this->belongsTo(supplier::class,'supplier_id');
    }

}
