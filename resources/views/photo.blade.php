@extends('layout.index')

@section('content')
<div class="w-5/6 mx-auto my-5">
    <h1 class="text-xl text-gray-800">{{ $datas['title'] }}</h1>
    <p class=" text-gray-500 italic break-words">{{ $datas['desc'] }}</p>

    <div id="my-gallery" class="my-10 w-full flex flex-wrap justify-start items-stretch gap-2 ">
        @forelse($datas['galleries'] as $gly)
        <a href="{{ asset('storage/' . $gly->images) }}" data-pswp-width="5000"
        data-pswp-height="2500"
        target="_blank" class="w-full sm:max-w-[250px] relative group shadow-lg">
            <div class="w-full sm:w-[250px] aspect-video">
                <img src="{{ asset('storage/' . $gly->images) }}" alt="" class="w-full h-full object-cover" loading="lazy">
            </div>
            <p class="absolute bottom-0 left-0 right-0 line-clamp-1 px-1 text-sm flex justify-center items-center bg-gradient-to-r from-black via-black/50 to-transparent text-white">{{ $gly->name }}</p>
        </a><br>
        @empty

        @endforelse
    </div>
</div>
@endsection
