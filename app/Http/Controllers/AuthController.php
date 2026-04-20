<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view('login.login');
    }

    public function loginsave(Request $request){

          

           dd($request->all());
    }
}
