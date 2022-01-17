@extends('layout')

@section('content')
    <div class="container pt-5">
        <div class="p-3">
            <h3 class="page-title">User found: {{ $user->name }}</h3>
            <b>Email</b>: {{ $user->email }}
            <br>
            <b>Registered on</b>: {{ $user->created_at }}
            <div>
                <a href="{{route('users.index')}}" class="btn btn-primary mt-2">Back to Index</a>
            </div>
        </div>
    </div>
@endsection
