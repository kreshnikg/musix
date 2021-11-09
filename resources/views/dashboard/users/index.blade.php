@extends('layouts.dashboard')

@section('content')

    <div class="d-flex align-items-center mb-4">
        <h4 class="mb-0">Përdoruesit</h4>
        <a href="/dashboard/users/create" class="btn btn-primary my-btn-primary-color ml-auto my-shadow">Shto
            përdorues</a>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card my-shadow border-0">
                <table class="table my-table">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col">Emri</th>
                        <th scope="col">Email</th>
                        <th scope="col">Roli</th>
                        <th scope="col"/>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $user)
                        <tr>
                            <th class="text-center" scope="row">{{$key + 1}}</th>
                            <td>{{$user->full_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if($user->role->title == "admin")
                                    @php($badge = "red")
                                @elseif($user->role->title == "manager")
                                    @php($badge = "blue")
                                @elseif($user->role->title == "customer")
                                    @php($badge = "indigo")
                                @endif
                                <span class="badge p-2 badge-{{$badge}}">{{$user->role->description}}</span>
                            </td>
                            <td>
                                <a class="btn btn-link btn-sm" style="color: #5e676f"
                                   href="/dashboard/users/{{$user->user_id}}/edit">
                                    <i class="fas fa-pen px-1"></i>
                                </a>
                                <button class="btn btn-link btn-sm"
                                        style="color: #5e676f"
                                        type="button"
                                        onclick="alertAndSubmit(
                                                'Pas fshierjes së përdoruesit {{$user->name}}, ju nuk do të jeni në gjendje ta riktheni atë!',
                                                'Fshi përdoruesin!',
                                                '#delete-user-{{$user->user_id}}'
                                                )">
                                    <i class="fas fa-trash px-1"></i>
                                </button>
                                <form method="POST" id="delete-user-{{$user->user_id}}" action="/dashboard/users/{{$user->user_id}}">
                                    @csrf
                                    @method("DELETE")
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mx-auto">
                    {{$users->links()}}
                </div>
                @if(count($users) == 0)
                    <span class="text-center mb-3">Nuk ka përdorues</span>
                @endif
            </div>
        </div>
    </div>
@endsection
