@php
    /**
     *  @var $posts \Illuminate\Pagination\LengthAwarePaginator
     */
@endphp
<x-layouts.app :meta_title="$category->title ?? 'Home'" meta_description="home page">
    <!-- Posts Section -->
    <section class="w-full md:w-2/3 flex flex-col items-center px-3">
{{--        render posts--}}
        @foreach($posts as $post)
            {{--        post--}}
            <x-post-item :post="$post" />
        @endforeach

        <!-- Pagination -->
        {{$posts->onEachSide(1)->links()}}
    </section>

    <!-- Sidebar Section -->
    <x-sidebar />
</x-layouts.app>
