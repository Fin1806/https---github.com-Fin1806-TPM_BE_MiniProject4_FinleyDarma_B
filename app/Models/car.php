<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class car extends Model
{
    use HasFactory;
    protected $fillable = [
        'Cars','Brand','Car_Type','Fuel_Type','image','price_id'
    ];

    public function price(){
        return $this-> belongsTo(price::class,'price_id');
    }

}
