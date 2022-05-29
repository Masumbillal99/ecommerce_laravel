<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Product_multiple_photos;
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
           'categories' => Category::all(),
           'products' => Product::all()
       ]);
    }

     public function addproductpost(Request $request)
    {
        // $request->validate([
        //     'product_name' => 'required|unique:products,product_name',
        //     'category_id' => 'required',
        //     'product_price' => 'required',
        //     'product_quantity' => 'required',
        //     'product_short_description' => 'required',
        //     'product_long_description' => 'required',
        //     'product_thumbnail_photo' => 'required|require',
        // ],
        // [
        //     'product_name.required' => 'Please input product',
        //     'product_name.unique' => 'You can not use this product name',
        //     'category_id.required' => 'Please select product category',
        //     'product_price.required' => 'Please input product price',
        //     'product_quantity.required' => 'Please input product quantity',
        //     'product_short_description.required' => 'Please input product long description',
        //     'product_long_description.required' => 'Please input product Short description',
        //     'product_thumbnail_photo.required' => 'Please input product image',
        // ]);  

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

        //multiple photo upload start
        $flag = 1;
        foreach($request->file('product_multiple_photos') as $product_multiple_photo){
        $uploaded_photo = $product_multiple_photo;
        $new_name = $product_id . '-' . $flag .'.'.$uploaded_photo->getClientOriginalExtension();
        $new_upload_location = base_path('public/uploads/product_multiple_photos/' . $new_name);
        Image::make($uploaded_photo)->resize(600,550)->save($new_upload_location, 50);
        //photo upload end
        Product_multiple_photos::insert([
            'product_id' => $product_id,
            'photo_name'  => $new_name,
            'created_at'    => Carbon::now()
        ]);
        $flag++;
        }
        //multiple photo upload end
        return back()->with('success_messge', 'Your product added successfully');
    }
}
