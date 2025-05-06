<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable= [
        'user_id',
        'seller_id',
        'invoice_total',
        'real_total',
        'done',
        'confirm',
        'prepare',
        'edit_cause',
        'notes'
];


public function products()
{
    return $this->hasMany(Product::class, 'pro_id');
}

public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}


public function seller()
{
    return $this->belongsTo(User::class, 'seller_id');
}

public function carts()
{
    return $this->hasMany(Product::class, 'invoice_id');
}
public function cause()
{
    return $this->hasOne(Cause::class, 'edit_cause');
}

public function orders()
{
    return $this->hasMany(Order::class, 'invoice_id');
}


}
