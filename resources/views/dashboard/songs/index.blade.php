@extends('layouts.dashboard')

@section('content')

    <div class="d-flex align-items-center mb-4">
        <h4 class="mb-0">Këngët</h4>
        <a href="/dashboard/songs/create" class="btn btn-primary my-btn-primary-color ml-auto my-shadow">Shto
            këngë</a>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card my-shadow border-0">
                <table class="table my-table">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col">Titulli</th>
                        <th scope="col">Artistët</th>
                        <th scope="col">Nr. klikimeve</th>
                        <th scope="col">Kohëzgjatja (minuta)</th>
                        <th scope="col">Data e lansimit</th>
                        <th scope="col"/>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($songs as $key => $song)
                        <tr>
                            <th class="text-center" scope="row">{{$key + 1}}</th>
                            <td>{{$song->title}}</td>
                            <td>
                                @foreach($song->artists as $artist)
                                    {{$artist->full_name}}@if(!$loop->last){{", "}}@endif
                                @endforeach
                            </td>
                            <td>{{$song->total_play_count}}</td>
                            <td>{{gmdate("i:s", $song->duration)}}</td>
                            <td>{{$song->release_date}}</td>
                            <td>
                                <a class="btn btn-link btn-sm" style="color: #5e676f"
                                   href="/dashboard/songs/{{$song->song_id}}/edit">
                                    <i class="fas fa-pen px-1"></i>
                                </a>
                                <button class="btn btn-link btn-sm"
                                        style="color: #5e676f"
                                        type="button"
                                        onclick="alertAndSubmit(
                                                'Pas fshierjes së këngës {{$song->title}}, ju nuk do të jeni në gjendje ta riktheni atë!',
                                                'Fshi këngën!',
                                                '#delete-song-{{$song->song_id}}'
                                                )">
                                    <i class="fas fa-trash px-1"></i>
                                </button>
                                <form method="POST" id="delete-song-{{$song->song_id}}" action="/dashboard/songs/{{$song->song_id}}">
                                    @csrf
                                    @method("DELETE")
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mx-auto">
                    {{$songs->links()}}
                </div>
                @if(count($songs) == 0)
                    <span class="text-center mb-3">Nuk ka këngë</span>
                @endif
            </div>
        </div>
    </div>
@endsection
