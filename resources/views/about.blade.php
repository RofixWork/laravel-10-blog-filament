<x-layouts.app meta_title="about us" meta_description="about us page">
    <section class="w-full mx-auto md:w-2/3 flex flex-col items-center px-3">
        <h2 class="hover:opacity-75 h-auto md:h-[200px]">
            <img src="{{asset("/storage/{$widget->image}")}}" alt="" class="w-full object-cover">
        </h2>
        <div class="bg-white flex flex-col justify-start p-6">
            <h3 class="text-3xl font-bold hover:text-gray-700 pb-4 capitalize">{{$widget->title}}</h3>
            <p class="pb-6">{!! $widget->content!!}</p>
        </div>
    </section>
</x-layouts.app>
