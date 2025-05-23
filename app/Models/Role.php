<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['role'];

    public function user()
    {
        return $this->hasOne(User::class, 'role_id');
    }

    public function stocks()
    {
        return $this->hasMany(stock::class, 'role_id');
    }
}
