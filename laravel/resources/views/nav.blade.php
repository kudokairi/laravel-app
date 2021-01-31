<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/"><i class="far fa-sticky-note mr-1"></i>SNSHU</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>   
  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item list-unstyled">
        <form method="GET" class="form-inline mb-0" action="{{ route('search') }}">
          <div class="form-group mb-0">
            <input type="search" class="form-control" aria-label="Search" name="keyWord" placeholder="キーワード検索">
          </div>
          <input type="submit" value="検索" class="d-none d-md-inline btn btn-info">
        </form>
      </li>
      @guest
      <li class="nav-item active">
        <a class="dropdown-item py-3" href="{{ route('register') }}">ユーザー登録</a>
      </li>
      <li class="nav-item">
        <a class="dropdown-item py-3" href="{{ route('login') }}">ログイン</a>
      </li>
      @endguest
      @auth
      <li class="nav-item">
        <a class="dropdown-item py-3" href="{{ route('articles.create') }}"><i class="fas fa-pen mr-1"></i>投稿する</a>
      </li>
      <li>
        <a class="dropdown-item py-3" href='{{ route("users.show" , ["name" => Auth::user()->name]) }}'>マイページ</a>
      </li>
      <li>
        <button form="logout-button" class="dropdown-item py-3" type="submit">
          ログアウト
        </button>
      </li>
      @endauth
      <form id="logout-button" method="POST" action="{{ route('logout') }}">
      @csrf
      </form>
    </ul>
  </div>
</nav>
