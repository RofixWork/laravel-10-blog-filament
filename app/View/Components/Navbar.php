<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $categories = Category::query()
            ->join("category_post", "categories.id", "=", "category_post.category_id")
            ->select("categories.title", "categories.slug", DB::raw("COUNT(*) AS total"))
            ->groupBy("categories.id", "categories.title", "categories.slug")
            ->limit(5)
            ->orderByDesc("total")
            ->get();
        return view('components.navbar', compact("categories"));
    }
}
