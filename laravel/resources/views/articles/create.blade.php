@extends('app')

@section('title', '記事投稿')

@include('nav')

@section('content')
  <div class="container">
    <div class="row h-75">
      <div class="col-12">
        <div class="card mt-3 h-100">
          <div class="card-body pt-0 h-100">
            @include('error_card_list')
            <div class="card-text h-100">
              <form method="POST" class="h-100" action="{{ route('articles.store') }}">
                @include('articles.form')
                <button type="submit" class="mt-4 btn blue-gradient btn-block">投稿する</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection