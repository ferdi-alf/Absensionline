<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiguruController extends Controller
{
    function loginguru()
    {
        return view('loginguru');
    }

    function logguru(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'tingkat' => 'required',
                'jurusan' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'username wajib di isi',
                'tingkat.required' => 'tingkat wajib dipilih',
                'jurusan.required' => 'jurusan wajib dipiliih',
                'password.required' => 'password wajib di isi',
            ]
        );

        $infologin = [
            'username' => $request->username,
            'tingkat' => $request->tingkat,
            'jurusan' => $request->jurusan,
            'password' => $request->password,
        ];

        if (Auth::guard('guru')->attempt($infologin)) {
            return redirect('/guru');
        } else {
            return redirect('/loginguru')->withErrors('Gagal masuk. Ada kesalahan mohon di periksa lagi')->withInput();
        }
    }

    function logoutguru()
    {
        Auth::guard('guru')->logout();
        return redirect('/loginguru');
    }
}