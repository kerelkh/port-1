@extends('admin.index')

@section('admin-content')
<div class="p-2 mb-10">
    <h1 class="font-medium text-2xl border-b text-gray-800 font-serif mb-10">New Article.</h1>
    @if(session('store-article-message'))
    <x-message-notice type="message" value="{{ session('store-article-message') }}"></x-message-notice>
    @endif
    @if(session('store-article-error'))
    <x-message-notice type="error" value="{{ session('store-article-error') }}"></x-message-notice>
    @endif
    <form action="{{ route('store-article') }}" method="POST" enctype="multipart/form-data" id="form-create-article">
        @csrf
        <div class="mb-5 w-1/3">
            <label for="type" class="sr-only">Type</label>
            <select id="type"  name="type" class="block py-2.5 px-0 w-full text-sm text-gray-800 bg-transparent border-0 border-b-2 font-medium border-gray-500 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer" required>
                <option value="article" selected>Article</option>
                <option value="project">Project</option>
            </select>
            @error("type")
                <span class="text-sm text-red-600 italic">* {{ $message }}</span>
            @enderror
        </div>
        <div class="mb-10">
            <div class="flex gap-5">
                <div class="w-1/2 aspect-video">
                    <img src="{{ asset('images/image-placeholder.png')}}" alt="Banner temporary" id="img-temp" class="w-full object-cover">
                </div>
                <div class="flex flex-col justify-between items-start gap-5">
                    <input
                        type="file"
                        id="images"
                        name="images"
                        class="block w-full text-sm text-slate-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-violet-50 file:text-violet-700
                        hover:file:bg-violet-100"
                        onchange="onImageChange()">
                </div>
            </div>
            @error("images")
                <span class="text-sm text-red-600 italic">* {{ $message }}</span>
            @enderror
        </div>
        <div class="mb-5">
            <div class="relative z-0 mb-6 w-full group">
                <input type="text" name="title" id="title" class="block py-2.5 px-0 w-full text-gray-900 font-serif bg-transparent border-0 border-gray-300 appearance-none text-2xl focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  value="{{ old('title') }}" required />
                <label for="title" class="peer-focus:font-medium absolute text-2xl text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-sm peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Title</label>
            </div>
            @error("title")
                <span class="text-sm text-red-600 italic">* {{ $message }}</span>
            @enderror
        </div>
        <div class="mb-5">
            <div class="relative z-0 mb-6 w-full group">
                <textarea name="description" id="description" class="block py-2.5 px-0 w-full text-gray-900 bg-transparent border-0 border-gray-300 appearance-none text-lg focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " onkeyup="textAreaAdjust(this)"  required>{{ old('description') }}</textarea>
                <label for="description" class="peer-focus:font-medium absolute text-2xl text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-sm peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Description</label>
            </div>
            @error("description")
                <span class="text-sm text-red-600 italic">* {{ $message }}</span>
            @enderror
        </div>

        <div class="mb-5">
            <div class="relative z-0 mb-6 w-full group">
                <textarea name="body" id="body" placeholder=" ">{{ old('body') }}</textarea>
            </div>
            @error("body")
                <span class="text-sm text-red-600 italic">* {{ $message }}</span>
            @enderror
        </div>
        <button type='submit' class="bg-gray-800 hover:bg-gray-900 text-white text-lg py-2 px-5 rounded shadow">Save</button>
    </form>
</div>

<script>
    $(document).on('submit', '#form-create-article', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Do you want to save?',
            showCancelButton: true,
            confirmButtonText: 'Save',
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.submit();
            }
        })

    })
    function textAreaAdjust(element) {
        element.style.height = "1px";
        element.style.height = (25+element.scrollHeight)+"px";
    }

    const imgTempEl = document.getElementById('img-temp');
    const imagesEl = document.getElementById('images')

    function onImageChange() {
        let reader = new FileReader();
        if(imagesEl.files[0]){
            reader.readAsDataURL(imagesEl.files[0]);
        }

        reader.onloadend = function() {
            imgTempEl.src = reader.result;
        }
    }

    tinymce.init({
        selector: '#body'
    });
</script>
@endsection
