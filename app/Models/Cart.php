<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable= [
            'pro_id',
            'user_id',
            'seller_id',
            'quantity',
            'price',
            'invoice_id',
            'invoice_total',
            'new_quantity',
            'new_total',
            'changed',
            'confirmed'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'pro_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function invoice()
    {
        return $this->belongsTo(User::class, 'invoice_id');
    }




}
