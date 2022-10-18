<div id="portrait-detail" class="detail mt-5" style="display:none">
    @if(session('update-banner-message'))
    <x-message-notice type="message" value="{{ session('update-banner-message') }}"></x-message-notice>
    @endif
    @if(session('update-banner-error'))
    <x-message-notice type="error" value="{{ session('update-banner-error') }}"></x-message-notice>
    @endif
    <div class="flex items-start my-5 gap-5">
        <div class="flex-1">
            <p class="mt-2">Banner Portrait 1</p>
            <form action="/content/portrait/1" method="POST" enctype="multipart/form-data" class="form-portrait flex gap-3">
                @csrf
                @if($datas['portrait'][0]->images != '' || $datas['portrait'][0]->images != NULL)
                <img src="{{ asset('storage/' . $datas['portrait'][0]->images) }}" alt="Banner temporary" id="img-temp" class="w-1/2">
                @else
                <img src="{{ asset('images/image-placeholder.png') }}" alt="Banner temporary" id="img-temp" class="w-1/2">
                @endif

                <div class="flex flex-col items-start gap-5">
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
                        required
                        onchange="onImageChange(1)">
                    <button type="submit" class="p-2 bg-blue-500 text-gray-50 rounded-xl hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
        <div class="flex-1">
            <p class="mt-2">Banner Portrait 2</p>
            <form action="/content/portrait/2" method="POST" enctype="multipart/form-data" class="form-portrait flex gap-3">
                @csrf
                @if($datas['portrait'][1]->images != '' || $datas['portrait'][1]->images != NULL)
                <img src="{{ asset('storage/' . $datas['portrait'][1]->images) }}" alt="Banner temporary" id="img-temp-2" class="w-1/2">
                @else
                <img src="{{ asset('images/image-placeholder.png') }}" alt="Banner temporary" id="img-temp-2" class="w-1/2">
                @endif
                <div class="flex flex-col items-start gap-5">
                    <input
                        type="file"
                        id="banner-2"
                        name="banner"
                        class="block w-full text-sm text-slate-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-violet-50 file:text-violet-700
                        hover:file:bg-violet-100"
                        required
                        onchange="onImageChange(2)">
                    <button type="submit" class="p-2 bg-blue-500 text-gray-50 rounded-xl hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const imgTempEl = document.getElementById('img-temp');
    const bannerEl = document.getElementById('banner')

    const imgTempEl2 = document.getElementById('img-temp-2');
    const bannerEl2 = document.getElementById('banner-2')

    function onImageChange(i) {
        if(i == 1) {
            let reader = new FileReader();
            if(bannerEl.files[0]){
                reader.readAsDataURL(bannerEl.files[0]);
            }

            reader.onloadend = function() {
                imgTempEl.src = reader.result;
            }
        }else{
            let reader = new FileReader();
            if(bannerEl2.files[0]){
                reader.readAsDataURL(bannerEl2.files[0]);
            }

            reader.onloadend = function() {
                imgTempEl2.src = reader.result;
            }
        }
    }

    $(document).on('submit', '.form-portrait', function(e) {
        e.preventDefault();
        let url = window.location.origin + $(this).attr('action');
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
