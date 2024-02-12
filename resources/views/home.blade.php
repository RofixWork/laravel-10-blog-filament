@php
    /**
     *  @var $posts \Illuminate\Pagination\LengthAwarePaginator
     */
@endphp
<x-layouts.app :meta_title="$category->title ?? 'Home'" meta_description="home page">
    <section class="container">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <div class="col-span-2">
                <h2  class="text-lg md:text-2xl border-b border-blue-500 inline-block text-blue-500 font-semibold">Latest Posts</h2>
                <x-post-item :post="$latestPost" />
            </div>
            <div>
                <h2 class="text-lg md:text-2xl border-b border-blue-500 inline-block text-blue-500 font-semibold mb-3">Popular Posts</h2>
                @foreach($popularPosts as $post)
                    <article class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-6">
                        <div>
                            <img src="{{{$post->getThumbnail()}}}" alt="" class="w-full object-cover">
                        </div>
                        <div class="col-span-2">
                            <h2 class="text-lg font-semibold capitalize">{{$post->title}}</h2>
                            <p class="text-sm">{{$post->shortBody(20)}}...</p>
                            <a href="{{route("posts.show", $post->slug)}}" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i> </a>

                        </div>
                    </article>
                @endforeach
            </div>
        </div>
        <div>
            <h2 class="text-lg md:text-2xl border-b border-blue-500 inline-block text-blue-500 font-semibold">Recomended Posts</h2>
            <div class="grid grid-cols-3 gap-3">
                @foreach($recommendedPosts as $post)
                    <x-post-item :post="$post" />
                @endforeach
            </div>
        </div>
        <div>
            <h2 class="text-lg md:text-2xl border-b border-blue-500 inline-block text-blue-500 font-semibold">Recent Categories</h2>
            @foreach($recentCategories as $category)
                <a href="{{route("posts.by-category", $category->slug)}}" style="font-size: 30px;" class="block uppercase  text-blue-700 my-3 hover:text-gray-900  transition-colors flex items-center gap-3">
                    <span>{{$category->title}}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <div class="grid grid-cols-3 gap-3">
                    @foreach($category->posts as $post)
                        <x-post-item :post="$post" />
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>

</x-layouts.app>
