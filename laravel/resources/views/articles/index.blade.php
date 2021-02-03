@extends('app')

@section('title', '記事一覧')

@section('content')
  @include('nav')
  <div class="container">
    @if( $articles->isEmpty() )
      <div class="card mt-3">
        <div class="card-body d-flex flex-row">
          <p>該当する投稿がみつかりませんでした。</p>
        </div>
      </div>    
　  @endif
    @foreach($articles as $article) 
      @include('articles.card')
    @endforeach
  </div>
@endsection