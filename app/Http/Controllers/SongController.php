<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Auth;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function latest()
    {
        $songs = Song::with([
            'artists'
        ])->favourited(Auth::id())->latest()->get();
        return response()->json([
            "songs" => $songs
        ]);
    }
}
