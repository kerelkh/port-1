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
                <div class="my-5 bg-white shadow rounded-lg p-2">
                    <p class="font-medium mb-5">Recent Action</p>
                    <table class="w-full border">
                        <thead>
                            <tr class="bg-gray-200 rounded-lg ">
                                <th>Type</th>
                                <th>Remark</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($datas['logs'] as $log )
                                <tr class="p-5 border-b">
                                    <td class="p-1 text-white text-center"><span class="p-1 rounded-lg capitalize text-sm @if($log->type == 'update')bg-blue-400 @endif @if($log->type == 'create')bg-green-400 @endif @if($log->type == 'delete')bg-red-400 @endif">{{ $log->type }}</span></td>
                                    <td class="line-clamp-1 p-1">{{ $log->remark }}</td>
                                    <td class="text-center text-sm w-1/3">{{ $log->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-sm p-2">No Recent Action</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-span-1 px-4 pb-10 shadow rounded-lg">
                @include('partials.date')

                <div id="popular-article" class="mt-10">
                    <p class="font-medium text-gray-900 mb-5 border-b">Popular Article</p>
                    @forelse ($datas['popularArticles'] as $pArt)
                        <a href="/articles/{{ $pArt->slug }}" class="grid grid-cols-3 mb-2">
                            <div class="col-span-1 aspect-video">
                                <img src="{{ asset('storage/' . $pArt->images) }}" alt="Image 1" class="w-full h-full object-cover">
                            </div>
                            <div class="col-span-2">
                                <p class=" line-clamp-2 text-sm capitalize">{{ $pArt->title }}</p>
                            </div>
                        </a>
                    @empty
                        <p class="w-full text-center text-sm">No Article</p>
                    @endforelse
                </div>

                <div id="popular-project" class="mt-10">
                    <p class="font-medium text-gray-900 mb-5 border-b">Popular project</p>
                    @forelse ($datas['popularProjects'] as $pProject)
                        <a href="/projects/{{ $pProject->slug }}" class="grid grid-cols-3 mb-2">
                            <div class="col-span-1 aspect-video">
                                <img src="{{ asset('storage/' . $pProject->images) }}" alt="Image 1" class="w-full h-full object-cover">
                            </div>
                            <div class="col-span-2">
                                <p class=" line-clamp-2 text-sm capitalize">{{ $pProject->title }}</p>
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
