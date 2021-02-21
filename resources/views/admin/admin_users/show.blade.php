@extends('layouts.admin')
@section('content')
    <ul class="list-inline pt-3">
        @can('viewAny', App\Models\AdminUser::class)
            <li class="list-inline-item">
                <a href="{{ route('admin.admin_users.index') }}" class="btn btn-light">一覧</a>
            </li>
        @endcan
        <li class="list-inline-item">
            <a href="{{  route('admin.admin_users.edit', ['admin_user' => $adminUser->id]) }}"
               class="btn btn-success">編集</a>
        </li>
        @can('delete', $adminUser)
            <li class="list-inline-item">
                <form action="{{ route('admin.admin_users.destroy', ['admin_user' => $adminUser->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">削除</button>
                </form>
            </li>
        @endcan
    </ul>
    <table class="table">
        <tbody>
        <tr>
            <th>ID</th>
            <td>{{  $adminUser->id }}</td>
        </tr>
        <tr>
            <th>名称</th>
            <td>{{  $adminUser->name }}</td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td>{{  $adminUser->email }}</td>
        </tr>
        <tr>
            <th>権限</th>
            @if($adminUser->is_owner)
                <td>オーナー</td>
            @else
                <td>一般</td>
            @endif
        </tr>
        </tbody>
    </table>
@endsection
