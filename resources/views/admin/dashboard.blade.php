@extends('admin.index')

@section('admin-content')
    <div class="p-2">
        <h1 class="text-2xl font-medium pb-2 border-b border-gray-200">Dashboard</h1>
        <div class="my-5 grid grid-cols-3 gap-5">
            <div class="col-span-2">
                <div class="flex justify-start items-stretch flex-wrap gap-2">
                    <div class="flex-1 bg-white shadow rounded-lg p-2 px-5 flex gap-2">
                        <div class="rounded-xl shadow bg-blue-400 text-white p-1 text-4xl shadow-blue-400">
                            <i class="fa-solid fa-newspaper"></i>
                        </div>
                        <div class="text-lg text-center">
                            <p class="font-medium">{{ $datas['articles'] }}</p>
                            <p class="text-gray-600 text-sm">Article</p>
                        </div>
                    </div>
                    <div class="flex-1 bg-white shadow rounded-lg p-2 px-5 flex gap-2">
                        <div class="rounded-xl shadow bg-green-400 text-white p-1 text-4xl shadow-green-400">
                            <i class="fa-solid fa-diagram-project"></i>
                        </div>
                        <div class="text-lg text-center">
                            <p class="font-medium">{{ $datas['projects'] }}</p>
                            <p class="text-gray-600 text-sm">Project</p>
                        </div>
                    </div>
                    <div class="flex-1 bg-white shadow rounded-lg p-2 px-5 flex gap-2">
                        <div class="rounded-xl shadow bg-red-400 text-white p-1 text-4xl shadow-red-400">
                            <i class="fa-solid fa-quote-left"></i>
                        </div>
                        <div class="text-lg text-center">
                            <p class="font-medium">{{ $datas['quotes'] }}</p>
                            <p class="text-gray-600 text-sm">Quote</p>
                        </div>
                    </div>
                    <div class="flex-1 bg-white shadow rounded-lg p-2 px-5 flex gap-2">
                        <div class="rounded-xl shadow bg-yellow-400 text-white p-1 text-4xl shadow-yellow-400">
                            <i class="fa-solid fa-database"></i>
                        </div>
                        <div class="text-lg text-center">
                            <p class="font-medium">{{ $datas['products'] }}</p>
                            <p class="text-gray-600 text-sm">Product</p>
                        </div>
                    </div>
                    <div class="flex-1 bg-white shadow rounded-lg p-2 px-5 flex gap-2">
                        <div class="rounded-xl shadow bg-purple-400 text-white p-1 text-4xl shadow-purple-400">
                            <i class="fa-solid fa-images"></i>
                        </div>
                        <div class="text-lg text-center">
                            <p class="font-medium">{{ $datas['gallery'] }}</p>
                            <p class="text-gray-600 text-sm">Gallery</p>
                        </div>
                    </div>
                    <div class="flex-1 bg-white shadow rounded-lg p-2 px-5 flex gap-2">
                        <div class="rounded-xl shadow bg-blue-400 text-white p-1 text-4xl shadow-blue-400">
                            <i class="fa-solid fa-images"></i>
                        </div>
                        <div class="text-lg text-center">
                            <p class="font-medium">{{ $datas['gallery'] }}</p>
                            <p class="text-gray-600 text-sm">Gallery</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-1 px-4 shadow rounded-lg">
                @include('partials.date')
            </div>
        </div>
    </div>

@endsection
