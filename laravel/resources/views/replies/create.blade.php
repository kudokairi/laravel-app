@extends('app')

@section('title', '記事詳細')

@section('content')
  @include('nav')
  <div class="container">
    @include('articles.card')
    <div class="card mt-3 h-100">
        <div class="card-body pt-0 h-100">
            @include('error_card_list')
            <div class="card-text h-100">
            <form method="POST" class="h-100" action="{{ route('replies.store') }}">
                @include('replies.form')
                <button type="submit" class="mt-4 btn blue-gradient btn-block">コメントする</button>
            </form>
            </div>
        </div>
        </div>
  </div>
@endsection