<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;


class UserController extends Controller
{
    //show register/create form


    public function create(){
        return view('users.register');
    }
//9DRRU#9Ej&6@?z*
    // create new user
    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' =>'required|confirmed|min:3'
        ]);

        //hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        //Create user
        $user = User::create($formFields);

        //login
        auth()->login($user);
        return redirect('/home')->with('message', 'User created and logged in');

    }

    //logout
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/home')->with('message', 'You have been Logged out');
        

    }

    //show login form

    public function login(){
        return view('users.login');
    }

    //authenticate user

    public function authenticate(Request $request){

    $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' =>'required'
        ]);
        if(auth()->attempt($formFields)){
            $request->session()->regenerate();

            return redirect('/home')->with('message', "You are Logged In");
        }
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}

//? this is a styled comment 
//!this is a warming comment
//TODO: this is a todo comment
//* this is a green comment
//// this is a bulshit comment