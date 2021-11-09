@extends('layouts.dashboard')
@section('content')
    <div class="card shadow-sm border-0">
        <h5 class="card-header bg-white">
            Ndrysho të dhënat e këngës
        </h5>
        <div class="card-body">
            <div class="w-25">
                <form method="POST" action="/dashboard/songs/{{ $song->song_id }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="title">Titulli</label>
                        <input class="form-control @error('title') is-invalid @enderror"
                               type="text"
                               name="title"
                               id="title"
                               value="{{ $song->title }}"
                               required/>
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="release_date">Data e lansimit</label>
                        <input class="form-control @error('release_date') is-invalid @enderror"
                               type="date"
                               name="release_date"
                               id="release_date"
                               value="{{ $song->release_date }}"
                               required/>
                        @error('full_name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="artists">Artistët</label>
                        <select class="js-example-basic-multiple form-control @error('artists') is-invalid @enderror"
                                name="artists[]"
                                id="artists"
                                multiple="multiple">
                            @foreach($artists as $artist)
                                @php
                                    $selectedArtist = false;
                                    foreach($song->artists as $songArtist) {
                                        if($songArtist->artist_id == $artist->artist_id)
                                            $selectedArtist = true;
                                    }
                                @endphp
                                <option {{ $selectedArtist ? "selected" : "" }} value={{$artist->artist_id}}>{{$artist->full_name}}</option>
                            @endforeach
                        </select>
                        @error('artists')
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
                                @php
                                    $selectedGenre = false;
                                    foreach($song->genres as $songGenre) {
                                        if($songGenre->genre_id == $genre->genre_id)
                                            $selectedGenre = true;
                                    }
                                @endphp
                                <option {{ $selectedGenre ? "selected" : "" }} value={{$genre->genre_id}}>{{$genre->title}}</option>
                            @endforeach
                        </select>
                        @error('genres')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="audio_file">Audio (.mp3)</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file"
                                       name="audio_file"
                                       class="custom-file-input @error('audio_file') is-invalid @enderror"
                                       id="audio_file"
                                       aria-describedby="audio_file"
                                       accept="audio/mp3">
                                <label class="custom-file-label" for="audio_file">Zgjedh skedarin</label>
                                @error('audio_file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="audio_file_duration" name="audio_file_duration" />
                    <button type="submit" class="btn btn-primary">Ruaj ndryshimet</button>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        let audioFileInput = document.getElementById("audio_file");
        const appendDuration = (duration) => {
            document.getElementById('audio_file_duration').value = duration;
        }

        audioFileInput.onchange = function (e) {
            console.log(e)
            if(audioFileInput.files.length === 0) return;
            let audioFile = audioFileInput.files[0];
            let audioEl = document.createElement('audio');
            audioEl.preload = 'metadata';
            audioEl.onloadedmetadata = function () {
                window.URL.revokeObjectURL(audioEl.src);
                appendDuration(Math.round(audioEl.duration));
            }
            audioEl.src = URL.createObjectURL(audioFile);
        }
    </script>
@endsection
