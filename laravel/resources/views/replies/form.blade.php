@csrf
<div class="form-group mb-0">
  <label h4></label>
  <input type="hidden" name="article_id" value="{{ $article->id }}">
  <textarea name="body" rows="5" required class="form-control h-100" placeholder="コメント"></textarea>
</div>