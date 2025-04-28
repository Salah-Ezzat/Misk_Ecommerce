<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{
    use HasFactory;
    protected $fillable= ['cause'];


    public function cause()
{
    return $this->hasOne(Invoice::class, 'edit_cause');
}

}
