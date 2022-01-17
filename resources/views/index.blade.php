@extends('layout')

@section('content')
    <div class="container pt-5">
        <div class="p-3">
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form action="{{route('users.search')}}" method="post" class="row justify-content-center g-2">
                @csrf
                <div class="col-auto">
                    <input type="number" class="form-control" name="user_id" placeholder="User ID"
                           value="{{old('user_id')}}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>
@endsection
