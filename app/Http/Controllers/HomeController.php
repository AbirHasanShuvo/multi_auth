<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return Auth::user()->usertype === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('user.dashboard');
        }

        return redirect()->route('login');
    }
}
