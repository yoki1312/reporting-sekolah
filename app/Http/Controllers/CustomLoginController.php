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
    // printJSON($request->all());
    // printJSON(Auth::attempt(['username' => $request->username, 'password' => $request->password,'is_login'=> 1]));
    // printJSON(Auth::attempt(['nuptk' => $request->npsn, 'password' => $request->password]));
    if (Auth::attempt(['nuptk' => $request->npsn, 'password' => $request->password]) ){
        return redirect('/');
    }else if(Auth::attempt(['nip' => $request->npsn, 'password' => $request->password]) ){
        return redirect('/');
    }else if(Auth::attempt(['npsn' => $request->npsn, 'password' => $request->password]) ){
        return redirect('/');
    }else{
        //    printJSON($request->all());
           return redirect()->back();
       }
}
}
