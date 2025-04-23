<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable= [
        'stock',
        'price',
        'sale',
        'max_limit',
        'pro_id',
        'cat_id',
        'user_id',
        'role_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'pro_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
