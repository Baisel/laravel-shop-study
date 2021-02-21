@extends('layouts.app')
@section('js')
    <script src="{{ asset('js/wish.js') }}" defer></script>
@endsection
@section('css')
    <link href="{{ asset('css/review.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="col-md border shadow-sm py-2 d-flex">
        @if($products->total() == 0 && request('keyword'))
            <div><span class="font-weight-bold">{{ request('keyword') }}</span>は検索結果にありませんでした  </div>
        @else
            <div>検索結果 {{ $products->total() }}のうち {{ $products->firstItem()."-" }}{{ $products->lastItem() }}件
                <span id="search_genre" class="font-weight-bold">@if(isset($selected_category)){{$selected_category->name}}@endif</span>
                <span class="font-weight-bold text-danger">@if(request('keyword')) :{{ request('keyword') }} @endif </span>
            </div>
        @endif
        <form class="ml-auto" action="{{ route('front.products.index') }}">
            <input type="hidden" name="category_id"  value ="{{ request('category_id') }}" >
            <input type="hidden" name="keyword" value ="{{ request('keyword') }}">
            <select class="custom-select" name="sort" onchange="event.preventDefault();$(this).parent('form').submit();">
                <option value="review_rank-desc" @if( request('sort') == "review_rank-desc") selected @endif>並び替え: レビューの評価順</option>
                <option value="price-asc" @if( request('sort') == "price-asc") selected @endif>並び替え: 価格の安い順</option>
                <option value="price-desc" @if( request('sort') == "price-desc") selected  @endif>並び替え: 価格の高い順</option>
                <option value="updated_at-desc" @if( request('sort') == "updated_at-desc") selected  @endif>並び替え: 最新商品</option>
            </select>
        </form>
    </div>
    <div class="row pt-2">
        @foreach($products as $product)
        <div class="col-md-4">
            <div class="card mb-4">
                <a href="{{ route('front.products.show',['product' => $product->id])  }}" target="_blank">
                    <img class="card-img-top bd-placeholder-img" src="{{ asset('storage/'.$product->icon ) }}">
                </a>
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name  }}</h5>
                    <p class="card-text">¥{{ number_format($product->price)  }}</p>
                    @if(auth()->user())
                        @if(isset($product->like_products[0]))
                            <a class="toggle_wish" product_id="{{ $product->id }}" like_product="1">
                                <i class="fas fa-heart"></i>
                            </a>
                        @else
                            <a class="toggle_wish" product_id="{{ $product->id }}" like_product="0">
                                <i class="far fa-heart"></i>
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-md-12">
            {{ $products->links() }}
        </div>
    </div>
@endsection
