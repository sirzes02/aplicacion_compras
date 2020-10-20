<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentUser = User::find(Auth::id());

        $carrito = $currentUser->carrito;

        if ($carrito != "") {
            $strip = substr($carrito, 1);

            $arr = explode("-", $strip);

            $list = array();

            for ($i = 0; $i < count($arr); $i++) {
                $aux = explode(".", $arr[$i]);

                $allProducts = Product::all();
                $data = "";

                foreach ($allProducts as $pro) {
                    if ($pro->reference == $aux[1]) {
                        $data = $pro->cost;
                        break;
                    }
                }

                $obj = (object) ['cant' => $aux[0], "reference" => $aux[1], "total" => $data * $aux[0]];

                array_push($list, $obj);
            }

            return view("car", ["products" => $list]);
        } else {
            return view("car", ["products" => (object)[]]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currentUser = User::find(Auth::id());

        $carrito = $currentUser->carrito;

        if ($carrito != "") {
            $strip = substr($carrito, 1);

            $arr = explode("-", $strip);

            $text = "";

            for ($i = 0; $i < count($arr); $i++) {
                $aux = explode(".", $arr[$i]);

                if ($aux[1] != $id) {
                    $text = $text . "-" . $aux[0] . "." . $aux[1];
                }
            }

            $currentUser->carrito = $text;
        }

        $currentUser->update();
    }

    public function removeAll()
    {
        $currentUser = User::find(Auth::id());

        $currentUser->carrito = "";

        $currentUser->update();

        return view('home', ["products" => Product::all()]);
    }
}
