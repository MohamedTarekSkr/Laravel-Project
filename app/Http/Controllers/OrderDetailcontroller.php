<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Review;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Detailcontroller extends Controller
{
    function view_detail($id){
        $product = Product::findorFail($id);
        return view('detail')->with([
            'product' => $product,
            'colors' => Color::all(),
            'sizes' => Size::all(),
            'products'=> Product::all(),
            'categories' => Category::all()
            
        ]);
    }
    public function review(Request $request)
    {
       
        $request->validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255',
            'rating' => 'required',
            'review' => 'required',
        ]);
        $post = new Review();
        $post->name = $request->name;
        $post->email = $request->email;
        $post->rating = $request->rating;
        $post->review = $request->review;
        $post->product_id = $request->id;
        $post->user_id = $request->user_id;
        $findReview = Review::where(['user_id' => Auth::user()->id, 'product_id' => $request->id])->first();
        if($findReview) {
            return Redirect::back()->with('error', 'You already reviewed this product');
        }
        $post->save();
        return Redirect::back()->with('message','Your review added successfully, Thank you');
        if( $request->validate->fails()) {
            return Redirect::back()->withErrors( $request->validate);
        }
        
    }
   
}
