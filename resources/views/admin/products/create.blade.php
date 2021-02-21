@extends('layouts.admin')
@section('content')
    <div class="row pt-3">
        <div class="col-sm">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="product_category_id">商品カテゴリ</label>
                    <select class="custom-select " id="product_category_id" name="product_category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">名称</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                           value="{{ old('name') }}" placeholder="名称" autofocus="">
                    @error('name')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">価格</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                           name="price" value="{{ old('price') }}" placeholder="価格">
                    @error('price')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">説明</label>
                    <textarea class="form-control" id="description" name="description" placeholder="説明"></textarea>
                </div>
                <div class="form-group">
                    <label for="image_path">イメージ</label>
                    <input type="file" class="form-control-file" accept="image/*" id="icon" name="icon">
                </div>
                <hr class="mb-3">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">キャンセル</a>
                    </li>
                    <li class="list-inline-item">
                        <button type="submit" class="btn btn-primary">作成</button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
@endsection
