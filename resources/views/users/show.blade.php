@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card border-0 bg-light shadow-sm">
                    <img src="{{$user->avatar}}" alt="{{ $user->name }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <date-btn
                            class="btn btn-primary btn-block"
                            :recipient="{{ $user }}">
                        </date-btn>
                    </div>
                </div>
            </div>

                <status-list
                    url="{{route('users.statuses.index', $user)}}"
                ></status-list>
            </div>
        </div>
    </div>
@endsection
