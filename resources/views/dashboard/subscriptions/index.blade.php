@extends('layouts.dashboard')

@section('content')

    <div class="d-flex align-items-center mb-4">
        <h4 class="mb-0">Abonimet</h4>
{{--        <a href="/dashboard/genres/create" class="btn btn-primary my-btn-primary-color ml-auto my-shadow">Shto--}}
{{--            zhanër</a>--}}
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card my-shadow border-0">
                <table class="table my-table">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col">Konsumatori</th>
                        <th scope="col">Skadon më</th>
                        <th scope="col">Abonuar më</th>
                        <th scope="col">Aktiv</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subscriptions as $key => $subscription)
                        <tr>
                            <th class="text-center" scope="row">{{$key + 1}}</th>
                            <td>{{$subscription->user->full_name}}</td>
                            <td>{{$subscription->ends_at}}</td>
                            <td>{{$subscription->created_at}}</td>
                            <td>
                                @if($subscription->ends_at > \Carbon\Carbon::now())
                                    <i class="fas fa-check text-success"/>
                                @else
                                    <i class="fas fa-times text-danger"/>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mx-auto">
                    {{$subscriptions->links()}}
                </div>
                @if(count($subscriptions) == 0)
                    <span class="text-center mb-3">Nuk ka abonime</span>
                @endif
            </div>
        </div>
    </div>
@endsection
