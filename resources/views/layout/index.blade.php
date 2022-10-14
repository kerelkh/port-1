<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ ($datas['title'] ?? false) ? $datas['title'] . ' - ' : '' }}RINGGA </title>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/> --}}
    <link rel="stylesheet" href="{{ asset('css/photoswipe.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    @yield('js')
    <script src="{{ asset('js/app.js') }}"></script>

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        /* Firefox */
        input[type=number] {
        -moz-appearance: textfield;
        }

        .lds-dual-ring {
        display: inline-block;
        width: 80px;
        height: 80px;
        }
        .lds-dual-ring:after {
        content: " ";
        display: block;
        width: 64px;
        height: 64px;
        margin: 8px;
        border-radius: 50%;
        border: 6px solid #fff;
        border-color: #fff transparent #fff transparent;
        animation: lds-dual-ring 1.2s linear infinite;
        }
        @keyframes lds-dual-ring {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
        }
    </style>
</head>
<body>
    <div id="app" class="min-h-screen mb-10">
        <div class="bg-gray-600 p-1 flex justify-end items-center divide-x text-xs text-gray-100 space-x-2">
            <p class="px-1 tracking-wider"><i class="fa-regular fa-flag"></i> INDONESIA</p>
            <P class="px-1"><i class="fa-solid fa-calendar-days"></i> {{ now()->format('d M Y') }}</P>
        </div>
        <x-navtop></x-navtop>
        @yield('content')
    </div>

    @include('templates.loading')
    <footer class="fixed bottom-0 w-full">
        <p class="p-2 text-center text-gray-100 text-xs bg-gray-800">&copy; Copyright by Kerelka.com</p>
    </footer>

    <script>
        $('document').ready(function() {
            setTimeout(()=> {
                $('#loading').fadeOut(100);
            },1000);
            lightbox.init();

        });

        $(document).bind("ajaxSend", function(){
            $("#loading").fadeIn(100);
        }).bind("ajaxComplete", function(){
            $("#loading").fadeOut(100);
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>
</html>
