<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Food;

use App\Models\Reservation;

use App\Models\Foodchef;

use App\Models\Order;

use Illuminate\Support\Facades\Auth;



class AdminController extends Controller
{


  public function user()
  {
    $data = User::paginate(20);
    return view("admin.users", compact("data"));
  }

  public function deleteuser(User $user)
  {
    $user->delete();
    return redirect()->back();
  }

  public function deletemenu(Food $food)
  {
    $food->delete();

    return redirect()->back();
  }



  public function foodmenu()
  {
    $data = Food::paginate(20);
    return view("admin.foodmenu", compact("data"));
  }


  public function updateview($id)
  {
    $food = Food::findOrFail($id);
    return view("admin.updateview", ['data' => $food]);
  }

  public function update(Request $request, Food $food)
  {
    if($request->hasFile('image')){
      $image = $request->image;
      $imagename = time() . '.' . $image->getClientOriginalExtension();
      $request->image->move('foodimage', $imagename);
      $food->update(['image' => $imagename]);
    }

    $food->update([
      'title' => $request->title,
      'price' => $request->price,
      'description' => $request->description
    ]);

    return redirect()->back();
  }




  public function upload(Request $request)
  {

    $food = Food::create([
      'title' => $request->title,
      'price' => $request->price,
      'description' => $request->description
    ]);

    if($request->hasFile('image')){
      $image = $request->image;
      $imagename = time() . '.' . $image->getClientOriginalExtension();
      $request->image->move('foodimage', $imagename);
      $food->update(['image' => $imagename]);
    }

    return redirect()->back();
  }




  public function reservation(Request $request)
  {
    Reservation::create($request->all());

    return redirect()->back()->with('alert', 'Reserved!');
  }

  public function viewreservation()
  {
    $data = Reservation::latest()->paginate(20);

    return view("admin.adminreservation", compact("data"));
  }


  public function viewchef()
  {
    $data = Foodchef::latest()->paginate(20);
    return view("admin.adminchef", compact("data"));
  }




  public function uploadchef(Request $request)
  {

    $foodchef = Foodchef::create([
      'name' => $request->name,
      'speciality' => $request->speciality
    ]);

    if($request->hasFile('image')){
      $image = $request->image;
      $imagename = time() . '.' . $image->getClientOriginalExtension();
      $request->image->move('foodimage', $imagename);
      $foodchef->update(['image' => $imagename]);
    }
    return redirect()->back();
  }



  public function updatechef(Foodchef $food_chef)
  {
    return view("admin.updatechef", ['data' => $food_chef]);
  }

  public function updatefoodchef(Request $request, Foodchef $food_chef)
  {
    $food_chef->update([
      'name' => $request->name,
      'speciality' => $request->speciality
    ]);

    if($request->hasFile('image')){
      $image = $request->image;
      $imagename = time() . '.' . $image->getClientOriginalExtension();
      $request->image->move('foodimage', $imagename);
      $food_chef->update(['image' => $imagename]);
    }

    return redirect()->back();
  }


  public function deletechef(Foodchef $food_chef)
  {
    $food_chef->delete();
    return redirect()->back();
  }


  public function orders()
  {
    return view('admin.orders', ['data' => Order::latest()->paginate(20)]);
  }

  public function search(Request $request)
  {
    $orders = Order::query();
    if($request->filled('search'))
    {
      $orders = $orders->where('name', 'Like', '%' . $request->search . '%')->orWhere('foodname', 'Like', '%' . $request->search . '%');
    }

    $orders = $orders->get();
    return view('admin.orders', ['data' => $orders]);
  }
}
