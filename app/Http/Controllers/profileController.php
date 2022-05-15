<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;

class profileController extends Controller
{
    function index(){
        return view('admin.profile.index');
    }
    function profilepost(Request $request){
        $request->validate([
            'name'  => 'required'
        ]);
        $old_name = Auth::user()->name;
        User::find(Auth::id())->update([
            'name'  => $request->name
        ]);
        return back()->with('success_message', 'Your name updated from '. $old_name .' successfully to ' . $request->name);
    }
    function passwordpost(Request $request){
        $request->validate([
            'old_password'  =>  'required',
            'password'  =>  'required|confirmed',
            'password_confirmation'  =>  'required'
        ]);
        if($request->old_password == $request->password){
            return back()->withErrors('Your new password cannot be old password');
        }
        $old_password_from_user = $request->old_password;
        $password_form_user_db = Auth::user()->password;
        if(Hash::check($old_password_from_user, $password_form_user_db)){
            User::find(Auth::id())->update([
                'password'  => Hash::make($request->password)
            ]);
        }
        else{
            return back()->with('database_status', "Your old password daes not match with database password");
        }
        return back()->with('password_change_status', 'Your password change successfullly');
    }
}
