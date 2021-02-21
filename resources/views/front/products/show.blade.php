@extends('layouts.app')
@section('css')
    <link href="{{ asset('css/review.css') }}" rel="stylesheet">
@endsection
@section('js')
    <script src="{{ asset('js/wish.js') }}" defer></script>
@endsection
@section('content')
    <div class="row">
        @if($product->icon)
            <div class="col-md-5">
                <img alt="アイコン" class="img-thumbnail" src="{{ asset('storage/'.$product->icon ) }}">
            </div>
        @endif
        <div class="col-md-7">
            <div class="row">
                <h2 class="col-md">{{ $product->name  }}</h2>
            </div>
            <hr>
            <div class="row">
                <div class="col-md">
                    <span class="mr-3">価格:</span>
                    <soan class="h5 text-danger">¥{{ number_format($product->price) }}</soan>
                </div>
            </div>
            <div class="row pt-2">
                <div class="col-md">
                    {{ $product->description  }}
                </div>
            </div>
            <hr>
            @if(auth()->user())
                <div class="row">
                    <div class="col-md">
                        @if(isset($wish_product))
                            <a class="toggle_wish" product_id="{{ $product->id }}" wish_product="1">
                                <i class="fas fa-heart"></i>
                            </a>
                        @else
                            <a class="toggle_wish" product_id="{{ $product->id }}" wish_product="0">
                                <i class="far fa-heart"></i>
                            </a>
                        @endif
                    </div>
                </div>
            @endif
            <div class="content">
                <form action="{{ route('front.charge',['product' => $product->id] ) }}" method="POST">
                    {{ csrf_field() }}
                    <script
                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                        data-key="{{ env('STRIPE_KEY') }}"
                        data-amount="{{ $product->price }}"
                        data-name="Stripe決済"
                        data-label="この商品を購入する"
                        data-description="Online course about integrating Stripe"
                        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                        data-locale="auto"
                        data-currency="JPY"
                        defer>
                    </script>
                </form>
            </div>
        </div>
    </div>
    @if(auth()->user())
        <div class="row mt-3">
            <div class="col-md">
                <a class="btn btn-primary"
                   href="{{ route('front.product_reviews.create', ['product' => $product->id ])  }}">レビューを書く</a>
            </div>
        </div>
    @endif
    <div class="row mt-3">
        <div class="col-md">
            <ul class="list-unstyled">
                @if(auth()->user())
                    @foreach($my_reviews as $my_review)
                        <li class="media bg-white p-2 mb-3">
                            <img src="{{ asset('storage/'.$my_review->user->icon ) }}" width="30" height="30"
                                 class="mr-3" alt="アイコン">
                            <div class="media-body">
                                <h6>{{ $my_review->user->name }}</h6>
                                <h5>
                                    <a href="{{ route('front.product_reviews.edit', ['product' => $product->id,'product_review' => $my_review->id ]) }}">{{ $my_review->title }}</a>
                                </h5>
                                <div class="review_star">
                                    @for($i=1 ; $i <= 5; $i ++)
                                        @if($i <= $my_review->rank)
                                            <i class="fa-star fas"></i>
                                        @else
                                            <i class="fa-star far"></i>
                                        @endif
                                    @endfor
                                </div>
                                {{ $my_review->body }}
                            </div>
                        </li>

                    @endforeach
                @endif

                @foreach($other_reviews as $other_review)
                    <li class="media bg-white p-2 mb-3">
                        <img src="{{ asset('storage/'.$other_review->user->icon ) }}" width="30" height="30"
                             class="mr-3"
                             alt="...">
                        <div class="media-body">
                            <h6>{{ $other_review->user->name }}</h6>
                            <h5>{{ $other_review->title }}</h5>
                            <div class="review_star">
                                @for($i=1 ; $i <= 5; $i ++)
                                    @if($i <= $other_review->rank)
                                        <i class="fa-star fas"></i>
                                    @else
                                        <i class="fa-star far"></i>
                                    @endif
                                @endfor
                            </div>
                            {{ $other_review->body }}
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
