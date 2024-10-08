<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginAdmin()
    {
//        if(auth() -> check()) {
//            return redirect()->to('home');
//        }
//        dd(bcrypt('123456'));
        return view('login');
    }

    public function postLoginAdmin(Request $request)
    {
//        dd($request->has('remember_me'));
        $remember = $request->has('remember_me') ? true : false;
        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $remember))
        {
////            return redirect()->to('home');
//            $userId = auth()->id(); // Lấy user ID
//            session(['user_id' => $userId]);
            return redirect()->to('home');//->with('user_id', $userId);
        }
    }
}
