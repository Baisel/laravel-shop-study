@extends('layouts.admin')

@section('content')
    <ul class="list-inline pt-3">
        <li class="list-inline-item">
            <a href="{{ route('admin.products.index') }}" class="btn btn-light">一覧</a>
        </li>
        <li class="list-inline-item">
            <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}" class="btn btn-success">編集</a>
        </li>
        <li class="list-inline-item">
            <form action="{{ route('admin.products.destroy', ['product' => $product->id ]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">削除</button>
            </form>
        </li>
    </ul>
    <table class="table">
        <tbody>
        <tr>
            <th>ID</th>
            <td>{{ $product->id }}</td>
        </tr>
        <tr>
            <th>商品カテゴリ</th>
            <td>{{ $product->product_category->name }}</td>
        </tr>
        <tr>
            <th>名称</th>
            <td>{{ $product->name }}</td>
        </tr>
        <tr>
            <th>価格</th>
            <td>{{ $product->price }}</td>
        </tr>
        <tr>
            <th>説明</th>
            <td>{{ $product->description }}</td>
        </tr>
        <tr>
            <th>イメージ</th>
            <td>
                @if($product->icon)
                    <img class="img-thumbnail" src="{{ asset('storage/'.$product->icon ) }}">
                @endif
            </td>
        </tr>
        </tbody>
    </table>
@endsection
