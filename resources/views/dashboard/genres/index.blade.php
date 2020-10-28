@extends('layouts.dashboard')

@section('content')

    <div class="d-flex align-items-center mb-4">
        <h4 class="mb-0">Zhanret</h4>
        <a href="/dashboard/genres/create" class="btn btn-primary my-btn-primary-color ml-auto my-shadow">Shto
            zhanër</a>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card my-shadow border-0">
                <table class="table my-table">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col">Emërtimi</th>
                        <th scope="col">Krijuar më</th>
                        <th scope="col"/>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($genres as $key => $genre)
                        <tr>
                            <th class="text-center" scope="row">{{$key + 1}}</th>
                            <td>{{$genre->title}}</td>
                            <td>{{$genre->created_at}}</td>
                            <td>
                                <a class="btn btn-link btn-sm" style="color: #5e676f"
                                   href="/dashboard/genres/{{$genre->genre_id}}/edit">
                                    <i class="fas fa-pen px-1"></i>
                                </a>
                                <button class="btn btn-link btn-sm"
                                        style="color: #5e676f"
                                        type="button"
                                        onclick="alertAndSubmit(
                                                'Pas fshierjes së zhanrit {{$genre->title}}, ju nuk do të jeni në gjendje ta riktheni atë!',
                                                'Fshi zhanrin!',
                                                '#delete-genre-{{$genre->genre_id}}'
                                                )">
                                    <i class="fas fa-trash px-1"></i>
                                </button>
                                <form method="POST" id="delete-genre-{{$genre->genre_id}}" action="/dashboard/genres/{{$genre->genre_id}}">
                                    @csrf
                                    @method("DELETE")
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mx-auto">
                    {{$genres->links()}}
                </div>
                @if(count($genres) == 0)
                    <span class="text-center mb-3">Nuk ka zhanre</span>
                @endif
            </div>
        </div>
    </div>
@endsection
