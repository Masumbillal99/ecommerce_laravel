<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;

class FrontendController extends Controller
{
    function index(){
        return view('index', [
            'categories'    =>Category::all(),
            'products'    =>Product::latest()->get()  //latest->limit(2), ->take(2)
        ]);
    }
    function contact(){
        return view('contact');
    }
    function about(){
        return view('about');
    }
    function productdetails($product_id){
        return view('productdetails', [
            'product_info' => Product::find($product_id)
        ]);
    }
}
