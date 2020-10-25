@extends('layouts.dashboard')
@section('content')
    <div class="card shadow-sm border-0">
        <h5 class="card-header bg-white">
            Krijo zhanër
        </h5>
        <div class="card-body">
            <div class="w-25">
                <form method="POST" action="/dashboard/genres">
                    @csrf
                    <div class="form-group">
                        <label for="title">Emërtimi</label>
                        <input class="form-control @error('title') is-invalid @enderror"
                               type="text"
                               name="title"
                               id="title"
                               value="{{ old('title') }}"
                               required/>
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Krijo zhanrin</button>
                </form>
            </div>
        </div>
    </div>
@endsection
