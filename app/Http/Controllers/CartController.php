<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use App\Cart;
use Carbon\Carbon;


class CartController extends Controller
{
    function addtocart(Request $request){
        if(Cart::where('product_id', $request->product_id)->where('ip_address', request()->ip())->exists()){
            Cart::where('product_id', $request->product_id)->where('ip_address', request()->ip())->increment('quantity', $request->quantity);
        }
        else{
            Cart::insert([
            'product_id'    => $request->product_id,
            'quantity'    => $request->quantity,
            'ip_address'    => request()->ip(),
            'created_at'    => Carbon::now()
        ]);
        }
        return back();
    }
    function cart($coupon_name = ''){
        if($coupon_name){
            if(Coupon::where('coupon_name', $coupon_name)->exists()){
                if(Coupon::where('coupon_name', $coupon_name)->first()->validity_till >= Carbon::now()->format('Y-m-d')){
                    return view('cart', [
                        'carts' => Cart::where('ip_address', request()->ip())->get(),
                        'discount_amount'  => Coupon::where('coupon_name', $coupon_name)->first()->discount_ammount,
                        'coupon_name'   => $coupon_name
                    ]);
                }
                else{
                    return redirect('cart')->with('invalid_error', 'your coupon is invalid');
                }
            }
            else{
                return redirect('cart')->with('no_exists_error', 'Your coupon does not exists');
            }
        }else{
            return view('cart', [
            'carts' => Cart::where('ip_address', request()->ip())->get()
        ]);
        }
        
    }

    function cartdelete($cart_id){
        Cart::find($cart_id)->delete();
        return back();
    }

    function cartupdate(Request $request){
        foreach($request->cart_quantity as $cart_id => $cart_updated_quantity){
            echo $cart_id . '<br>';
            echo '<br>';
            echo $cart_updated_quantity . '<br>';
            Cart::find($cart_id)->update([
                'quantity'  => $cart_updated_quantity
            ]);
        }
        return back();
    }
}
