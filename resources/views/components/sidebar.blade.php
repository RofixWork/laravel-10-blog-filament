@php
    use App\Models\TextWidget;
@endphp
    <!-- Sidebar Section -->
<aside class="w-full md:w-1/3 flex flex-col items-center px-3">
    <div class="w-full bg-white shadow flex flex-col my-4 p-6">
        <p class="text-xl font-semibold pt-5 pb-2">All Categories</p>
        @foreach($categories as $category)
            <a href="{{route("posts.by-category", $category->slug)}}" class="text-base font-semibold mb-2 capitalize {{ request()->category?->slug === $category->slug ? "bg-blue-900 text-white px-2 py-2 rounded-sm" : "text-gray-700"}}">{{$category->title}} ({{$category->total}})</a>
        @endforeach
    </div>
    <div class="w-full bg-white shadow flex flex-col my-4 p-6">
        <p class="text-xl font-semibold pb-5">{{TextWidget::getTitle("about-us-sidebar")}}</p>
        <p class="pb-2">{{TextWidget::getContent("about-us-sidebar")}}</p>
        <a href="{{route("about-us")}}" class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4">
            Get to know us
        </a>
    </div>
</aside>
