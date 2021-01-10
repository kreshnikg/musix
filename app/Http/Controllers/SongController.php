<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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

    public function topSongs()
    {
        $songs = Song::with(['artists'])
            ->favourited(Auth::id())
        ->orderBy('total_play_count', 'DESC')
        ->get();

        return response()->json([
            "songs" => $songs
        ]);
    }

    public function play($songId)
    {
        $song = Song::with(['artists'])->findOrFail($songId);
        $song->total_play_count = (int) $song->total_play_count + 1;
        $song->save();

        return response()->json([
            "song" => $song
        ]);
    }

    public function playNext($songId)
    {
        $song = Song::with(['artists'])->where('song_id', function ($query) use ($songId) {
            $query->from('song')->selectRaw('min(song_id)')->where('song_id', '<', $songId);
        })->first();
        if (!empty($song)) {
            $song->total_play_count = (int) $song->total_play_count + 1;
            $song->save();
        }
        return response()->json([
            "song" => $song
        ]);
    }

    public function playPrevious($songId)
    {
        $song = Song::with(['artists'])->where('song_id', function ($query) use ($songId) {
            $query->from('song')->selectRaw('min(song_id)')->where('song_id', '>', $songId);
        })->first();
        if (!empty($song)) {
            $song->total_play_count = (int) $song->total_play_count + 1;
            $song->save();
        }
        return response()->json([
            "song" => $song
        ]);
    }

    public function search()
    {
        $searchQuery = \Request::has('search') ? \Request::get('search') : null;
        $songs = Song::with('artists')
            ->where('title', 'like', "%$searchQuery%")
            ->get();
        return response()->json([
            "songs" => $songs
        ]);
    }
}
