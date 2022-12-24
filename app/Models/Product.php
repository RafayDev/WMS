<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey='id';
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
    //one image
    public function image()
    {
        return $this->hasOne(ProductImage::class, 'product_id', 'id');
    }
}
