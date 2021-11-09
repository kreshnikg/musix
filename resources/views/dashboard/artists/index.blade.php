@extends('layouts.dashboard')

@section('content')

    <div class="d-flex align-items-center mb-4">
        <h4 class="mb-0">Artistët</h4>
        <a href="/dashboard/artists/create" class="btn btn-primary my-btn-primary-color ml-auto my-shadow">Shto
            artist</a>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card my-shadow border-0">
                <table class="table my-table">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col">Emri</th>
                        <th scope="col">Zhanret</th>
                        <th scope="col">Nr. këngëve</th>
                        <th scope="col"/>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($artists as $key => $artist)
                        <tr>
                            <th class="text-center" scope="row">{{$key + 1}}</th>
                            <td>{{$artist->full_name}}</td>
                            <td>
                                @foreach($artist->genres as $genre)
                                    {{$genre->title}}@if(!$loop->last){{", "}}@endif
                                @endforeach
                            </td>
                            <td>{{$artist->songs_count}}</td>
                            <td>
                                <a class="btn btn-link btn-sm" style="color: #5e676f"
                                   href="/dashboard/artists/{{$artist->artist_id}}/edit">
                                    <i class="fas fa-pen px-1"></i>
                                </a>
                                <button class="btn btn-link btn-sm"
                                        style="color: #5e676f"
                                        type="button"
                                        onclick="alertAndSubmit(
                                                'Pas fshierjes së artistit {{$artist->full_name}}, ju nuk do të jeni në gjendje ta riktheni atë!',
                                                'Fshi artistin!',
                                                '#delete-artist-{{$artist->artist_id}}'
                                                )">
                                    <i class="fas fa-trash px-1"></i>
                                </button>
                                <form method="POST" id="delete-artist-{{$artist->artist_id}}" action="/dashboard/artists/{{$artist->artist_id}}">
                                    @csrf
                                    @method("DELETE")
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mx-auto">
                    {{$artists->links()}}
                </div>
                @if(count($artists) == 0)
                    <span class="text-center mb-3">Nuk ka përdorues</span>
                @endif
            </div>
        </div>
    </div>
@endsection
