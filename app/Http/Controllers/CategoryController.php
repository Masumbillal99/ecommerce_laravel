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
        $deleted_categories = Category::onlyTrashed()->get();
        return view('admin.category.index', compact('categories', 'deleted_categories'));
    }
    function addcategorypost(Request $request){
        $request->validate([
            'category_name' => 'required|unique:categories,category_name'
        ],
        [
            'category_name.required' => 'Please input category',
            'category_name.unique' => 'You can not use this category name'
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
        return view('admin.category.update', compact('category_name', 'category_id'));
    }
    function updatecategorypost(Request $request){
        Category::find($request->category_id)->update([
            'category_name' =>$request->category_name
        ]);
        return redirect('add/category')->with('update_status', 'Category Update Successfully');
    }
    function deletecategory($category_id){
        Category::find($category_id)->delete();
        return back()->with('delete_status', 'Category Delete Successfully');
    }
    function restorecategory($category_id){
    Category::withTrashed()->find($category_id)->restore();
    return back()->with('restore_status', 'Category Restore Successfully');
    }
    function harddeletecategory($category_id){
        Category::onlyTrashed()->find($category_id)->forceDelete();
        return back()->with('harddelete_status', 'Category Hard Delete Successfully');
    }
}
