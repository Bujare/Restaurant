<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Food;

use App\Models\Foodchef;

use App\Models\Cart;

use App\Models\Order;

class HomeController extends Controller
{
    public function index()
    {
        $usertype = auth()->check() ? auth()->user()->usertype : false;

        if ($usertype == '1') {
            return view('admin.adminhome');
        } else {
            $data = Food::get();
            $data2 = Foodchef::get();
            $count = Cart::where('user_id', auth()->id())->count();
            return view('home', compact('data', 'data2', 'count'));
        }
    }


    public function redirects()
    {
        return redirect('/');
    }


    public function addcart(Request $request, $id)
    {
        Cart::create([
            'user_id' => auth()->id(),
            'food_id' => $id,
            'quantity' => $request->quantity
        ]);

        return redirect()->back();
    }



    public function showcart(Request $request, $id)
    {

        $count = Cart::where('user_id', auth()->id())->count();

        $data = Cart::where('user_id', auth()->id())->join('food', 'carts.food_id', '=', 'food.id')->get();

        return view('showcart', compact('count', 'data'));
    }




    public function remove($id)
    {
        Cart::findOrFail($id)->delete();

        return redirect()->back();
    }


    public function orderconfirm(Request $request)
    {

        foreach ($request->foodname as $key => $foodname) {
            Order::create([
                'foodname' => $foodname,
                'price' => $request->price[$key],
                'quantity' => $request->quantity[$key],
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address
            ]);
        }
        Cart::where('user_id', auth()->id())->delete();

        return redirect()->back();
    }
}
