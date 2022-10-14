<div class="my-5 flex justify-center items-start gap-5 border-t border-gray-600 py-5">
    <div class="flex-1">
        <p class="text-lg font-serif">Add New Photo</p>
        <div class="my-5">
            @if(session('store-photo-message'))
            <x-message-notice type="message" value="{{ session('store-photo-message') }}"></x-message-notice>
            @endif
            @if(session('store-photo-error'))
            <x-message-notice type="error" value="{{ session('store-photo-error') }}"></x-message-notice>
            @endif
            <form action="/admin/gallery" method="POST" enctype="multipart/form-data" class="flex flex-col gap-5">
                @csrf
                <div class="relative z-0 mb-6 w-full group">
                    <input type="text" name="name" id="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
                    @error('name')
                    <span class="text-red-600 italic text-xs">* {{ $message }}</span>
                    @enderror
                </div>

                <img src="{{ asset('images/image-placeholder.png') }}" alt="Banner temporary" id="img-temp" class="w-1/2 aspect-video">
                <div class="flex flex-col justify-between items-start gap-5">
                    <input
                        type="file"
                        id="image"
                        name="image"
                        class="block w-full text-sm text-slate-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-violet-50 file:text-violet-700
                        hover:file:bg-violet-100"
                        onchange="onImageChange()">
                        @error('image')
                            <span class="text-red-600 italic text-xs">* {{ $message }}</span>
                        @enderror

                    <button type="submit" class="p-2 bg-blue-500 text-gray-50 rounded-xl hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
    </div>
    <div class="flex-1">
        <p class="text-lg font-serif">Detail Photo</p>
        @if(session('update-photo-message'))
        <x-message-notice type="message" value="{{ session('update-photo-message') }}"></x-message-notice>
        @endif
        @if(session('update-photo-error'))
        <x-message-notice type="error" value="{{ session('update-photo-error') }}"></x-message-notice>
        @endif
        <form action="/admin/gallery" method="POST" enctype="multipart/form-data" class="flex flex-col gap-5 my-5" style="display: none;" id="form-photo-update">
            @csrf
            <div class="relative z-0 mb-6 w-full group">
                <input type="text" name="update-photo_name" id="update-photo_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="update-photo_name" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
            </div>

            <img src="{{ asset('images/image-placeholder.png') }}" alt="Banner temporary" id="img-temp-update" class="w-1/2 aspect-video">
            <div class="flex flex-col justify-between items-start gap-5">
                <input
                    type="file"
                    id="image-update"
                    name="image-update"
                    class="block w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-violet-50 file:text-violet-700
                    hover:file:bg-violet-100"
                    onchange="onImageChangeUpdate()">
                <button type="submit" class="p-2 bg-blue-500 text-gray-50 rounded-xl hover:bg-blue-600">Update</button>
            </div>
        </form>
    </div>
</div>


<script>
    const imgTempEl = document.getElementById('img-temp');
    const bannerEl = document.getElementById('image')

    const imgTempEl2 = document.getElementById('img-temp-update');
    const bannerEl2 = document.getElementById('image-update')

    function onImageChange() {
        let reader = new FileReader();
        if(bannerEl.files[0]){
            reader.readAsDataURL(bannerEl.files[0]);
        }

        reader.onloadend = function() {
            imgTempEl.src = reader.result;
        }
    }

    function onImageChangeUpdate() {
        let reader = new FileReader();
        if(bannerEl2.files[0]){
            reader.readAsDataURL(bannerEl2.files[0]);
        }

        reader.onloadend = function() {
            imgTempEl2.src = reader.result;
        }
    }

    $(document).on('submit', '#form-photo-update' , function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            showCancelButton: true,
            confirmButtonText: 'Save',
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.submit();
            }
        })
    })
</script>
