<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminLoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:admin');
    }
    public function ShowLoginForm(){
        return view('auth.admin-login');
    }
    public function login(Request $request){
        // Validate the form data
        $this->Validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        //Attempt to log the user in
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
        // if success  then redirect to their intended location
        return  redirect()->intended(route('admin.dashboard'));   
        }
        // if unsuccess then redirect back to the login with form data
        return redirect()->back()->withInput($request->only('email','remember'));
    }
}
