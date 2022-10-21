@extends('admin.index')

@section('admin-content')
<div class="p-2">
    <h1 class="text-lg font-medium font-serif text-gray-800 mb-5 border-b">New Product.</h1>
    @if(session('store-product-message'))
    <x-message-notice type="message" value="{{ session('store-product-message') }}"></x-message-notice>
    @endif
    @if(session('store-product-error'))
    <x-message-notice type="error" value="{{ session('store-product-error') }}"></x-message-notice>
    @endif
    <form action="{{ route('store-product') }}" method="POST" enctype="multipart/form-data" id="form-create-product">
        @csrf
        <div class="mb-10">
            <div class="flex flex-col sm:flex-row gap-5">
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
                <input type="text" name="name" id="name" class="block py-2.5 px-0 w-full text-gray-900 font-serif bg-transparent border-0 border-gray-300 appearance-none text-2xl focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  value="{{ old('name') }}" required />
                <label for="name" class="peer-focus:font-medium absolute text-2xl text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-sm peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">name</label>
            </div>
            @error("name")
                <span class="text-sm text-red-600 italic">* {{ $message }}</span>
            @enderror
        </div>
        <div class="mb-5">
            <div class="relative z-0 mb-6 w-full group">
                <input type="text" name="price" id="price" class="block py-2.5 px-0 w-full text-gray-900 bg-transparent border-0 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  value="{{ old('price') }}" required />
                <label for="price" class="peer-focus:font-medium absolute text-2xl text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-sm peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">price</label>
            </div>
            @error("price")
                <span class="text-sm text-red-600 italic">* {{ $message }}</span>
            @enderror
        </div>
        <div class="mb-5">
            <div class="relative z-0 mb-6 w-full group">
                <input type="text" name="unit" id="unit" class="block py-2.5 px-0 w-full text-gray-900 bg-transparent border-0 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  value="{{ old('unit') }}" required />
                <label for="unit" class="peer-focus:font-medium absolute text-2xl text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-sm peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">unit</label>
            </div>
            @error("unit")
                <span class="text-sm text-red-600 italic">* {{ $message }}</span>
            @enderror
        </div>
        <div class="mb-5">
            <div class="relative z-0 mb-6 w-full group">
                <input type="number" name="stock" id="stock" class="block py-2.5 px-0 w-full text-gray-900 bg-transparent border-0 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  value="{{ old('stock') }}" required />
                <label for="stock" class="peer-focus:font-medium absolute text-2xl text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-sm peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">stock</label>
            </div>
            @error("stock")
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
    $(document).on('submit', '#form-create-product', function(e) {
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
