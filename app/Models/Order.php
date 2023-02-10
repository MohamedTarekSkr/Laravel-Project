<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded=['*'];
    

    public function order_deails(){
        return $this->hasMany(OrderDetail::class);
    }
}
