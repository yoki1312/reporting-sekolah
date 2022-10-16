<?php

namespace App\Http\Controllers;

use App\LoginUserModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// LoginUserModels

class CustomLoginController extends Controller
{
    public function postLogin(Request $request)
{
    // printJSON(Auth::attempt(['username' => $request->username, 'password' => $request->password,'is_login'=> 1]));
    if (Auth::attempt(['npsn' => $request->npsn, 'password' => $request->password]) )
    {     
        return redirect('/');
    }else{
        //    printJSON($request->all());
           return redirect()->back();
       }
}
}
