<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $fillable=['image', 'pro_id', 'user_id'];


    public function product(){
        return $this->belongsTo(Product::class, 'pro_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
