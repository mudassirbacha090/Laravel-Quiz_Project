<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Session;
class AdminController extends Controller
{
    function login(Request $request)
    {
        //  Validate input
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Check admin credentials
        $admin = Admin::where('name', $request->username)
                      ->where('password', $request->password)
                      ->first();

        // If admin not found, return back with error
        if (!$admin) {
            return back()->withErrors([
                'user' => 'The username or password is not valid'
            ])->withInput();
        }
    Session::put('admin', $admin);

       return redirect('dashboard');
        
    }
    function dashboard()
    {
       
        $admin = Session::get('admin');
        if($admin){
        return view('admin', ['admin' => $admin]);
        }else{
            return redirect('admin-login');
        }
    }
}
