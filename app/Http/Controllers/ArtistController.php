<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::with([
            'genres'
        ])->latest()->get();
        return response()->json([
            'artists' => $artists
        ]);
    }
}
