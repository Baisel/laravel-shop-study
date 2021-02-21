@extends('layouts.admin')
@section('content')
    <form class="mt-3" action="{{  route('admin.product_categories.update',['product_category'=>$product_category->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">名称</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $product_category->name }}" placeholder="名称" autocomplete="name" autofocus="">
            @error('name')
            <p class="invalid-feedback">  {{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="order-no">並び順番号</label>
            <input type="number" class="form-control @error('order_no') is-invalid @enderror" id="order-no" name="order_no" value="{{ $product_category->order_no }}" placeholder="並び順番号">
            @error('order_no')
            <p class="invalid-feedback">  {{ $message }}</p>
            @enderror
        </div>
        <hr class="mb-3">
        <ul class="list-inline">
            <li class="list-inline-item">
                <a href="{{  route('admin.product_categories.show',['product_category' => $product_category->id]) }}" class="btn btn-secondary">キャンセル</a>
            </li>
            <li class="list-inline-item">
                <button type="submit" class="btn btn-primary">更新</button>
            </li>
        </ul>
    </form>
@endsection
