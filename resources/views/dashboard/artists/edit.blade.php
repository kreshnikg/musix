@extends('layouts.dashboard')
@section('content')
    <div class="card shadow-sm border-0">
        <h5 class="card-header bg-white">
            Ndrysho të dhënat e makinës
        </h5>
        <div class="card-body">
            <div class="w-25">
                <form method="POST" action="/dashboard/artists/{{$artist->artist_id}}">
                    @csrf
                    @method("PATCH")
                    <div class="form-group">
                        <label for="full_name">Emri</label>
                        <input class="form-control @error('full_name') is-invalid @enderror"
                               type="text"
                               name="full_name"
                               id="full_name"
                               value="{{$artist->full_name}}"
                               required/>
                        @error('full_name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="material_types">Zhanret</label>
                        <select class="js-example-basic-multiple form-control @error('genres') is-invalid @enderror"
                                name="genres[]"
                                id="genres"
                                multiple="multiple">
                            @foreach($genres as $genre)
                                @php
                                    $selected = false;
                                    foreach($artist->genres as $artistGenre) {
                                        if($artistGenre->genre_id == $genre->genre_id)
                                            $selected = true;
                                    }
                                @endphp
                                <option {{ $selected ? "selected" : "" }} value={{$genre->genre_id}}>{{$genre->title}}</option>
                            @endforeach
                        </select>
                        @error('genres')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Ruaj ndryshimet</button>
                </form>
            </div>
        </div>
    </div>
@endsection
