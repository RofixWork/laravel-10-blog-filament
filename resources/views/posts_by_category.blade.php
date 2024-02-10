@php
    /**
     *  @var $posts \Illuminate\Pagination\LengthAwarePaginator
     */
@endphp
<x-layouts.app :meta_title="$category->title ?? 'Home'" meta_description="home page">
    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Post Section -->
        <section class="w-full md:w-2/3 flex flex-col items-center px-3">
            @foreach($posts as $post)
                <x-post-item :post="$post"/>
            @endforeach
        </section>
        <x-sidebar />
    </div>
</x-layouts.app>
