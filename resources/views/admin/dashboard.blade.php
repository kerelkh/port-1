@extends('admin.index')

@section('admin-content')
    <div class="p-2">
        <h1 class="text-2xl font-medium pb-2 border-b border-gray-200">Dashboard</h1>
        <div class="my-5 grid grid-cols-3 gap-5">
            <div class="col-span-3 sm:col-span-2">
                <div class="flex justify-start items-stretch flex-wrap gap-2">
                    <div class="flex-1 bg-white shadow rounded-lg p-2 px-5 flex gap-2">
                        <div class="rounded-xl w-12 h-12 aspect-square text-center shadow bg-blue-400 text-white p-1 text-4xl shadow-blue-400">
                            <i class="fa-solid fa-newspaper"></i>
                        </div>
                        <div class="w-full text-lg text-center">
                            <p class="font-medium">{{ $datas['articles'] }}</p>
                            <p class="text-gray-600 text-sm">Article</p>
                        </div>
                    </div>
                    <div class="flex-1 bg-white shadow rounded-lg p-2 px-5 flex gap-2">
                        <div class="rounded-xl w-12 h-12 aspect-square text-center shadow bg-green-400 text-white p-1 text-4xl shadow-green-400">
                            <i class="fa-solid fa-diagram-project"></i>
                        </div>
                        <div class="w-full text-lg text-center">
                            <p class="font-medium">{{ $datas['projects'] }}</p>
                            <p class="text-gray-600 text-sm">Project</p>
                        </div>
                    </div>
                    <div class="flex-1 bg-white shadow rounded-lg p-2 px-5 flex gap-2">
                        <div class="rounded-xl w-12 h-12 aspect-square text-center shadow bg-red-400 text-white p-1 text-4xl shadow-red-400">
                            <i class="fa-solid fa-quote-left"></i>
                        </div>
                        <div class="w-full text-lg text-center">
                            <p class="font-medium">{{ $datas['quotes'] }}</p>
                            <p class="text-gray-600 text-sm">Quote</p>
                        </div>
                    </div>
                    <div class="flex-1 bg-white shadow rounded-lg p-2 px-5 flex gap-2">
                        <div class="rounded-xl w-12 h-12 aspect-square text-center shadow bg-yellow-400 text-white p-1 text-4xl shadow-yellow-400">
                            <i class="fa-solid fa-database"></i>
                        </div>
                        <div class="w-full text-lg text-center">
                            <p class="font-medium">{{ $datas['products'] }}</p>
                            <p class="text-gray-600 text-sm">Product</p>
                        </div>
                    </div>
                    <div class="flex-1 bg-white shadow rounded-lg p-2 px-5 flex gap-2">
                        <div class="rounded-xl w-12 h-12 aspect-square text-center shadow bg-purple-400 text-white p-1 text-4xl shadow-purple-400">
                            <i class="fa-solid fa-images"></i>
                        </div>
                        <div class="w-full text-lg text-center">
                            <p class="font-medium">{{ $datas['gallery'] }}</p>
                            <p class="text-gray-600 text-sm">Gallery</p>
                        </div>
                    </div>
                    <div class="flex-1 bg-white shadow rounded-lg p-2 px-5 flex gap-2">
                        <div class="rounded-xl w-12 h-12 aspect-square text-center shadow bg-blue-400 text-white p-1 text-4xl shadow-blue-400">
                            <i class="fa-brands fa-firstdraft"></i>
                        </div>
                        <div class="w-full text-lg text-center">
                            <p class="font-medium">{{ $datas['draft'] }}</p>
                            <p class="text-gray-600 text-sm">Draft</p>
                        </div>
                    </div>
                </div>
                <div class="my-5 bg-white shadow rounded-lg p-2 overflow-hidden">
                    <p class="font-medium mb-5">Recent Action</p>
                    <table class="w-full border overflow-auto">
                        <thead>
                            <tr class="bg-gray-200 rounded-lg ">
                                <th>Type</th>
                                <th>Remark</th>
                                <th class="hidden sm:block">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($datas['logs'] as $log )
                                <tr class="p-5 border-b">
                                    <td class="p-1 text-white text-center"><span class="p-1 rounded-lg capitalize text-xs sm:text-sm @if($log->type == 'update')bg-blue-400 @endif @if($log->type == 'create')bg-green-400 @endif @if($log->type == 'delete')bg-red-400 @endif">{{ $log->type }}</span></td>
                                    <td class="line-clamp-1 p-1 text-xs sm:text-sm md:text-base">{{ $log->remark }}</td>
                                    <td class="hidden sm:table-cell text-center text-sm w-1/3">{{ $log->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-sm p-2">No Recent Action</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-5 hidden sm:block">
                        <p class="font-medium mb-5">Recent Message</p>
                        <table class="w-full border">
                            <thead>
                                <tr class="bg-gray-200 rounded-lg ">
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($datas['messages'] as $message )
                                    <tr class="p-5 border-b">
                                        <td class="p-1 text-center"><span class="p-1 rounded-lg capitalize text-xs">{{ $message->email }}</span></td>
                                        <td class="p-1 text-xs">{{ $message->message }}</td>
                                        <td class="text-center text-xs w-1/3">{{ $message->created_at->diffForHumans() }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-sm p-2">No Recent Message</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-span-3 sm:col-span-1 px-4 pb-10 shadow rounded-lg">
                @include('partials.date')

                <div id="popular-article" class="mt-10">
                    <p class="font-medium text-gray-900 mb-5 border-b">Popular Article</p>
                    @forelse ($datas['popularArticles'] as $pArt)
                        <a href="/articles/{{ $pArt->slug }}" class="grid grid-cols-3 mb-10 md:mb-5">
                            <div class="col-span-1 aspect-video">
                                <img src="{{ asset('storage/' . $pArt->images) }}" alt="Image 1" class="w-full h-full object-cover">
                            </div>
                            <div class="col-span-2">
                                <p class=" line-clamp-2 text-sm capitalize px-2 text-gray-900 font-medium">{{ $pArt->title }}</p>
                            </div>
                        </a>
                    @empty
                        <p class="w-full text-center text-sm">No Article</p>
                    @endforelse
                </div>

                <div id="popular-project" class="mt-10">
                    <p class="font-medium text-gray-900 mb-5 border-b">Popular Product</p>
                    @forelse ($datas['popularProducts'] as $pProduct)
                        <a href="/product/{{ $pProduct->slug }}" class="grid grid-cols-3 mb-10 md:mb-5">
                            <div class="col-span-1 aspect-video">
                                <img src="{{ asset('storage/' . $pProduct->images) }}" alt="Image 1" class="w-full h-full object-cover">
                            </div>
                            <div class="col-span-2 px-2 text-gray-900 font-medium">
                                <p class=" line-clamp-2 text-sm capitalize">{{ $pProduct->name }}</p>
                            </div>
                        </a>
                    @empty
                        <p class="w-full text-center text-sm">No Project</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection
