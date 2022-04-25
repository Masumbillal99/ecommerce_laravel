<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function addcategory(){
        return view('admin.category.index');
    }
    function addcategorypost(Request $request){
        $request->validate([
            'category_name' => 'required'
        ],
        [
            'category_name.required' => 'Please input category'
        ]);
        echo $request->category_name;
    }
}
