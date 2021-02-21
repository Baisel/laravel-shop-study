@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.admin_users.update', ['admin_user' => $adminUser->id])  }}" class="pt-3"
          method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">名称</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                   value="{{ $adminUser->name  }}" placeholder="名称" autocomplete="name" autofocus="">
            @error('name')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                   value="{{ $adminUser->email  }}" placeholder="メールアドレス" autocomplete="email">
            @error('email')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                   name="password" placeholder="パスワード" autocomplete="new-password">
            @error('password')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="password-confirm">パスワード(確認)</label>
            <input type="password" class="form-control" id="password-confirm" name="password_confirmation"
                   placeholder="パスワード(確認)" autocomplete="new-password">
        </div>
        <div class="form-group">
            @can('change',$adminUser)
                <label>権限</label>
                @if($adminUser->is_owner)
                    <p>オーナー</p>
                @else
                    <p>一般</p>
                @endif
            @elsecan('viewAny', App\Models\AdminUser::class)
                <div class="form-check form-check-inline mr-0">
                    <input class="form-check-input" type="radio" name="is_owner" id="general-authority" checked
                           value="0">
                    <label class="form-check-label" for="general-authority">一般</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_owner" id="owner-authority"
                           value="1">
                    <label class="form-check-label" for="owner-authority">オーナー</label>
                </div>
            @endcan
        </div>
        <hr class="mb-3">
        <ul class="list-inline">
            <li class="list-inline-item">
                <a href="{{  route('admin.admin_users.show', ['admin_user' => $adminUser->id]) }}"
                   class="btn btn-secondary">キャンセル</a>
            </li>
            <li class="list-inline-item">
                <button type="submit" class="btn btn-primary">更新</button>
            </li>
        </ul>
    </form>
@endsection
