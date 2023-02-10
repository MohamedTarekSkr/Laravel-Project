<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function view_admin(){
        
        $categories=Category::all();
        $products = Product::all();
        return view('main.admin')->with( ['products'=>$products,
        'categories' => $categories,]);
    }
    function orders(){
        
        $orders=Order::paginate(2);
        
        return view('main.admin.order')->with( ['orders'=>$orders,
        ]);
    }
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        Order::destroy($id);
        return redirect()->route('orders.index');
    }
}

