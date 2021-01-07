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
//        $path = storage_path().DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR.$song->audio_file;
//        $response = new BinaryFileResponse($path);
//        BinaryFileResponse::trustXSendfileTypeHeader();
//        return $response;
    }
}
