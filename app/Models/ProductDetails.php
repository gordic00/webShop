<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    use HasFactory;
    
    protected $table = 'product_details';
    protected $fillable = [
        'product_id',
        'original_price',
        'selling_price',
        'image',
        'color',
        'size',
        'qty',
        'status',
        'trending',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    public function product()
    {
        // has many
        // kome pripada / belongsto pa klasa pa foreign key pa primary key
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
