@extends('layouts.dashboard')
@section('content')
    <div class="card shadow-sm border-0">
        <h5 class="card-header bg-white">
            Krijo përdorues
        </h5>
        <div class="card-body">
            <div class="w-25">
                <form method="POST" action="/dashboard/users">
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
                        <label for="email">Email</label>
                        <input class="form-control @error('email') is-invalid @enderror"
                               type="text"
                               name="email"
                               id="email"
                               value="{{ old('email') }}"
                               required/>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Fjalkalimi</label>
                        <input class="form-control @error('password') is-invalid @enderror"
                               type="password"
                               name="password"
                               id="password"
                               value="{{ old('password') }}"
                               required/>
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
                                <option value={{$role->role_id}}>{{$role->description}}</option>
                            @endforeach
                        </select>
                        @error('role')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Krijo përdoruesin</button>
                </form>
            </div>
        </div>
    </div>
@endsection
