<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    function view_checkout(){
        $lines = session()->get('carts')?session()->get('carts'):[];
        $categories = Category::all();
        
        return view('checkout', compact('lines','categories'));
    }
    public function order(Request $request)
    {
        $lines = session()->get('carts')?session()->get('carts'):[];
        
        $request->validate([
            'payment' => 'required',
            'total' => 'required|numeric|min:1',
            
        ]);
       
        $post = new Order();
        $post->sub_total = $request->sub_total;
        $post->shipping = $request->shipping;
        $post->total = $request->total;
        $post->payment = $request->payment;
        $post->user_id = $request->user_id;
        $post->save();
        if ($request->validate) {
            if ($request->validate->fails()) {
                return Redirect::back()->withErrors($request->validate);
            }
        }
        for ($i = 0; $i < count($lines); $i++) {
            $post2 = new OrderDetail();
            $post2->quantity = $request->quantity[$i];
            $post2->price = $request->price[$i];
            $post2->product_id = $request->product_id[$i];
            $post2->order_id = $post->id;
            $post2->save();
        }
        
        return Redirect::back()->with('message','Your Order added successfully, Thank you');
        
    }
  
}
