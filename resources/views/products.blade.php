@extends('layout')

@section('content')
    <div class="container mt-5 row">
        <div class="col-3">
            <ul class="list-group">
                @foreach($products as $product)
                    <li class="list-group-item">
                        {{$product['name']}} - ${{$product['price']}} |
                        <a href="{{route('products.scan', $product['code'])}}">Scan</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="col-3 mt-1">
            <strong>Total price: {{$total_price}}</strong>
        </div>
    </div>
@endsection
