<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
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

     public function addproduct() 
    {
       return view('admin.product.index',[
           'categories' => Category::all()
       ]);
    }

     public function addproductpost(Request $request)
    {
        $product_id = Product::insertGetId([
            'product_name'  => $request->product_name,
            'category_id'  => $request->category_id,
            'product_price'  => $request->product_price,
            'product_quantity'  => $request->product_quantity,
            'product_short_description'  => $request->product_short_description,
            'product_long_description'  => $request->product_long_description,
            'product_thumbnail_photo'  => 'product_thumbnail_photo',
            'created_at'  => Carbon::now()
        ]);

         //photo upload start
        $uploaded_photo = $request->file('product_thumbnail_photo');
        $new_name = $product_id.'.'.$uploaded_photo->getClientOriginalExtension();
        $new_upload_location = base_path('public/uploads/product_photos/' . $new_name);
        Image::make($uploaded_photo)->resize(600,622)->save($new_upload_location, 50);
        //photo upload end

        Product::find($product_id)->update([
            'product_thumbnail_photo'    => $new_name
        ]);

    //    return view('admin.product.index');
    return back();
    }
}
