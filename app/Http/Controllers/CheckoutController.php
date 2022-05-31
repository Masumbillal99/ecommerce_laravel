<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Order;
use Carbon\Carbon;
use Auth;

class CheckoutController extends Controller
{
    function  __construct(){
        $this->middleware('auth');
    }

    function index(Request $request){
        if(Auth::user()->role == 1){
            echo 'you admin , cannot bye product admin';
        }
        else{
            return view('checkout', [
                'carts' =>  Cart::where('ip_address', request()->ip())->get(),
                'total' => $request->total
            ]);
        }
        
    }
    function checkoutpost(Request $request){
        Order::insert([
            'user_id'   => Auth::id(),
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phoe_number' => $request->phoe_number,
            'country' => $request->country,
            'address' => $request->address,
            'post_code' => $request->post_code, 
            'city' => $request->city,
            'notes' => $request->notes,
            'payment_option' => $request->payment_option,
            'created_at' => Carbon::now()
        ]);
        echo 'done';
        // print_r($request->all());
    }
}
