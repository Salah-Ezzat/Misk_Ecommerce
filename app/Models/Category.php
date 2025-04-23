<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['category'];




    public function products()
    {
        return $this->hasMany(Product::class, 'cat_id');
    }

    public function stocks()
    {
        return $this->hasMany(stock::class, 'cat_id');
    }
}
