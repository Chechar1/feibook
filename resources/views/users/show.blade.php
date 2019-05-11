@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card border-0 bg-light shadow-sm">
                    <img src="{{$user->avatar}}" alt="{{ $user->name }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card border-0 bg-light shadow-sm">
                    <div class="card-body">
                        @forelse($user->statuses as $status)
                            {{$status->body}}
                        @empty
                            <div class="text-center">
                                <div class="text-secondary">{{ $user->name }} no ha publicado nada todavía</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
