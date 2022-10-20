@extends('layout.index')

@section('content')
<div class="bg-blue-200 bg-cover bg-no-repeat bg-center" style="background-image: url({{
    ($datas['landing-banner']->value ?? false) ?
        asset('storage/' . $datas['landing-banner']->value)
    :
        asset('images/defaultLanding.jpg')
}})">
    <div class="w-5/6 min-h-[420px] mx-auto flex items-stretch py-10">
        <div class="flex-1 flex flex-col justify-end text-white" style="text-shadow:2px 2px #000">
            <h1 class="text-4xl sm:text-5xl font-serif font-medium">{{ $datas['landing-title']?->value ?? 'Hi,' }}</h1>
            <p class="sm:leading-8 text-lg sm:text-xl font-sans">{{ $datas['landing-desc']?->value ?? 'Welcome to my website' }}</p>
        </div>
    </div>
</div>
<div class="w-full px-2 sm:px-0 md:w-5/6 min-h-[600px] mx-auto py-10">
    <div class="flex flex-col sm:flex-row items-stretch sm:items-start gap-10 sm:gap-5">
        <div class="flex-1 grid grid-cols-2">
            <div class="col-span-1">
                <h2 class="text-2xl sm:text-3xl font-medium text-gray-800 font-serif">Support Me.</h2>
                <ul class="mt-2 sm:mt-5">
                @foreach($datas['supports'] as $support)
                    <li class="w-full sm:w-fit sm:text-lg text-gray-700 hover:text-blue-800 hover:text-xl font-medium transition ease-in-out"><i class="fa-solid fa-check"></i> <a target="__BLANK" href="{{ $support->url }}">{{ $support->name }}</a><br></li>
                @endforeach
                </ul>
            </div>
            <div class="col-span-1">
                @if($datas['portraitBanners'][0]?->images != '')
                    <img src="{{ asset('storage/' . $datas['portraitBanners'][0]->images) }}" alt="banner 1" class="max-h-[400px]">
                @else
                    <img src="{{ asset('images/defaultPortraitBanner.png') }}" alt="banner 1" class="max-h-[400px]">
                @endif
            </div>
        </div>
        <div class="flex-1 grid grid-cols-2">
            <div class="col-span-1">
                <h2 class="text-2xl sm:text-3xl font-medium text-gray-800 font-serif">Referral.</h2>
                <ul class="mt-5">
                @foreach($datas['referrals'] as $referral)
                    <li class="w-full sm:w-fit sm:text-lg text-gray-700 hover:text-blue-800 hover:text-xl font-medium transition ease-in-out"><i class="fa-solid fa-sack-dollar"></i> <a target="__BLANK" href="{{ $referral->url }}">{{ $referral->name }}</a><br></li>
                @endforeach
                </ul>
            </div>
            <div class="col-span-1">
                @if($datas['portraitBanners'][1]?->images != '')
                    <img src="{{ asset('storage/' . $datas['portraitBanners'][1]->images) }}" alt="banner 1" class="max-h-[400px]">
                @else
                    <img src="{{ asset('images/defaultPortraitBanner.png') }}" alt="banner 1" class="max-h-[400px]">
                @endif
            </div>
        </div>
    </div>
    <div class="flex flex-col sm:flex-row items-stretch sm:items-start mt-10 gap-10 sm:gap-5 pt-5">
        <div class="flex-1">
            <h2 class="text-3xl font-medium text-gray-800 font-serif mb-5">Gallery.</h2>
            @if($datas['galleries']?->count() > 0)
            <div id="my-gallery" class=" w-full flex flex-wrap items-start ">
                @foreach($datas['galleries'] as $photo)
                <a href="{{ asset('storage/' . $photo->images) }}" data-pswp-width="5000"
                data-pswp-height="2500"
                target="_blank" class="w-2/4">
                    <img src="{{ asset('storage/' . $photo->images) }}" alt="{{ $photo->name }}" class="aspect-video object-cover" loading="lazy">
                </a><br>
                @endforeach
            </div>
            @else
            <div id="my-gallery" class=" w-full flex flex-wrap items-start ">
                <a href="{{ asset('images/photo1.webp') }}" data-pswp-width="3000"
                data-pswp-height="2500"
                target="_blank" class="w-2/4">
                    <img src="{{ asset('images/photo1.webp') }}" alt="photo1" class="aspect-video object-cover" loading="lazy">
                </a><br>
                <a href="{{ asset('images/photo2.webp') }}" data-pswp-width="1875"
                data-pswp-height="2500"
                target="_blank" class="w-2/4">
                    <img src="{{ asset('images/photo2.webp') }}" alt="photo1" class="aspect-video object-cover" loading="lazy">
                </a>
                <a href="{{ asset('images/photo3.webp') }}" data-pswp-width="1875"
                data-pswp-height="2500"
                target="_blank" class="w-2/4">
                    <img src="{{ asset('images/photo3.webp') }}" alt="photo1" class="aspect-video object-cover" loading="lazy">
                </a>
                <a href="{{ asset('images/photo4.webp') }}" data-pswp-width="1875"
                data-pswp-height="2500"
                target="_blank" class="w-2/4">
                    <img src="{{ asset('images/photo4.webp') }}" alt="photo1" class="aspect-video object-cover" loading="lazy">
                </a>
                <a href="{{ asset('images/photo5.webp') }}" data-pswp-width="1875"
                data-pswp-height="2500"
                target="_blank" class="w-2/4">
                    <img src="{{ asset('images/photo5.webp') }}" alt="photo1" class="aspect-video object-cover" loading="lazy">
                </a>
                <a href="{{ asset('images/photo6.webp') }}" data-pswp-width="1875"
                data-pswp-height="2500"
                target="_blank" class="w-2/4">
                    <img src="{{ asset('images/photo6.webp') }}" alt="photo1" class="aspect-video object-cover" loading="lazy">
                </a>
            </div>
            @endif
        </div>
        <div class="flex-1">
            <h2 class="text-3xl font-medium text-gray-800 font-serif mb-5">Article's.</h2>
            @foreach($datas['articles'] as $article)
            <a href="/articles/{{ $article->slug }}" class="grid grid-col-1 sm:grid-cols-3 gap-5 mb-5">
                <div class="col-span-1">
                    @if($article->images != NULL)
                    <div class="aspect-video sm:aspect-square">
                        <img src="{{ asset('storage/' . $article->images) }}" alt="img" class="w-full h-full object-cover">
                    </div>
                    @else
                    <img src="{{ asset('images/image-placeholder.png') }}" alt="img" class="aspect-square">
                    @endif
                </div>
                <div class="col-span-1 sm:col-span-2">
                    <p class="text-lg sm:text-xl text-gray-900 hover:text-blue-800 font-serif capitalize">{{ $article->title }}</p><br>
                    <span class="text-gray-600 text-xs"><i class="fa-regular fa-clock"></i> {{ $article->created_at->diffForHumans() }}</span>
                    <p class="mt-2 text-gray-800 line-clamp-5 text-xs sm:text-sm">{{ $article->description }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    <div class="flex flex-col sm:flex-row items-center sm:items-start justify-between mt-10 gap-5">
        <div class="flex-1">
            @if($datas['squareBanners'][0]?->images != '')
                <img src="{{ asset('storage/' . $datas['squareBanners'][0]->images) }}" alt="banner 1" class="max-h-[400px] shadow-lg">
            @else
                <img src="{{ asset('images/defaultSquareBanner.png') }}" alt="banner 1" class="max-h-[400px]">
            @endif
        </div>
        <div class="flex-1">
            @if($datas['squareBanners'][1]?->images != '')
                <img src="{{ asset('storage/' . $datas['squareBanners'][1]->images) }}" alt="banner 1" class="max-h-[400px] shadow-lg">
            @else
                <img src="{{ asset('images/defaultSquareBanner.png') }}" alt="banner 1" class="max-h-[400px]">
            @endif
        </div>
        <div class="flex-1">
            @if($datas['squareBanners'][2]?->images != '')
                <img src="{{ asset('storage/' . $datas['squareBanners'][2]->images) }}" alt="banner 1" class="max-h-[400px] shadow-lg">
            @else
                <img src="{{ asset('images/defaultSquareBanner.png') }}" alt="banner 1" class="max-h-[400px]">
            @endif
        </div>
    </div>
</div>
@include('partials.contact')

@endsection
