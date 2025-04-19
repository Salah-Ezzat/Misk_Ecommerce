<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['product', 'cat_id', 'pack'];


    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'pro_id');
    }
}
