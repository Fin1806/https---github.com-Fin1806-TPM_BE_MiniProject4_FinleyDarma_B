<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = [
        'price_num'


    ];
    public function car(){
        return $this->hasMany(car::class);
    }
}
