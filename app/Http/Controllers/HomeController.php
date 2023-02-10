<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    function view_index(){
        return view('index')->with([
            'categories' => Category::all(),
            'products' => Product::all(),
            'users'=> User::all()
        ]);
    }
    function login(){
        return view('auth.login')->with([
            
        ]);
    }
    function register(){
        return view('auth.register')->with([
            
        ]);
    }
    public function logout () {
       
        auth()->logout();
        
        return redirect('/');
    }
    function view_shop(Request $request)
    {
        $query = Product::query();

        $inputs = $request->all();

        if (isset($inputs['keywords'])) {
            $query = $query->where('name', 'like', "%" . $inputs['keywords'] . "%");
        }
        if (isset($inputs['color'])) {
            if (!in_array('-1', $inputs['color'])) {

                $query = $query->whereIn('color_id', $inputs['color']);
            }
        }
        if (isset($inputs['size'])) {
            if (!in_array('-1', $inputs['size'])) {
                $query = $query->whereIn('size_id', $inputs['size']);
            }
        }

        if ($request->has('category_id')) {
            $query = $query->where('category_id', $request->get('category_id'));
        }

        if ($request->has('price')) {
            if (!in_array('-1', $inputs['price'])) {
                $query = $query->where(function ($q) use ($inputs) {
                    foreach ($inputs['price'] as $price) {
                        $q = $q->orWhereBetween('price', [$price, $price + 100]);
                    }
                });
            }
        }

        /*SELECT * FROM Products WHERE con1 and con2 and (
        price between 0 and 100 or
        price between 100 and 200
        )
        */
        $products = $query->paginate(9);
        

        return view('shop')->with([
            'products' => $products,
            'colors' => Color::all(),
            'sizes' => Size::all(),
            'categories' => Category::all()
        ]);
    }
    function add_product(Request $request)
    {
       
       
        if ($request->has('id')) {
            $ids = Session::get('ids', []);
            array_push($ids, $request->get('id'));
            Session::put('ids', $ids);
            return response()->json(count($ids));
        }
        return abort(404);
    }
    function like(Request $request)
    {
        
       
        if ($request->has('id')) {
            $likes = Session::get('likes', []);
            if ($likes) {
                for ($i = 0; $i < count($likes); $i++) {
                    if ($request->get('id') == $likes[$i]) {

                        return response()->json(count($likes));
                    }
                }
            }
                array_push($likes, $request->get('id'));
                Session::put('likes', $likes);
                return response()->json(count($likes));
            
        }
        return abort(404);
    }

}
