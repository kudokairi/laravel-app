<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Reply;

class ReplyController extends Controller
{
    public function create(Article $article)
    {
        return view('replies.create', ['article' => $article]);
    }

    public function store(Request $request, Reply $reply)
    {
        $reply->fill(['body' => $request->body]);
        $reply->reply_user_id = $request->user()->id;
        $reply->article_id = $request->article_id;
        $reply->save();

        $articles = Article::whereHas('user',function($query) {
            $query->where('deleted_at',NULL);
        })->where('id', $request->article_id)->first();
        
        return view('articles.show', ['article' => $articles]);
    }

}
