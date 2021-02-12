@extends('app')

@section('title', '記事詳細')

@section('content')
  @include('nav')
  <div class="container">
    @include('articles.card')
    @foreach($article->replies as $articles)
      <div class="card mt-3">
        <div class="card-body d-flex flex-row">
          <a href="{{ route('users.show' , ['name' => $articles->user->name]) }}" class="text-dark">
            <i class="fas fa-user-circle fa-3x mr-1"></i>
          </a>
          <div>
            <div class="font-weight-bold">
              <a href="{{ route('users.show', ['name' => $articles->user->name]) }}" class="text-dark">  
                {{ $articles->user->name }}
              </a>
            </div>      
            <div class="font-weight-lighter">{{ $articles->created_at->format('Y/m/d H:i') }}</div>
          </div>
        </div>
        <div class="card-body pt-0">
          {{ $articles->body }}
        </div>
      </div>
    @endforeach
  </div>
@endsection