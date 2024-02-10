@props(['post'])
<article class="flex flex-col shadow my-4 w-full">
    <!-- Article Image -->
    <a href="{{route("posts.show", $post->slug)}}" class="hover:opacity-75 h-auto">
        <img src="{{{$post->getThumbnail()}}}" alt="" class="w-full object-cover">
    </a>
    <div class="bg-white flex flex-col justify-start p-6">
        <div class="flex gap-3">
            @foreach($post->categories as $category)
                <a href="{{route("posts.by-category", $category->slug)}}" class="text-blue-700 text-sm font-bold uppercase pb-4">{{$category->title}}</a>
            @endforeach
        </div>

        <a href="{{route("posts.show", $post->slug)}}" class="text-3xl font-bold hover:text-gray-700 pb-4 capitalize">{{$post->title}}</a>
        <p href="{{route("posts.show", $post->slug)}}" class="text-sm pb-3">
            By <a href="#" class="font-semibold hover:text-gray-800">{{$post->user->name}}</a>, Published on {{$post->getFormattedDate()}} | {{$post->humanReadTime()}}
        </p>
        <a href="{{route("posts.show", $post->slug)}}" class="pb-6">{{$post->shortBody()}}..</a>
        <a href="{{route("posts.show", $post->slug)}}" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i> </a>
    </div>
</article>
