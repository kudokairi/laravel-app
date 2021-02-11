<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Article;

class TagController extends Controller
{
    public function show(string $name)
    {
        $tag = Tag::where('name', $name)->first();
        $tag->articles = Article::whereHas('user',function($query) {
            $query->where('deleted_at',NULL);
        })->get();

        return view('tags.show', ['tag' => $tag]);
    }
}
