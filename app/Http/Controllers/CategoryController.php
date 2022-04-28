<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Auth;
use Carbon\Carbon;

class CategoryController extends Controller
{
    function addcategory(){
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }
    function addcategorypost(Request $request){
        $request->validate([
            'category_name' => 'required'
        ],
        [
            'category_name.required' => 'Please input category'
        ]);
        Category::insert([
            'category_name' => $request->category_name,
            'user_id'   => Auth::user()->id,
            'created_at'    => Carbon::now()
        ]);
       return back()->with('success_messge', 'Your category added successfully');
    }
    function updatecategory($category_id){
        // echo $category_id;
        $category_name = Category::find($category_id)->category_name;
        return view('admin.category.update', compact('category_name'));
    }
}
