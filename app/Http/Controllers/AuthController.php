<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth; 

class AuthController extends Controller{

    // here we will write the code to register a user 
    //this name has to be the same name which we used in the routes 
    public function register (Request $request){
        //here we will validate the fields 

        $attrs= $request->validate([
            'name'=>'required|string', 
            'email'=>'required|email|unique:users,email', 
            'password'=>'required|min:8|confirmed'
        ]);

        //we will create a user with the validated attributes 
        $user= User::create([
            'name' => $attrs['name'],
            'email' => $attrs['email'], 
            'password' =>bcrypt($attrs['password'])

        ]);

        return response(
           [ 'user' =>$user, 
            'token' =>$user ->createToken('secret')->plainTextToken
           ]
        );
    }

    ///this function handles the login 
        public function login (Request $request){
        //here we will validate the fields 

        $attrs= $request->validate([
            'email'=>'required|email', 
            'password'=>'required|min:8'
        ]);

        //here we will make a login attempt with the validates input fields
       if(!Auth::attempt($attrs)){
          return response(
          [ 
             'message'=>'invalid credentials'], 403
          );
       }

        return response(
           [ 'user' =>auth()->user(), 
            'token' =>auth()->user()->createToken('secret')->plainTextToken
        ], 200
        );
    }



    //logout user
    public function logout(){
        auth()->user()->tokens()->delete();
        return response(
            ['message'=>'logout successful.'], 200
        );
    }

    //here we will see the details of the user
    public function user(){
         return response(
            ['user' => auth()->user()], 200 
         );
    }

}