<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        //get posts
        $posts = Post::query()
            ->where("active", "=", 1)
            ->where("published_at", "<=", Carbon::now())
            ->orderBy("published_at", "desc")
            ->paginate(5);
//        return view
        return view("home", compact('posts'));
    }

    public function show(Post $post) : View
    {
        if(!$post->active || $post->published_at > Carbon::now()) {
            abort(404);
        }

        //prev
        $prev = Post::query()->where("active", "=", 1)
            ->whereDate("published_at", "<=", Carbon::now())
            ->whereDate("published_at", ">", $post->published_at)
            ->orderBy("published_at")
            ->limit(1)
            ->first();

        //prev
        $next = Post::query()->where("active", "=", 1)
            ->whereDate("published_at", "<=", Carbon::now())
            ->whereDate("published_at", "<", $post->published_at)
            ->orderBy("published_at", "desc")
            ->limit(1)
            ->first();
        return view("posts.show", compact("post", "next", "prev"));
    }

    /**
     * search by category
     */
    public function byCategory(Category $category) : View
    {
        //get post by category
        $posts = Post::query()
            ->join("category_post", "posts.id", "=", "category_post.post_id")
            ->where("category_post.category_id", "=", $category->id)
            ->where("active", "=", 1)
            ->where("published_at", "<=", Carbon::now())
            ->orderByDesc("published_at")
            ->paginate(10);
        return view("home", compact("posts", "category"));
    }
}
