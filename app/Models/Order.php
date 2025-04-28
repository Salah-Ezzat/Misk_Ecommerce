<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable =[

        'invoice_id',
        'quantity',
        'user_id',
        'stock_id'
    ];


    public function stocks()
    {
        return $this->hasMany(Stock::class, 'stock_id');
    }

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');

}

public function invoice()
{
    return $this->belongsTo(Invoice::class, 'invoice_id');
}





}
