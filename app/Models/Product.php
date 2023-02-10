<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['rating', 'rating_count'];
    public function category(){

        return $this->belongsTo('App\Models\Category');
    }
    public function size(){

        return $this->belongsTo('App\Models\Size');
    }
    public function color(){

        return $this->belongsTo('App\Models\Color');
    }
    public function review(){

        return $this->belongsTo('App\Models\Review');
    }
    
    public static $rules = ['name' => 'required',
    'image' =>'required|image|max:2048',
    'price'=>'required|numeric|min:1',
    'discount'=>'required|numeric|min:0',
    'category_id'=>'required',
    'size_id'=>'required',
    'color_id'=>'required',
    ];
    public function getPrice()
    {
        return $this->price - $this->price * $this->discount;
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function avgReviewRating()
{ 
    return .5*ceil(($this->reviews()->avg('rating'))*2);
}
    public function stars(){
        $rating=.5*ceil(($this->reviews()->avg('rating'))*2);
    
                    for ($i = 1; $i<=4; $i++) {
                            if ($i< $rating||$i==$rating) echo'<small class="fa fa-star text-primary mr-1"></small>';
                            if ($i==$rating-.5) echo'<small class="fa fa-star-half text-primary mr-1"></small>';
                            if ($rating == .5 && $i == 1)
                            echo '<small class="fa fa-star-half text-primary mr-1"></small>';
                            if ($i>=$rating) echo'<small class="far fa-star text-primary mr-1"></small>';

                        if ($rating == 5 && $i == 4)
                            echo '<small class="fa fa-star text-primary mr-1"></small>';
                    }
                    if ($rating==0) echo'<small class="far fa-star text-primary mr-1"></small>';
                            
    }
}
