<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Song;
use App\Models\SongArtist;
use App\Models\SongGenre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $songs = Song::with('artists')->latest()->paginate(15);
        return view('dashboard.songs.index', [
            "songs" => $songs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $artists = Artist::all();
        $genres = Genre::all();
        return view('dashboard.songs.create', [
            "artists" => $artists,
            "genres" => $genres
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ["required", "string", "max:200"],
            'release_date' => ["required", "date"],
            'artists' => ["required", "array"],
            'genres' => ["required", "array"],
            'audio_file' => ["required", "mimes:mp3"],
            'audio_file_duration' => ["required", "numeric"]
        ]);

        $titleExists = Song::where('title',$request->input('title'))->exists();
        if($titleExists) {
            throw ValidationException::withMessages([
                "title" => ['Ekziston një këngë me këtë titull!']
            ]);
        }

        $audioFile = $request->file('audio_file');
        $extension = $audioFile->getClientOriginalExtension();
        $fileNameToStore = Str::uuid() . '.' . $extension;
        $path = $audioFile->storeAs('public/songs', $fileNameToStore);

        \DB::transaction(function () use ($request, $path) {
            $song = new Song;
            $song->title = $request->input('title');
            $song->href = toURL($song->title);
            $song->release_date = $request->input('release_date');
            $song->audio_file = str_replace("public/", "", $path);
            $song->duration = $request->input('audio_file_duration');
            $song->save();

            $genreIds = $request->input('genres');
            $artistIds = $request->input('artists');

            $genres = Genre::select('genre_id')->find($genreIds);
            foreach ($genres as $genre) {
                SongGenre::create([
                    "song_id" => $song->song_id,
                    "genre_id" => $genre->genre_id
                ]);
            }

            $artists = Artist::select('artist_id')->find($artistIds);
            foreach ($artists as $artist) {
                SongArtist::create([
                    "song_id" => $song->song_id,
                    "artist_id" => $artist->artist_id
                ]);
            }
        });

        return redirect("/dashboard/songs")->with('success', "Kënga u krijua me sukses.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $song = Song::with(['genres', 'artists'])->findOrFail($id);
        $genres = Genre::all();
        $artists = Artist::all();
        return view('dashboard.songs.edit', [
            "song" => $song,
            "genres" => $genres,
            "artists" => $artists,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => ["required", "string", "max:200"],
            'release_date' => ["required", "date"],
            'artists' => ["required", "array"],
            'genres' => ["required", "array"],
            'audio_file' => ["mimes:mp3"],
        ]);

        $song = Song::findOrFail($id);

        $path = null;
        if($request->hasFile('audio_file')) {
            $audioFile = $request->file('audio_file');
            $extension = $audioFile->getClientOriginalExtension();
            $fileNameToStore = Str::uuid() . '.' . $extension;
            $path = $audioFile->storeAs('public/songs', $fileNameToStore);
        }

        \DB::transaction(function () use ($request, $path, $song) {
            $song->title = $request->input('title');
            $song->href = toURL($song->title);
            $song->release_date = $request->input('release_date');
            if($path) {
                $song->audio_file = str_replace("public/", "", $path);
                $song->duration = $request->input('audio_file_duration');
            }
            $song->save();

            $genreIds = $request->input('genres');
            $artistIds = $request->input('artists');

            $genres = Genre::select('genre_id')->find($genreIds);
            SongGenre::where('song_id', $song->song_id)->delete();
            foreach ($genres as $genre) {
                SongGenre::create([
                    "song_id" => $song->song_id,
                    "genre_id" => $genre->genre_id
                ]);
            }

            $artists = Artist::select('artist_id')->find($artistIds);
            SongArtist::where('song_id', $song->song_id)->delete();
            foreach ($artists as $artist) {
                SongArtist::create([
                    "song_id" => $song->song_id,
                    "artist_id" => $artist->artist_id
                ]);
            }
        });

        return redirect('/dashboard/songs')->with('success', "Ndryshimet u ruajtën me sukses.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $song = Song::findOrFail($id);
        Storage::delete($song->audio_file);
        $song->delete();
        return redirect('/dashboard/songs')->with('success', "Kënga u fshi me sukses");
    }
}
