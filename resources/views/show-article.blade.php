@extends('layout.index')

@section('content')
<div class="w-5/6 mx-auto mt-5 grid grid-cols-6 gap-5 mb-20">
    <div class="col-span-4">
        <div class="flex justify-start items-center gap-2 mb-10">
            <a href="/{{ $datas['article']->type }}s" class="capitalize flex justify-center items-center gap-2"><i class="fa-regular fa-newspaper"></i> {{ $datas['article']->type }}</a>
            <i class="fa-solid fa-caret-right"></i>
            <p class="capitalize line-clamp-1">{{ $datas['article']->title }}</p>
        </div>
        <h1 class="font-serif text-5xl pr-10 mb-5 capitalize">{{ $datas['article']->title }}</h1>
        <div class="flex items-center space-x-2 text-gray-500 mb-5">
            <p class="flex gap-2 items-center"><i class="fa-solid fa-clock-rotate-left"></i> <span>{{ $datas['article']->created_at->format('M d, Y') }}</span></p>
            <p class="flex gap-2 items-center"><i class="fa-solid fa-eye"></i> <span>{{ $datas['article']->view }}</span></p>
        </div>

        <div id="description" class="text-lg leading-8 mb-5">
            <p>{{ $datas['article']->description }}</p>
        </div>

        <div class="border-t-2 border-black/50 mb-5"></div>

        <div class="w-full mb-5">
            @if($datas['article']->images != NULL)
            <img src="{{ asset('storage/' . $datas['article']->images) }}" alt="images" class="aspect-video object-cover">
            @else
            <img src="{{ asset('images/image-placeholder.png') }}" alt="images" class="aspect-video object-cover">
            @endif
        </div>

        <div id="body" class="text-lg leading-8 space-y-10 mb-5">
            {!! $datas['article']->body !!}
        </div>
    </div>
    <div class="col-span-2 py-10">
        <p class="text-gray-800 text-xl font-serif mb-2">Quotes.</p>
        <div class="mb-5">
            @foreach($datas['quotes'] as $quote)
            <p class="font-serif italic leading-8">"{{ $quote['quote'] }}."<span class="text-gray-600 text-sm">- {{ $quote['name'] }}</span></p>
            @endforeach
        </div>
        @if($datas['squareBanners'][$datas['randNumber']]->images != NULL)
        <img src="{{ asset('storage/' . $datas['squareBanners'][$datas['randNumber']]->images) }}" alt="images" class="w-full">
        @else
        <img src="{{ asset('images/defaultSquareBanner.png') }}" alt="images" class="w-full">
        @endif
        <div class="mt-5">
            <a href="/projects" class="text-xl hover:text-blue-600 font-serif">See Projects.</a>
            @forelse ($datas['articles'] as $artic )
            <a href='/{{ $artic->type }}s/{{ $artic->slug }}' class="grid grid-cols-3 gap-4 mt-5">
                <div class="col-span-1 bg-blue-500" >
                    <img src="{{ asset('storage/' . $artic->images) }}" alt="thumbnail" class="w-full object-cover">
                </div>
                <div class="col-span-2">
                    <p class="line-clamp-2">{{ $artic->title }}</p>
                    <p class="text-xs text-gray-500"><i class="fa-regular fa-clock"></i> {{ $artic->created_at->format('M d, Y') }}</p>
                </div>
            </a>
            @empty
            <p>No project found.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
