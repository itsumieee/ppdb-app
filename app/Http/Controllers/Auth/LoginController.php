<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Ganti field login dari 'email' menjadi 'nik'
    public function username()
    {
        return 'nik';
    }

    protected function credentials(Request $request)
    {
        return [
            'nik' => $request->input('nik'),
            'password' => $request->input('password'),
        ];
    }
}