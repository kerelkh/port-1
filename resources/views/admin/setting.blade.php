@extends('admin.index')

@section('admin-content')
    <div class="p-2">
        <h1 class="text-2xl font-medium pb-2 border-b border-gray-200">Setting</h1>

        {{-- change profile --}}
        <div class="mt-5">
            <h2 class="text-lg font-medium"><i class="fa-solid fa-angles-right"></i> Change Profile</h2>
            <form action="/setting/update/profile" method="POST" class="mt-2" id="form-update-profile">
                @csrf
                @if(session('update-profile-message'))
                    <x-message-notice type="message" :value="session('update-profile-message')"></x-message-notice>
                @endif
                @if(session('update-profile-error'))
                    <x-message-notice type="error" :value="session('update-profile-error')"></x-message-notice>
                @endif
                <div class="flex items-center mb-2">
                    <label for="username" class="flex-1">Username</label>
                    <div class="flex-1 flex flex-col items-stretch">
                        <input type="text" name="username" id="username" value="{{ Auth::user()->username }}" autocomplete="off" required class="px-2 py-1 rounded-lg outline-none focus:ring-1 focus:ring-blue-400 bg-gray-200 focus:bg-white">
                        @error('username')
                            <span class="text-red-600 text-sm italic">* {{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex items-center mb-2">
                    <label for="name" class="flex-1">Name</label>
                    <div class="flex-1 flex flex-col items-stretch">
                        <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" autocomplete="off" required class="px-2 py-1 rounded-lg outline-none focus:ring-1 focus:ring-blue-400 bg-gray-200 focus:bg-white">
                        @error('name')
                            <span class="text-red-600 text-sm italic">* {{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex items-center mb-2">
                    <label for="email" class="flex-1">Email</label>
                    <div class="flex-1 flex flex-col items-stretch">
                        <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" autocomplete="off" required class="px-2 py-1 rounded-lg outline-none focus:ring-1 focus:ring-blue-400 bg-gray-200 focus:bg-white">
                        @error('email')
                            <span class="text-red-600 text-sm italic">* {{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex items-center mb-2 mt-8">
                    <label for="password" class="flex-1">Current Password</label>
                    <div class="flex-1 flex flex-col items-stretch">
                        <input type="password" name="password" id="password" autocomplete="off" required class="px-2 py-1 rounded-lg outline-none focus:ring-1 focus:ring-blue-400 bg-gray-200 focus:bg-white">
                        @error('password')
                            <span class="text-red-600 text-sm italic">* {{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex-1 hiden"></div>
                    <div class="flex-1">
                        <button type="submit" class="p-2 bg-blue-400 text-gray-50 rounded-xl hover:bg-blue-600">Update</button>
                    </div>
                </div>
            </div>
            </form>
        </div>

        {{-- Utility --}}
        <div class="mt-5">
            <h2 class="text-lg font-medium"><i class="fa-solid fa-angles-right"></i> Utility</h2>
            <div class="my-5">
                <p class="mt-2">Banner Landing page</p>
                @if(session('update-banner-message'))
                <x-message-notice type="message" value="{{ session('update-banner-message') }}"></x-message-notice>
                @endif
                @if(session('update-banner-error'))
                <x-message-notice type="error" value="{{ session('update-banner-error') }}"></x-message-notice>
                @endif
                <form action="/setting/update/banner" method="POST" enctype="multipart/form-data" class="flex gap-3">
                    @csrf
                    <img src="{{ asset('storage/' . $datas['landing-banner']->value) }}" alt="Banner temporary" id="img-temp" class="w-1/2 aspect-video">
                    <div class="flex flex-col justify-between items-start gap-5">
                        <input
                            type="file"
                            id="banner"
                            name="banner"
                            class="block w-full text-sm text-slate-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-violet-50 file:text-violet-700
                            hover:file:bg-violet-100"
                            onchange="onImageChange()">
                        <button type="submit" class="p-2 bg-blue-400 text-gray-50 rounded-xl hover:bg-blue-600">Update</button>

                    </div>
                </form>
            </div>
        </div>


    </div>

    <script>
        const imgTempEl = document.getElementById('img-temp');
        const bannerEl = document.getElementById('banner')

        function onImageChange() {
            let reader = new FileReader();
            if(bannerEl.files[0]){
                reader.readAsDataURL(bannerEl.files[0]);
            }

            reader.onloadend = function() {
                imgTempEl.src = reader.result;
            }
        }

        $(document).on('submit', '#form-update-profile', function(e) {
            e.preventDefault();
            Swal.fire({
            title: 'Do you want to save the changes?',
            showCancelButton: true,
            confirmButtonText: 'Save',
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit();
                }
            })
        })
    </script>

@endsection
