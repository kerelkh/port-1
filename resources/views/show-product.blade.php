@extends('layout.index')

@section('content')
<div class="w-5/6 mx-auto my-5 grid grid-cols-3 gap-5">
    <div class="col-span-3 flex gap-2 items-center">
        <a href="/products" class="text-gray-500 hover:text-gray-900"><i class="fa-solid fa-warehouse"></i> Products</a>
        <i class="fa-solid fa-caret-right"></i>
        <p class="capitalize line-clamp-1">Lorem, ipsum dolor sit amet consectetur adipisicing.</p>
    </div>
    <div class="col-span-1 aspect-square overflow-hidden">
        <img src="{{ asset('storage/' . $datas['product']->images) }}" alt="" class="w-full h-full object-cover">
    </div>
    <div class="col-span-2">
        <h1 class="w-5/6 text-4xl font-medium font-serif mb-2 capitalize">{{ $datas['product']->name }}</h1>
        <p class="{{ ($datas['product']->stock != 0) ? 'text-black' : 'text-red-600' }}">Stock: {{ $datas['product']->stock }}</p>
        <p class="font-medium text-3xl">Rp{{ number_format($datas['product']->price,2,',','.') }}</p>
        <div class="my-5">
            <p class="w-1/2 text-lg border-b mb-5">Detail</p>
            <div class="grid grid-cols-3">
                <div class="col-span-2">{!! $datas['product']->description !!}</div>
                <div class="col-span-1 flex justify-center items-center">
                    <a href="/" class="text-2xl py-2 px-4 shadow-lg rounded-lg text-white bg-green-500 hover:bg-green-600 transition"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-3 my-10">
        <a href="/products" class="border-b hover:text-blue-600">See Other <i class="fa-solid fa-arrow-right"></i></a>
        <div class="my-2 flex justify-start items-stretch">
            @forelse($datas['products'] as $product)
            <a href="/products/{{ $product->slug }}" class="w-[200px] p-2 transition rounded-lg">
                <div class="w-full aspect-square overflow-hidden">
                    <img src="{{ asset('storage/' . $product->images) }}" alt="" class="w-full object-cover">
                </div>
                <div class="my-2 flex flex-col gap-2">
                    <p class="line-clamp-2 font-serif text-sm capitalize">{{ $product->name }}</p>
                    <p class="text-xs {{ ($product->stock != 0) ? 'text-black' : 'text-red-600' }} font-medium"><i class="fa-solid fa-box"></i> {{ $product->stock }}</p>
                    <p class="text-xs text-green-600 font-medium"><i class="fa-solid fa-rupiah-sign"></i> {{ number_format($product->price,2,',','.') }} (Each)</p>
                </div>
            </a>
            @empty
            <p class="w-full text-sm">No Data</p>
            @endforelse
        </div>
    </div>
</div>

@endsection
