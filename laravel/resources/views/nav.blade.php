<nav class="navbar navbar-expand navbar-dark blue-gradient">

  <a class="navbar-brand" href="/"><i class="far fa-sticky-note mr-1"></i>SNSHU</a>

  <ul class="navbar-nav ml-auto d-flex align-items-center justify-content-center">

    @guest
    <li class="nav-item">
      <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
    </li>
    @endguest

    @guest
    <li class="nav-item">
      <a class="nav-link" href="{{ route('login') }}">ログイン</a>
    </li>
    @endguest
    <li class="nav-item">
      <form method="GET" class="form-inline mb-0" action="{{ route('search') }}">
        <div class="form-group mb-0">
        <input type="search" class="form-control" aria-label="Search" name="keyWord" placeholder="キーワード検索">
        </div>
        <input type="submit" value="検索" class="d-none d-md-inline btn btn-info">
      </form>
    </li>
    @auth
    <li class="nav-item">
      <a class="nav-link" href="{{ route('articles.create') }}"><i class="fas fa-pen mr-1"></i><div class="d-none d-md-inline">投稿する</div></a>
    </li>
    @endauth

    @auth
    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
         aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
        <button class="dropdown-item" type="button"
                onclick="location.href='{{ route("users.show" , ["name" => Auth::user()->name]) }}'">
          マイページ
        </button>
        <div class="dropdown-divider"></div>
        <button form="logout-button" class="dropdown-item" type="submit">
          ログアウト
        </button>
      </div>
    </li>
    <form id="logout-button" method="POST" action="{{ route('logout') }}">
      @csrf
    </form>
    <!-- Dropdown -->
    @endauth

  </ul>
</nav>
