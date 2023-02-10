<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    function addProduct (Request $request,$id)
    {
        
        $product = Product::findorFail($id);
        if ($product) {
            
            $cart = Session::get('carts', []);
            $found = false;
            for ($i = 0; $i < count($cart); $i++) {
                if ($cart[$i]['product']['id'] === $product['id']&& !$request->has('minus')&&!$request->has('remove')) {
                    $cart[$i]['quantity'] += 1;
                    $found = true;
                }
                elseif ($cart[$i]['product']['id'] === $product['id']&& $request->has('minus')&&$cart[$i]['quantity']>1) {
                    $cart[$i]['quantity'] -= 1;
                    $found = true;
                }
                elseif ($cart[$i]['product']['id'] === $product['id']&& $request->has('remove')) {
                    array_splice($cart, $i, 1);
                    $ids = Session::get('ids', []);
                    array_pop($ids);
                    Session::put('ids', $ids);
                    $found = true;
                }

            }
            if (!$found &&!$request->has('minus')&&!$request->has('remove') ) {
                array_push($cart, ['product' => $product, 'quantity' => 1]);
            }

        }
        Session::put('carts', $cart);
        
        session()->save();
        $lines = session()->get('carts')?session()->get('carts'):[];
        return redirect()->route('cart');

        
    }
    function view_cart(){
        $lines = session()->get('carts')?session()->get('carts'):[];
        $categories = Category::all();
        return view('cart', compact('lines','categories'));
    }
    public static function line_total($line) {
        return ($line['product']['price'] - $line['product']['price'] * $line['product']['discount']) * $line['quantity'];
    }
    public static function get_shipping()
{
        $cart = Session()->get('carts')?Session()->get('carts'):[];
    
    return count($cart) * 10;  
}
public static function sub_total()
{
    $sum = 0;
    $cart = Session()->get('carts')?Session()->get('carts'):[];
    foreach ($cart as $line) {
        $sum += ($line['product']['price']-($line['product']['price']*$line['product']['discount']))*$line['quantity'];
        
    }
    return $sum;
}
static function total()
{
    $sum = 0;
    $cart = Session()->get('carts')?Session()->get('carts'):[];
    foreach ($cart as $line) {
        $sum += ($line['product']['price']-($line['product']['price']*$line['product']['discount']))*$line['quantity'];
    };
    $shipping=count($cart) * 10;

        return $shipping + $sum;
}
   
}
