<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Support\Renderable|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        if(\Auth::check())
            if(Auth::user()->role_id === 1)
                return redirect('/dashboard');
//            if(!\Auth::user()->subscribed())
//                return redirect('/subscribe');

        return view('layouts.app');
    }

    public function mainView()
    {
        return view('layouts.app');
    }
}
