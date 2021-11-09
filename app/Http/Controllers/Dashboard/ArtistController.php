<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\ArtistGenre;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artists = Artist::with('genres')->withCount('songs')->latest()->paginate(15);
        return view('dashboard.artists.index', [
            "artists" => $artists
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::all();
        return view('dashboard.artists.create', [
            "genres" => $genres
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "full_name" => ["required", "string", "max:255"],
            "genres" => ["required"]
        ]);

        $genreIds = $request->input("genres");
        if(!is_array($genreIds)) {
            throw ValidationException::withMessages([
                "genres" => ['Diqka nuk ishte në rregull!']
            ]);
        }

        if(Artist::where('href', toURL($request->input("full_name")))->exists()) {
            throw ValidationException::withMessages([
                "full_name" => ['Ky emër është i nxënë!']
            ]);
        }

        \DB::transaction(function() use ($request, $genreIds) {
            $artist = new Artist;
            $artist->full_name = $request->input("full_name");
            $artist->href = toURL($request->input("full_name"));
            $artist->save();

            $genres = Genre::select('genre_id')->find($genreIds);
            foreach ($genres as $genre) {
                ArtistGenre::create([
                    "artist_id" => $artist->artist_id,
                    "genre_id" => $genre->genre_id
                ]);
            }
        });

        return redirect("/dashboard/artists")->with('success', "Artisti u krijua me sukses.");
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
        $artist = Artist::with('genres')->findOrFail($id);
        $genres = Genre::all();
        return view('dashboard.artists.edit', [
            "artist" => $artist,
            "genres" => $genres
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
            "full_name" => ["required", "string", "max:255"],
            "genres" => ["required"]
        ]);

        $artist = Artist::findOrFail($id);

        $genreIds = $request->input("genres");
        if(!is_array($genreIds)) {
            throw ValidationException::withMessages([
                "genres" => ['Diqka nuk ishte në rregull!']
            ]);
        }

        $fullName = $request->input("full_name");
        if(Artist::where('href', toURL($fullName))
            ->where('artist_id', '!=', $id)->exists()) {
            throw ValidationException::withMessages([
                "full_name" => ['Ky emër është i nxënë!']
            ]);
        }

        \DB::transaction(function () use ($artist, $fullName, $genreIds) {
            if($fullName !== $artist->full_name) {
                $artist->full_name = $fullName;
                $artist->href = toURL($fullName);
                $artist->save();
            }

            $genres = Genre::select('genre_id')->find($genreIds);
            ArtistGenre::where('artist_id', $artist->artist_id)->delete();
            foreach ($genres as $genre) {
                ArtistGenre::create([
                    "artist_id" => $artist->artist_id,
                    "genre_id" => $genre->genre_id
                ]);
            }
        });

        return redirect('/dashboard/artists')->with('success', "Ndryshimet u ruajtën me sukses.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Artist::destroy($id);
        return redirect('/dashboard/artists')->with('success', "Artisti u fshi me sukses");
    }
}
