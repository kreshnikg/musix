@extends('layouts.dashboard')
@section('content')
    <div class="card shadow-sm border-0">
        <h5 class="card-header bg-white">
            Ndrysho të dhënat e përdoruesit
        </h5>
        <div class="card-body">
            <div class="w-25">
                <form method="POST" action="/dashboard/users/{{$user->user_id}}">
                    @csrf
                    @method("PATCH")
                    <div class="form-group">
                        <label for="full_name">Emri</label>
                        <input class="form-control @error('full_name') is-invalid @enderror"
                               type="text"
                               name="full_name"
                               id="full_name"
                               value="{{$user->full_name}}"
                               required/>
                        @error('full_name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control @error('email') is-invalid @enderror"
                               type="text"
                               name="email"
                               id="email"
                               value="{{$user->email}}"
                               required/>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Ndrysho fjalkalimin (opsional)</label>
                        <input class="form-control @error('password') is-invalid @enderror"
                               type="password"
                               name="password"
                               placeholder="••••••••"
                               id="password"/>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">Roli</label>
                        <select class="form-control @error('role') is-invalid @enderror" name="role" id="role" required>
                            <option value="" disabled selected>Zgjedh një opsion</option>
                            @foreach($roles as $role)
                                <option {{$user->role_id == $role->role_id ? "selected" : ""}} value={{$role->role_id}}>{{$role->description}}</option>
                            @endforeach
                        </select>
                        @error('role')
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
