@extends('layout.index')

@section('js')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <x-head.tinymce-config id="body"></x-head>
@endsection

@section('content')
    <div class="w-full md:w-5/6 px-5 md:px-0 mx-auto grid grid-cols-4 mt-10">
        <div class="col-span-4 md:col-span-1 overflow-hidden">
            <div class="border border-gray-200 rounded-lg flex flex-col items-stretch p-2 space-y-2">
                <a
                    href="/dashboard"
                    class="rounded-lg px-2 py-1 hover:bg-gray-100 {{ request()->path() == 'dashboard' ? 'bg-gray-100' : '' }}"
                >Dashboard</a>
                <a
                    href="/content"
                    class="rounded-lg px-2 py-1 hover:bg-gray-100 {{ request()->path() == 'content' ? 'bg-gray-100' : '' }}"
                >Content</a>
                <a
                    href="/admin/articles"
                    class="rounded-lg px-2 py-1 hover:bg-gray-100 {{ request()->path() == 'admin/articles' ? 'bg-gray-100' : '' }}"
                >Articles</a>
                <a
                    href="/admin/quotes"
                    class="rounded-lg px-2 py-1 hover:bg-gray-100 {{ request()->path() == 'admin/quotes' ? 'bg-gray-100' : '' }}"
                >Quotes</a>
                <a
                    href="/admin/gallery"
                    class="rounded-lg px-2 py-1 hover:bg-gray-100 {{ request()->path() == 'admin/gallery' ? 'bg-gray-100' : '' }}"
                >Gallery</a>
                <a
                    href="/admin/products"
                    class="rounded-lg px-2 py-1 hover:bg-gray-100 {{ request()->path() == 'admin/products' ? 'bg-gray-100' : '' }}"
                >Products</a>
                <a
                    href="/setting"
                    class="rounded-lg px-2 py-1 hover:bg-gray-100 {{ request()->path() == 'setting' ? 'bg-gray-100' : '' }}"
                >Setting</a>
            </div>
        </div>
        <div class="col-span-4 md:col-span-3 md:px-4 overflow-hidden mt-10 md:mt-0">
            @yield('admin-content')
        </div>
    </div>

@endsection
