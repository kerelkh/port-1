<div class="w-full sticky top-0 bg-white z-50">
    <nav class="w-5/6 mx-auto flex justify-between items-center py-2">
        <div class="h-6 md:h-10 overflow-hidden">
            <a href="/">
                {{-- <img src="https://cdn.cdnlogo.com/logos/g/68/guess.svg" alt="Logo" class="h-full"> --}}
                <img src="{{ asset('images/logo3.png') }}" alt="Logo" class="h-full">
            </a>
        </div>
        <div class="flex justify-center items-center space-x-3">
            @guest
                <a href="/login" class="text-sm py-1 px-2 border border-gray-400 text-gray-800 rounded-lg hover:bg-gray-700 hover:text-white transition"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
            @endguest
            @auth
            <div class="relative">
                <button class="font-serif border-b border-gray-400 font-medium text-sm text-gray-600 hover:text-gray-900" id="admin-toggle-btn" data-toggle="admin-menu">Hi, {{ Auth::user()->name }} <i class="caret fa-solid fa-caret-right"></i><i class="caret hidden fa-solid fa-caret-down"></i></button>
                <div id="admin-menu" class="absolute top-100 right-0 z-40 flex shadow-lg flex-col items-stretch bg-white text-sm rounded-lg divide-y overflow-hidden" style="display: none">
                    <a href="/dashboard" class="p-2 hover:bg-gray-100">Dashboard</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="w-full text-left p-2 text-red-400 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </nav>
    <div class="bg-gray-800 text-white font-serif">
        <div class="w-5/6 mx-auto flex flex-wrap justify-between items-center py-2">
            <a href="/" class="hover:text-blue-400 py-1 px-2 {{ (Request::is('/')) ? 'text-blue-400' : ''}}">Home</a>
            <a href="/articles" class="hover:text-blue-400 py-1 px-2 {{ (Request::is('articles')) ? 'text-blue-400' : ''}}">Article's</a>
            <a href="/projects" class="hover:text-blue-400 py-1 px-2 {{ (Request::is('projects')) ? 'text-blue-400' : ''}}">Project's</a>
            <a href="/quotes" class="hover:text-blue-400 py-1 px-2 ">Quote's</a>
            <a href="/gallery" class="hover:text-blue-400 py-1 px-2 {{ (Request::is('gallery')) ? 'text-blue-400' : ''}}">Gallery</a>
            <a href="/products" class="hover:text-blue-400 py-1 px-2 ">Product's</a>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(e) {
        $('#admin-toggle-btn').on('click', function() {
            let el = $(this).data('toggle');
            $("#" + el).toggle();
            $('.caret').toggle();
        })
    })
</script>
