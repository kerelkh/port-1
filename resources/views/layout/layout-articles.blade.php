@extends('layout.index')

@section('content')
<div class="w-full sm:w-5/6 mx-auto mt-5 grid grid-cols-1 sm:grid-cols-6 gap-5 px-2 sm:px-0">
    <div class="col-span-1 sm:col-span-4">
        <h1 class="text-lg sm:text-xl text-gray-800">{{ $datas['title'] }}</h1>
        <p class="text-xs sm:text-base text-gray-500 italic break-words">{{ $datas['desc'] }}</p>
        <form class="flex items-center mt-5">
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-full sm:w-fit">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input type="search" name="search" class=" text-gray-900 text-sm border-none rounded-lg outline-none pl-10 p-2.5 " placeholder="Search" value="{{ request()->get('search') ?? '' }}">
            </div>
            <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-blue-600 rounded-lg border border-blue-600 hover:bg-blue-700 hover:text-white transition focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <span class="sr-only">Search</span>
            </button>
        </form>

        <div class="my-10">
            @forelse($datas['articles'] as $article)
            <a href="/{{ $article->type }}s/{{ $article->slug }}">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                    <div class="cols-span-1">
                        <div class="aspect-video">
                            @if($article->images != NULL)
                            <img src="{{ asset('storage/' . $article->images) }}" alt="img" class="w-full h-full object-cover">
                            @else
                            <img src="{{ asset('images/image-placeholder.png') }}" alt="img" class="w-full object-cover">
                            @endif
                        </div>
                    </div>
                    <div class="cols-span-1">
                        <h2 class="text-lg sm:text-2xl text-gray-900 hover:text-blue-800 font-serif capitalize">{{ $article->title }}</h2>
                        <span class="text-gray-600 text-xs sm:text-sm"><i class="fa-regular fa-clock"></i> {{ $article->created_at->diffForHumans() }}</span>
                        <p class="mt-2 text-gray-800 text-sm sm:text-base">{{ $article->description }}</p>
                    </div>
                </div>
            </a>
            @empty
            <p class="text-sm italic capitalize">Data Article Not Found</p>
            @endforelse

            {{-- @if($datas['articles']->count() > 0) --}}
            <div class="my-5">
                {{ $datas['articles']->withQueryString()->links('vendor.pagination.tailwind') }}
            </div>
            {{-- @endif --}}
        </div>
    </div>
    <div class="col-span-1 sm:col-span-2 py-10">
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
            <a href="/{{ request()->is('projects') ? 'articles' : 'projects' }}" class="text-xl hover:text-blue-600 font-serif">See {{ request()->is('projects') ? 'Articles' : 'Projects' }}.</a>
            @forelse ($datas['article'] as $artic )
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
