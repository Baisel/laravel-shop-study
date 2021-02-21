<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
@yield('jp')

<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <a class="navbar-brand" href="{{  route('admin.home') }}">{{ config('app.name', 'Laravel') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    {{ auth('admin')->user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"
                       href="{{  route('admin.admin_users.show',['admin_user'=> auth('admin')->user()->id ]) }}">管理者情報</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a>
                    <form id="logout-form" class="d-none" action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ strpos(Request::url(), url('admin/products')) !== false ? 'active' : null }}"
                           href="{{ route('admin.products.index') }}">
                            商品管理
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ strpos(Request::url(), url('admin/product_categories')) !== false ? 'active' : null }}"
                           href="{{ route('admin.product_categories.index') }}">
                            商品カテゴリ管理
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ strpos(Request::url(), url('admin/users')) !== false ? 'active' : null }}"
                           href="{{ route('admin.users.index')}}">
                            顧客管理
                        </a>
                    </li>
                    @if(auth('admin')->user()->is_owner)
                        <li class="nav-item">
                            <a class="nav-link {{ strpos(Request::url(), url('admin/admin_user')) !== false ? 'active' : null }}"
                               href="{{ route('admin.admin_users.index')}}">
                                顧客管理
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
