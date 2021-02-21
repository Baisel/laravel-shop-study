@extends('layouts.admin')
@section('content')
    <div class="row pt-3">
        <div class="col-sm">
            <form action="{{ route('admin.products.update', ['product'=> $product->id]) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="category_id">商品カテゴリ</label>
                    <select class="custom-select" id="product_category_id" name="product_category_id">
                        @foreach( $categories as $category)
                            <option value="{{ $category->id }}"
                                    @if($product->product_category_id == $category->id) selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">名称</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                           value="{{ $product->name }}" placeholder="名称" autofocus="">
                    @error('name')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">価格</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                           name="price" value="{{ $product->price }}"  placeholder="価格">
                    @error('price')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">説明</label>
                    <textarea class="form-control" id="description" name="description"
                              placeholder="説明">{{ $product->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="icon">イメージ</label>
                    <input type="file" class="form-control-file" accept="image/*" id="icon" name="icon">
                </div>
                @if(isset($product->icon))
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="delete_icon" name="delete_icon" value="1">
                        <label for="delete_image">削除</label>
                    </div>
                    <div>
                        <img class="img-thumbnail" src="{{ asset('storage/'.$product->icon) }}">
                    </div>
                @endif
                <hr class="mb-3">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="{{ route('admin.products.show', ['product'=> $product->id]) }}"
                           class="btn btn-secondary">キャンセル</a>
                    </li>
                    <li class="list-inline-item">
                        <button type="submit" class="btn btn-primary">更新</button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
@endsection
