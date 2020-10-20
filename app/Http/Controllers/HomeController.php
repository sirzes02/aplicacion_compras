<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Author;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::all();

        return view('home', ["products" => $products]);
    }

    public function show($id)
    {
        return view("show", ["product" => Product::find($id)]);
    }

    public function add(Request $request)
    {
        $currentUser = User::find(Auth::id());

        $currentUser->carrito = $currentUser->carrito . "-" . $request->get("quantity") . "." . $request->get("reference");

        $currentUser->update();

        return view('home', ["products" => Product::all()]);
    }
}
