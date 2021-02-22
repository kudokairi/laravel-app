<div class="card mt-3">
  <div class="card-body pb-0">
    <div class="d-flex flex-row">
      <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
        @if( empty($user->file_path) )
        <i class="fas fa-user-circle fa-3x ml-3"></i>
        @else
        <div style="width: 4rem; float:left;">
          <profile-image
            :initial-file-path = '@json(Storage::url($user->file_path))'
          >
          </profile-image>
        </div>
        @endif
      </a>
      @if( Auth::id() !== $user->id )
        <follow-button
          class="ml-auto"
          :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
          :authorized='@json(Auth::check())'
          endpoint="{{ route('users.follow', ['name' => $user->name]) }}"
        >
        </follow-button>
      @endif
      @if( Auth::id() == $user->id )
        <my-modal
          endpoint="{{ route('users.upload_image') }}"
        >
        </my-modal>
      @endif
    </div>
    <h2 class="h5 card-title ml-4">
      <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
        {{ $user->name }}
      </a>
    </h2>
  </div>
  <div class="card-body">
    <div class="card-text">
      <a href="{{ route('users.followings', ['name' => $user->name]) }}" class="text-muted">
        {{ $user->count_followings }} フォロー
      </a>
      <a href="{{ route('users.followers', ['name' => $user->name]) }}" class="text-muted">
        {{ $user->count_followers }} フォロワー
      </a>
    </div>
  </div>
  <div class="card-body">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
  </div>
</div>