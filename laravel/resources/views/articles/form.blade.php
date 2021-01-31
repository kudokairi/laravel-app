@csrf
<div class="md-form" style="height:7%">
  <label>タイトル</label>
  <input type="text" name="title" class="form-control" required value="{{ $article->title ?? old('title') }}">
</div>
<div class="form-group" style="height:10%">
  <article-tags-input
  :initial-tags='@json($tagNames ?? [])'
  :autocomplete-items='@json($allTagNames ?? [])'
  >
  </article-tags-input>
</div>
<div class="mb-5 d-block d-sm-none"></div>
<div class="form-group mb-0" style="height:40%">
  <label></label>
  <textarea name="body" required class="form-control h-100" placeholder="本文">{{ $article->body ?? old('body') }}</textarea>
</div>