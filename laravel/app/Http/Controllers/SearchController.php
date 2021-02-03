<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyWord = $request->input('keyWord');

        $articles = optional(Article::where('title','like','%'.$keyWord.'%'))->get()->sortByDesc('created_at')
            ->load('user', 'tags', 'likes');

        return view('articles.index', ['articles' => $articles]);
    }

}
