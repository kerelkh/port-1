@extends('layout.index')

@section('content')
<div class="w-5/6 mx-auto my-5">
    <h1 class="text-xl text-gray-800">{{ $datas['title'] }}</h1>
    <p class=" text-gray-500 italic break-words">{{ $datas['desc'] }}</p>
    <form class="flex items-center mt-5">
        <label for="simple-search" class="sr-only">Search</label>
        <div class="relative w-fit">
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

    <div class="my-2 flex justify-start items-stretch">
        @forelse($datas['products'] as $product)
        <a href="/products/{{ $product->slug }}" class="w-[200px] p-2 transition rounded-lg">
            <div class="w-full aspect-square overflow-hidden">
                @if($product->images != '' || $product->images != NULL)
                <img src="{{ asset('storage/' . $product->images) }}" alt="" class="w-full object-cover">
                @else
                <img src="{{ asset('images/image-placeholder.png') }}" alt="" class="w-full object-cover">
                @endif
            </div>
            <div class="my-2 flex flex-col gap-2">
                <p class="line-clamp-2 font-serif text-sm capitalize">{{ $product->name }}</p>
                <p class="text-xs {{ ($product->stock != 0) ? 'text-blue-600' : 'text-red-600' }} font-medium"><i class="fa-solid fa-box"></i> {{ $product->stock }}</p>
                <p class="text-xs text-green-600 font-medium"><i class="fa-solid fa-rupiah-sign"></i> {{ number_format($product->price,2,',','.') }}</p>
            </div>
        </a>
        @empty
        <p class="w-full text-sm">No Data</p>
        @endforelse
    </div>
</div>
@endsection
