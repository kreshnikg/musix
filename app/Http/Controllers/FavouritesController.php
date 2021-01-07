<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\User;
use App\Models\UserFavouriteSong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouritesController extends Controller
{
    public function index()
    {
        $user = User::with('favouriteSongs.artists')->find(\Auth::id());
        return response()->json([
            "songs" => $user->favouriteSongs
        ]);
    }

    public function toggleSong(Request $request)
    {
        $this->validate($request, [
            "song_id" => "required"
        ]);

        $song = Song::findOrFail($request->input('song_id'));
        $user = User::findOrFail(Auth::id());
        if(!UserFavouriteSong::where('song_id', $song->song_id)->where('user_id', $user->user_id)->exists())
            $user->addFavourite($song);
        else
            $user->removeFavourite($song);
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
