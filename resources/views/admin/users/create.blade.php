@extends('layouts.admin')
@section('content')
    <div class="row pt-3">
        <div class="col-sm">
            <form action="{{  route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">名称</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="名称" autocomplete="name" autofocus="">
                    @error('name')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="メールアドレス" autocomplete="email">
                    @error('email')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="パスワード" autocomplete="new-password">
                    @error('password')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirm">パスワード(確認)</label>
                    <input type="password" class="form-control @error('password-confirm') is-invalid @enderror" id="password-confirm" name="password_confirmation" placeholder="パスワード(確認)" autocomplete="new-password">
                </div>
                <div class="form-group">
                    <label for="icon">イメージ</label>
                    <input type="file" class="form-control-file @error('icon') is-invalid @enderror" id="icon" name="icon">
                    @error('icon')
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <hr class="mb-3">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="{{  route('admin.users.index') }}" class="btn btn-secondary">キャンセル</a>
                    </li>
                    <li class="list-inline-item">
                        <button type="submit" class="btn btn-primary">作成</button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
@endsection
