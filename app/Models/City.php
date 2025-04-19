<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable=['city', 'province_id'];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'city');
    }

}
