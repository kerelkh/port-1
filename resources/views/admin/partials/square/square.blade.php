<div id="square-detail" class="detail mt-5" style="display:none">
    @if(session('update-banner-square-message'))
    <x-message-notice type="message" value="{{ session('update-banner-square-message') }}"></x-message-notice>
    @endif
    @if(session('update-banner-square-error'))
    <x-message-notice type="error" value="{{ session('update-banner-square-error') }}"></x-message-notice>
    @endif
    <div class="flex flex-col sm:flex-row items-start my-5 gap-5">
        <div class="flex-1">
            <p class="mt-2">Banner Square 1</p>
            <form action="/content/square/1" method="POST" enctype="multipart/form-data" class="form-square gap-3">
                @csrf
                @if($datas['square'][0]->images != '' || $datas['square'][0]->images != NULL)
                <img src="{{ asset('storage/' . $datas['square'][0]->images) }}" alt="Banner temporary" id="img-temp-square" class="w-full">
                @else
                <img src="{{ asset('images/image-placeholder.png') }}" alt="Banner temporary" id="img-temp-square" class="w-full">
                @endif
                <div class="flex flex-col items-start gap-5 mt-5">
                    <input
                        type="file"
                        id="banner-square"
                        name="banner"
                        class="block w-full text-sm text-slate-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-violet-50 file:text-violet-700
                        hover:file:bg-violet-100"
                        required
                        onchange="onImageChangeSquare(1)">
                    <button type="submit" class="p-2 bg-blue-500 text-gray-50 rounded-xl hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
        <div class="flex-1">
            <p class="mt-2">Banner Square 2</p>
            <form action="/content/square/2" method="POST" enctype="multipart/form-data" class="form-square gap-3">
                @csrf
                @if($datas['square'][1]->images != '' || $datas['square'][1]->images != NULL)
                <img src="{{ asset('storage/' . $datas['square'][1]->images) }}" alt="Banner temporary" id="img-temp-square-2" class="w-full">
                @else
                <img src="{{ asset('images/image-placeholder.png') }}" alt="Banner temporary" id="img-temp-square-2" class="w-full">
                @endif
                <div class="flex flex-col items-start gap-5 mt-5">
                    <input
                        type="file"
                        id="banner-square-2"
                        name="banner"
                        class="block w-full text-sm text-slate-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-violet-50 file:text-violet-700
                        hover:file:bg-violet-100"
                        required
                        onchange="onImageChangeSquare(2)">
                    <button type="submit" class="p-2 bg-blue-500 text-gray-50 rounded-xl hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
        <div class="flex-1">
            <p class="mt-2">Banner Square 3</p>
            <form action="/content/square/3" method="POST" enctype="multipart/form-data" class="form-square gap-3">
                @csrf
                @if($datas['square'][2]->images != '' || $datas['square'][2]->images != NULL)
                <img src="{{ asset('storage/' . $datas['square'][2]->images) }}" alt="Banner temporary" id="img-temp-square-3" class="w-full">
                @else
                <img src="{{ asset('images/image-placeholder.png') }}" alt="Banner temporary" id="img-temp-square-3" class="w-full">
                @endif
                <div class="flex flex-col items-start gap-5 mt-5">
                    <input
                        type="file"
                        id="banner-square-3"
                        name="banner"
                        class="block w-full text-sm text-slate-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-violet-50 file:text-violet-700
                        hover:file:bg-violet-100"
                        required
                        onchange="onImageChangeSquare(3)">
                    <button type="submit" class="p-2 bg-blue-500 text-gray-50 rounded-xl hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
    </div>
    <div class="flex flex-col sm:flex-row items-start my-5 gap-5">
        <div class="flex-1">
            <p class="mt-2">Banner Square 4</p>
            <form action="/content/square/4" method="POST" enctype="multipart/form-data" class="form-square gap-3">
                @csrf
                @if($datas['square'][3]->images != '' || $datas['square'][3]->images != NULL)
                <img src="{{ asset('storage/' . $datas['square'][3]->images) }}" alt="Banner temporary" id="img-temp-square-4" class="w-full">
                @else
                <img src="{{ asset('images/image-placeholder.png') }}" alt="Banner temporary" id="img-temp-square-4" class="w-full">
                @endif
                <div class="flex flex-col items-start gap-5 mt-5">
                    <input
                        type="file"
                        id="banner-square-4"
                        name="banner"
                        class="block w-full text-sm text-slate-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-violet-50 file:text-violet-700
                        hover:file:bg-violet-100"
                        required
                        onchange="onImageChangeSquare(4)">
                    <button type="submit" class="p-2 bg-blue-500 text-gray-50 rounded-xl hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
        <div class="flex-1">
            <p class="mt-2">Banner Square 5</p>
            <form action="/content/square/5" method="POST" enctype="multipart/form-data" class="form-square gap-3">
                @csrf
                @if($datas['square'][4]->images != '' || $datas['square'][4]->images != NULL)
                <img src="{{ asset('storage/' . $datas['square'][4]->images) }}" alt="Banner temporary" id="img-temp-square-5" class="w-full">
                @else
                <img src="{{ asset('images/image-placeholder.png') }}" alt="Banner temporary" id="img-temp-square-5" class="w-full">
                @endif
                <div class="flex flex-col items-start gap-5 mt-5">
                    <input
                        type="file"
                        id="banner-square-5"
                        name="banner"
                        class="block w-full text-sm text-slate-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-violet-50 file:text-violet-700
                        hover:file:bg-violet-100"
                        required
                        onchange="onImageChangeSquare(5)">
                    <button type="submit" class="p-2 bg-blue-500 text-gray-50 rounded-xl hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
        <div class="flex-1">
            <p class="mt-2">Banner Square 6</p>
            <form action="/content/square/6" method="POST" enctype="multipart/form-data" class="form-square gap-3">
                @csrf
                @if($datas['square'][5]->images != '' || $datas['square'][5]->images != NULL)
                <img src="{{ asset('storage/' . $datas['square'][5]->images) }}" alt="Banner temporary" id="img-temp-square-6" class="w-full">
                @else
                <img src="{{ asset('images/image-placeholder.png') }}" alt="Banner temporary" id="img-temp-square-6" class="w-full">
                @endif
                <div class="flex flex-col items-start gap-5 mt-5">
                    <input
                        type="file"
                        id="banner-square-6"
                        name="banner"
                        class="block w-full text-sm text-slate-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-violet-50 file:text-violet-700
                        hover:file:bg-violet-100"
                        required
                        onchange="onImageChangeSquare(6)">
                    <button type="submit" class="p-2 bg-blue-500 text-gray-50 rounded-xl hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const imgTempSquareEl = document.getElementById('img-temp-square');
    const bannerElSquare = document.getElementById('banner-square');

    const imgTempSquareEl2 = document.getElementById('img-temp-square-2');
    const bannerElSquare2 = document.getElementById('banner-square-2');

    const imgTempSquareEl3 = document.getElementById('img-temp-square-3');
    const bannerElSquare3 = document.getElementById('banner-square-3');

    const imgTempSquareEl4 = document.getElementById('img-temp-square-4');
    const bannerElSquare4 = document.getElementById('banner-square-4')

    const imgTempSquareEl5 = document.getElementById('img-temp-square-5');
    const bannerElSquare5 = document.getElementById('banner-square-5')

    const imgTempSquareEl6 = document.getElementById('img-temp-square-6');
    const bannerElSquare6 = document.getElementById('banner-square-6')

    function onImageChangeSquare(i) {
        if(i == 1) {
            let reader = new FileReader();
            if(bannerElSquare.files[0]){
                reader.readAsDataURL(bannerElSquare.files[0]);
            }

            reader.onloadend = function() {
                imgTempSquareEl.src = reader.result;
            }
        }else if(i == 2){
            let reader = new FileReader();
            if(bannerElSquare2.files[0]){
                reader.readAsDataURL(bannerElSquare2.files[0]);
            }

            reader.onloadend = function() {
                imgTempSquareEl2.src = reader.result;
            }
        }else if(i == 3){
            let reader = new FileReader();
            if(bannerElSquare3.files[0]){
                reader.readAsDataURL(bannerElSquare3.files[0]);
            }

            reader.onloadend = function() {
                imgTempSquareEl3.src = reader.result;
            }
        }else if(i == 4){
            let reader = new FileReader();
            if(bannerElSquare4.files[0]){
                reader.readAsDataURL(bannerElSquare4.files[0]);
            }

            reader.onloadend = function() {
                imgTempSquareEl4.src = reader.result;
            }
        }else if(i == 5) {
            let reader = new FileReader();
            if(bannerElSquare5.files[0]){
                reader.readAsDataURL(bannerElSquare5.files[0]);
            }

            reader.onloadend = function() {
                imgTempSquareEl5.src = reader.result;
            }
        }else{
            let reader = new FileReader();
            if(bannerElSquare6.files[0]){
                reader.readAsDataURL(bannerElSquare6.files[0]);
            }

            reader.onloadend = function() {
                imgTempSquareEl6.src = reader.result;
            }
        }
    }

    $(document).on('submit', '.form-square', function(e) {
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
