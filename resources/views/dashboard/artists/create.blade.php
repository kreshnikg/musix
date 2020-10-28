@extends('layouts.dashboard')
@section('content')
    <div class="card shadow-sm border-0">
        <h5 class="card-header bg-white">
            Krijo artist
        </h5>
        <div class="card-body">
            <div class="w-25">
                <form method="POST" action="/dashboard/artists">
                    @csrf
                    <div class="form-group">
                        <label for="full_name">Emri</label>
                        <input class="form-control @error('full_name') is-invalid @enderror"
                               type="text"
                               name="full_name"
                               id="full_name"
                               value="{{ old('full_name') }}"
                               required/>
                        @error('full_name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="genres">Zhanret</label>
                        <select class="js-example-basic-multiple form-control @error('genres') is-invalid @enderror"
                                name="genres[]"
                                id="genres"
                                multiple="multiple">
                            @foreach($genres as $genre)
                                <option value={{$genre->genre_id}}>{{$genre->title}}</option>
                            @endforeach
                        </select>
                        @error('genres')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Krijo artistin</button>
                </form>
            </div>
        </div>
    </div>
@endsection
