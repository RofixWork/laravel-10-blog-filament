<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostView;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        //get posts
//        $posts = Post::query()
//            ->where("active", "=", 1)
//            ->where("published_at", "<=", Carbon::now())
//            ->orderBy("published_at", "desc")
//            ->paginate(5);

        //latest post
        $latestPost = Post::query()->where("active", 1)
            ->whereDate("published_at", "<=", Carbon::now())
            ->orderByDesc("published_at")
            ->limit(1)
            ->first();

        //popular posts
        $popularPosts = Post::query()
            ->select("posts.*", DB::raw("COUNT(*) as 'up_votes_count'"))
            ->join("upvote_down_votes as udv", "posts.id", '=', 'udv.post_id')
            ->where("udv.is_upvote", 1)
            ->where("posts.active", 1)
            ->where("posts.published_at", "<=", Carbon::now())
            ->groupBy("udv.post_id")
            ->orderByDesc("up_votes_count")
            ->limit(3)
            ->get();

        //recommended posts
        $recommendedPosts = Post::query()
            ->join("post_views as pv", "pv.post_id", "=", "posts.id")
            ->select("posts.*", DB::raw("COUNT(*) views"))
            ->where("posts.active", 1)
            ->where("published_at", '<=', Carbon::now())
            ->groupBy("pv.post_id")
            ->orderByDesc("views")
            ->limit(3)
            ->get();

        //recent categories
        $recentCategories = Category::query()
            ->join("category_post as cp", "cp.category_id", "=", "categories.id")
            ->join("posts", "posts.id", "=", "cp.post_id")
            ->select("categories.*", DB::raw("MAX(posts.published_at) max_date"))
            ->groupBy("cp.category_id")
            ->orderByDesc("max_date")
            ->limit(3)
            ->get();

//        return view
        return view("home", compact('latestPost', "popularPosts", "recommendedPosts", "recentCategories"));
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

        //check this user (show this post or not)
//        $is_show = PostView::query()
//            ->where("ip_address", \request()->ip())
//            ->where("post_id", $post->id)
//            ->first();
        PostView::create([
            'ip_address' => \request()->ip(),
            'user_agent' => \request()->userAgent(),
            'post_id' => $post->id,
            'user_id' => auth()->id()
        ]);

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
        return view("posts_by_category", compact("posts", "category"));
    }
}
