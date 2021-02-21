@extends('layouts.app')
@section('content')
    <div class="row pt-3">
        <div class="col-sm">
            <form
                action="{{ route('front.product_reviews.update',['product' => $product_review->product_id,'product_review' => $product_review->id ])  }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                           value="{{ $product_review->title  }}" placeholder="タイトル" autofocus="">
                    @error('title')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="body">本文</label>
                    <input type="text" class="form-control @error('body') is-invalid @enderror" id="body" name="body"
                           value="{{ $product_review->body }}" placeholder="本文">
                    @error('body')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" id="rank1" name="rank" value="1"
                           @if($product_review->rank == 1) checked @endif>
                    <label class="form-check-label" for="rank1">星1つ</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" id="rank2" name="rank" value="2"
                           @if($product_review->rank == 2) checked @endif>
                    <label class="form-check-label" for="rank2">星2つ</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" id="rank3" name="rank" value="3"
                           @if($product_review->rank == 3) checked @endif>
                    <label class="form-check-label" for="rank3">星3つ</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" id="rank4" name="rank" value="4"
                           @if($product_review->rank == 4) checked @endif>
                    <label class="form-check-label" for="rank4">星4つ</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" id="rank5" name="rank" value="5"
                           @if($product_review->rank == 5) checked @endif>
                    <label class="form-check-label" for="rank5">星5つ</label>
                </div>

                <hr class="mb-3">

                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="{{ route('front.products.show',['product' => $product_review->product_id]) }}"
                           class="btn btn-secondary">商品へ戻る</a>
                    </li>
                    <li class="list-inline-item">
                        <button type="submit" class="btn btn-primary">レビュー</button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
@endsection
