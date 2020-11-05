<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function index()
    {
        if(Auth::user()->subscribed())
            return redirect('/');
        return view('layouts.subscribe');
    }

    public function subscribe(Request $request)
    {
        $this->validate($request, [
            "card_number" => "required",
            "card_expiry_month" => ["required", "numeric", "min:1", "max:12"],
            "card_expiry_year" => ["required", "numeric"],
            "card_security_code" => "required"
        ]);

        $user = User::findOrFail(Auth::id());

        if($user->subscribed())
            return response()->json("Përdoruesi është i abonuar!", 422);

        $user->subscribe();

        return response()->json("success");
    }
}
