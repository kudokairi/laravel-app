<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">SNSHU</a>
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
      @auth
      <li>
        <a class="dropdown-item text-danger py-3 font-weight-bold" data-toggle="modal" data-target="#modal-withdrawal-{{ Auth::user()->id }}">
          退会する
        </a>
      </li>
            <!-- modal -->
      <div id="modal-withdrawal-{{ Auth::user()->id }}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('users.withdrawal') }}">
              @csrf
              @method('DELETE')
              <div class="modal-body">
                {{ Auth::user()->name }}の退会処理を実行します。よろしいですか？
              </div>
              <div class="modal-footer justify-content-between">
                <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                <button type="submit" class="btn btn-danger">退会する</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- modal -->
      @endauth
    </ul>
  </div>
</nav>
