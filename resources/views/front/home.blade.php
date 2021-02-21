@extends('layouts.app')
@section('js')
    <script src="{{ asset('js/wish.js') }}" defer></script>
@endsection
@section('css')
    <link href="{{ asset('css/review.css') }}" rel="stylesheet">
@endsection
@section('content')
    @if(auth()->user())
        <div class="row">
            <div class="col-md">
                <h3 class="border-bottom mb-3">ほしいものリスト</h3>
            </div>
        </div>
        <div class="row">
            @foreach( $wish_products as  $wish_product)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <a href="{{ url('/products/'.$wish_product->product->id ) }}" target="_blank">
                            <img class="card-img-top bd-placeholder-img" src="{{ asset('storage/'.$wish_product->product->icon ) }}">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{$wish_product->product->name }}</h5>
                            <p class="card-text">{{ $wish_product->product->description }}</p>
                            <a class="toggle_wish" product_id="{{ $wish_product->product->id }}" wish_product="1">
                                <i class="fas fa-heart"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
