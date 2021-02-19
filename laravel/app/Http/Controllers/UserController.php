<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show(string $name) 
    {
        $user = User::where('name' , $name)->first()
            ->load('articles.user', 'articles.likes', 'articles.tags');
        
        $articles = $user->articles->sortByDesc('created_at');

        return view('users.show' , [
            'user' => $user, 
            'articles' => $articles,
        ]);
    }

    public function uplopad(Request $request){
		$upload_image = $request->file;

		if($upload_image) {
			$path = $upload_image->store('uploads',"public");
			if($path){
                $user = User::where('id', Auth::id())->first();
				$user->file_path = $path;
                $user->save();
                $articles = $user->articles->sortByDesc('created_at');
			}
		}
        return Storage::url($user->file_path);
    }

    public function followings(string $name)
    {
        $user = User::where('name', $name)->first()
            ->load('followings.followers');

        $followings = $user->followings->sortByDesc('created_at');

        return view('users.followings', [
            'user' => $user,
            'followings' => $followings,
        ]);
    }

    public function followers(string $name)
    {
        $user = User::where('name', $name)->first()
            ->load('followers.followers');

        $followers = $user->followers->sortByDesc('created_at');

        return view('users.followers', [
            'user' => $user,
            'followers' => $followers,
        ]);
    }

    public function likes(String $name)
    {
        $user = User::where('name', $name)->first()
            ->load(['likes.user', 'likes.likes', 'likes.tags']);

        $withdrawalUser = User::onlyTrashed()->get('id')->pluck('id');

        $articles = $user->likes->whereNotIn('user_id', $withdrawalUser)->sortByDesc('created_at');

        return view('users.likes', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }

    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);

        return ['name' => $name];
    }

    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);

        return ['name' => $name];
    }

    public function withdrawalUser()
    {
        $user = Auth::user();

        Auth::logout();

        $user->delete();

        return redirect("/");
    }
}
