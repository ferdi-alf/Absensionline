<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use view;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SesiController extends Controller
{
    public function login()
    {
        return view('login');
    }

    function log(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ], [
            'name.required' => 'username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $infologin = [
            'name' => $request->name,
            'password' => $request->password,
        ];

        // membuat agar user tidak bisa mengakses admin sebelum login
        if (Auth::attempt($infologin)) {
            return redirect('/admin');
        } else {
            return redirect('/login')->withErrors('Username dan Password Salah')->withInput();
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}