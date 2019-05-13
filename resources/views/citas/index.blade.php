@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($citaRequests as $citaRequest)
            <accept-cita-btn
                dusk="accept-cita"
                :sender="{{ $citaRequest->sender }}"
                cita-status="{{ $citaRequest->status }}"
            ></accept-cita-btn>
        @endforeach
    </div>
@endsection
