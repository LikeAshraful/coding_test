<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeAuthController extends Controller
{
    public function index()
    {
        return view('employee.home');
    }

    public function login()
    {
        return view('employee.login');
    }

    public function handleLogin(Request $req)
    {
        if(Auth::guard('webemployee')->attempt(
            $req->only(['email', 'password'])
        ))
        {
            return redirect()->intended('/employee');
        }

        return redirect()
            ->back()
            ->with('error', 'Invalid Credentials');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('employee.login');
    }
}
