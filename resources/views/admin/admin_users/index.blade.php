@extends('layouts.admin')
@section('content')
    <form class="shadow p-3 mt-3" action="#">
        <div class="row">
            <div class="col-md-6 mb-3">
                <input type="text" class="form-control" id="name" name="name" value="{{ request('name') }}"
                       placeholder="名称">
            </div>
            <div class="col-md mb-3">
                <input type="text" class="form-control" id="email" name="email" value="{{ request('email') }}"
                       placeholder="メールアドレス">
            </div>
        </div>
        <div class="row">
            <div class="form-check form-check-inline mb-3 ml-3 mr-0">
                <input class="form-check-input" type="radio" name="user_authority" id="all-authority" value=""
                       checked="">
                <label class="form-check-label" for="all-authority">すべての権限</label>
            </div>
            <div class="form-check form-check-inline mb-3 ml-3">
                <input class="form-check-input" type="radio" name="user_authority" id="owner-authority"
                       @if(request('user_authority') == 'owner') checked @endif value="owner">
                <label class="form-check-label" for="owner-authority">オーナー</label>
            </div>
            <div class="form-check form-check-inline mr-0 mb-3">
                <input class="form-check-input" type="radio" name="user_authority" id="general-authority"
                       @if(request('user_authority') == 'general') checked @endif value="general">
                <label class="form-check-label" for="general-authority">一般</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <select class="custom-select" name="sort_column">
                    <option value="id" @if(request('sort_column') == 'id') selected @endif>並び替え: ID</option>
                    <option value="name" @if(request('sort_column') == 'name') selected @endif>並び替え: 名称</option>
                    <option value="email" @if(request('sort_column') == 'email') selected @endif>並び替え: メールアドレス</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <select class="custom-select" name="sort_direction">
                    <option value="asc" @if(request('sort_direction') == 'asc') selected @endif>並び替え方向: 昇順</option>
                    <option value="desc" @if(request('sort_direction') == 'desc') selected @endif>並び替え方向: 降順</option>
                </select>
            </div>
            <div class="col-md-2 mb-3">
                <select class="custom-select" name="page_unit">
                    <option value="10" @if(request('page_unit') == 10) selected @endif>表示: 10件</option>
                    <option value="20" @if(request('page_unit') == 20) selected @endif>表示: 20件</option>
                    <option value="50" @if(request('spage_unit') == 50) selected @endif>表示: 50件</option>
                    <option value="100" @if(request('page_unit') == 100) selected @endif>表示: 100件</option>
                </select>
            </div>
            <div class="col-sm mb-3">
                <button type="submit" class="btn btn-block btn-primary">検索</button>
            </div>
        </div>
    </form>
    <ul class="list-inline pt-3">
        <li class="list-inline-item">
            <a href="{{ route('admin.admin_users.create') }}" class="btn btn-success">新規</a>
        </li>
    </ul>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>ID</th>
                <th>名称</th>
                <th>メールアドレス</th>
                <th>権限</th>
            </tr>
            </thead>
            <tbody>
            @foreach($search_results as $search_result)
                <tr>
                    <td>{{ $search_result->id }}</td>
                    <td>
                        <a href="{{ route('admin.admin_users.show', ['admin_user' =>$search_result->id]) }}">{{ $search_result->name }}</a>
                    </td>
                    <td>{{ $search_result->email }}</td>
                    @if($search_result->is_owner)
                        <td>オーナー</td>
                    @else
                        <td>一般</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $search_results->links() }}
    </div>
@endsection
