@extends('layout.index')

@section('content')
    <div class="mt-10 h-full flex justify-center items-center">
        <div class="mt-20 sm:mt-10 w-[720px] aspect-video rounded-lg shadow-lg bg-white flex">
            <div class="flex-1 flex flex-col justify-center items-stretch">
                <div class="w-5/6 mx-auto">
                    @if(session('error'))
                        <p class="py-1 px-2 text-red-700 bg-red-100 my-2 text-sm mb-2">* {{ session('error') }}</p>
                    @endif
                    @if(session('message'))
                        <p class="py-1 px-2 text-green-700 bg-green-100 my-2 text-sm mb-2">* {{ session('message') }}</p>
                    @endif
                    <h1 class="text-xl font-medium font-serif mb-2">Sign In</h1>
                    <form action="{{ route('login') }}" method="POST" class="">
                        @csrf
                        <div class="mb-2 flex flex-col items-stretch">
                            <div class="relative z-0 mb-6 w-full group">
                                <input type="text" name="username" id="username" value="{{ old('username') }}" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required autofocus/>
                                <label for="username" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username</label>
                            </div>
                            @error('username')
                            <span class="text-red-600 text-sm italic">* {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-2 flex flex-col items-stretch">
                            <div class="relative z-0 mb-6 w-full group">
                                <input type="password" name="password" id="password" value="{{ old('password') }}" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required autofocus/>
                                <label for="password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                            </div>
                        </div>
                        <div class="mb-2 mt-4 flex flex-col items-stretch">
                            <button type="submit" class="text-center p-2 bg-gray-800 hover:shadow-lg rounded-xl text-white transition">Login</button>
                        </div>
                    </form>
                    <p class="text-sm text-gray-600 text-center mt-5">&copy; Copyright 2022 by RINGGA.ID</p>
                </div>
            </div>
            <div class="hidden sm:block flex-1 overflow-hidden">
                <img src="{{ asset('images/login-bg.webp') }}" alt="login background" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
@endsection
