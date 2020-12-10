<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouritesController extends Controller
{
    public function index()
    {
        $user = User::with('favouriteSongs')->find(\Auth::id());
        return response()->json([
            "songs" => $user->favouriteSongs
        ]);
    }

    public function addSong(Request $request)
    {
        $this->validate($request, [
            "song_id" => "required"
        ]);

        $song = Song::findOrFail($request->input('song_id'));
        $user = User::findOrFail(Auth::id());
        $user->addFavourite($song);
        return response()->json("success");
    }

    public function removeSong(Request $request)
    {
        $this->validate($request, [
            "song_id" => "required"
        ]);

        $song = Song::findOrFail($request->input('song_id'));
        $user = User::findOrFail(Auth::id());
        $user->removeFavourite($song);
        return response()->json("success");
    }
}
