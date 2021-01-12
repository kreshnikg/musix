<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\PlaylistSong;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::where('user_id', Auth::id())->get();
        return response()->json([
            "playlists" => $playlists
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "title" => ["required", "max:255", "string"]
        ]);
        $playlist = new Playlist();
        $playlist->user_id = Auth::id();
        $playlist->title = $request->input('title');
        $playlist->save();
        return response()->json("success");
    }

    public function show($playlistId)
    {
        $playlist = Playlist::with('songs.artists')->where('user_id', Auth::id())
            ->where('playlist_id', $playlistId)->firstOrFail();
        return response()->json([
            "playlist" => $playlist
        ]);
    }

    public function destroy($playlistId)
    {
        $playlist = Playlist::where('user_id', Auth::id())
            ->where('playlist_id', $playlistId)->firstOrFail();
        $playlist->delete();
        return response()->json("success");
    }

    public function addSong(Request $request, $playlistId)
    {
        $this->validate($request, [
            "song_id" => ["required"]
        ]);
        $playlist = Playlist::where('user_id', Auth::id())
            ->where('playlist_id', $playlistId)->firstOrFail();
        $song = Song::findOrFail($request->input("song_id"));
        $playlistSong = new PlaylistSong();
        $playlistSong->song_id = $song->song_id;
        $playlistSong->playlist_id = $playlist->playlist_id;
        $playlistSong->save();
        return response()->json("success");
    }

    public function removeSong(Request $request, $playlistId)
    {
        $this->validate($request, [
            "song_id" => ["required"]
        ]);
        $playlist = Playlist::where('user_id', Auth::id())
            ->where('playlist_id', $playlistId)->firstOrFail();
        $song = Song::findOrFail($request->input("song_id"));
        PlaylistSong::where('playlist_id', $playlist->playlist_id)
            ->where('song_id', $song->song_id)->delete();
        return response()->json("success");
    }
}
