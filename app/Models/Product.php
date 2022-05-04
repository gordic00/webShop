<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'small_description',
        'description',
    ];

    public function category()
    {
        // has many
        // kome pripada / belongsto pa klasa pa foreign key pa primary key
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function productDetails()
    {
        return $this->hasMany(ProductDetails::class);
    }
    
}
