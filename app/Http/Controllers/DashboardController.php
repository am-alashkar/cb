<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class DashboardController extends Controller
{
    //

    public function index()
    {
        if (!FacadesAuth::user()->email_verified_at)
        {
           // dd(FacadesAuth::user()->email_verified_at);
           // return view('auth.verify-email');
        }
        return view('dashboard');
    }
}
