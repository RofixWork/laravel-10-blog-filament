@props(["meta_title", "meta_description"])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$meta_title ?: "Easy Tutorial"}}</title>
    <meta name="author" content="rofix">
    <meta name="description" content="{{$meta_description ?: "this blog contains more information about new technology"}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }
    </style>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @livewireStyles
    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>
<body class="bg-white font-family-karla">
    <!-- Text Header -->
    <header class="w-full container mx-auto">
        <div class="flex flex-col items-center py-12">
            <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="{{route("home")}}">
                {{\App\Models\TextWidget::getTitle("blog-header")}}
            </a>
            <p class="text-lg text-gray-600">
                {{\App\Models\TextWidget::getContent("blog-header")}}
            </p>
        </div>
    </header>

    <!-- Topic Nav -->
    <x-navbar />


    <div class="container mx-auto flex flex-wrap py-6">

        {{$slot}}

    </div>

    <footer class="w-full border-t bg-white pb-12">
        <div class="w-full container mx-auto flex flex-col items-center">
            <div class="uppercase py-6">&copy; myblog.com</div>
        </div>
    </footer>
    @livewireScripts
</body>
</html>
