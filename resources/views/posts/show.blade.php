<x-layouts.app :meta_title="$post->meta_title" :meta_description="$post->meta_description">
{{--    post section--}}
    <section class="w-full md:w-2/3 flex flex-col px-3">
        <article class="flex flex-col shadow my-4 w-full">
            <!-- Article Image -->
            <a href="#" class="hover:opacity-75">
                <img src="{{$post->getThumbnail()}}" alt="{{$post->title}}" class="w-full">
            </a>
            <div class="bg-white flex flex-col justify-start p-6">
                <div class="flex gap-3">
                    @foreach($post->categories as $category)
                        <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">{{$category->title}}</a>
                    @endforeach
                </div>
                <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4 capitalize">{{$post->title}}</a>
                <p href="#" class="text-sm pb-8">
                    By <a href="#" class="font-semibold hover:text-gray-800">{{$post->user->name}}</a>, Published on {{$post->getFormattedDate()}}
                </p>
                <div>
                    {!! $post->body !!}
                </div>
                <livewire:upvote-downvote :post="$post" />
            </div>
        </article>

        <div class="w-full flex pt-6">
            <div class="w-1/2">
                @unless(is_null($prev))
                    <a href="{{route("posts.show", $prev->slug)}}" class="block w-full bg-white shadow hover:shadow-md text-left p-6">
                        <p class="text-lg text-blue-800 font-bold flex items-center"><i class="fas fa-arrow-left pr-1"></i> Previous</p>
                        <p class="pt-2">{{$prev->title}}</p>
                    </a>
                @endunless
            </div>

            <div class="w-1/2">
                @unless(is_null($next))
                    <a href="{{route("posts.show", $next->slug)}}" class="w-full block bg-white shadow hover:shadow-md text-right p-6">
                        <p class="text-lg text-blue-800 font-bold flex items-center justify-end">Next <i class="fas fa-arrow-right pl-1"></i></p>
                        <p class="pt-2">{{$next->title}}</p>
                    </a>
                @endunless
            </div>
        </div>
        <livewire:comments :post="$post" />
    </section>
    <!-- Sidebar Section -->
    <x-sidebar />
</x-layouts.app>
