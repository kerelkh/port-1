<div id="product-detail" class="my-5" style="display: none;">
    <div class="flex justify-between items-center">
        <h2 class="text-lg text-gray-800 font-medium"><i class='fa-solid fa-circle-info mb-5'></i> Detail</h2>
        <form action="" method="POST" id="form-delete-product">
            @csrf
            @method('DELETE')
            <button type="submit" class="py-2 px-4 bg-red-500 hover:bg-red-600 text-white shadow rounded-lg">DELETE</button>
        </form>
    </div>
    <div class="flex my-5 gap-5">
        <div class="flex-1">
            <form action="" method="POST" enctype="multipart/form-data" id="form-update-image-product">
                @csrf
                @method('PUT')
                <div>
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
                                onchange="onImageChange()"
                                required>
                        </div>
                    </div>
                    @error("images")
                        <span class="text-sm text-red-600 italic">* {{ $message }}</span>
                    @enderror
                </div>
                <button type='submit' class="mt-5 bg-gray-600 hover:bg-gray-900 text-white py-2 px-5 rounded shadow">Update Image</button>
            </form>
        </div>
        <div class="flex-1">
            <form action="" method="POST" id="form-update-product">
                @csrf
                <div class="relative z-0 mb-6 w-full group">
                    <input type="text" name="name" id="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" required />
                    <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
                    <div id="message-update_name"></div>
                </div>
                <div class="relative z-0 mb-6 w-full group">
                    <input type="text" name="price" id="price" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" required />
                    <label for="price" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">price</label>
                    <div id="message-update_price"></div>
                </div>
                <div class="relative z-0 mb-6 w-full group">
                    <input type="text" name="unit" id="unit" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" required />
                    <label for="unit" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">unit</label>
                    <div id="message-update_unit"></div>
                </div>
                <div class="relative z-0 mb-6 w-full group">
                    <input type="number" name="stock" id="stock" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" required />
                    <label for="stock" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">stock</label>
                    <div id="message-update_stock"></div>
                </div>
                <div class="relative z-0 mb-6 w-full group">
                    <textarea name="body" id="body" placeholder=" ">{{ old('body') }}</textarea>
                    <div id="message-update_body"></div>
                </div>
                <button type='submit' class="mt-5 bg-gray-600 hover:bg-gray-900 text-white py-2 px-5 rounded shadow">Update Product</button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).on('submit', '#form-update-image-product', function(e) {
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

    $(document).on('submit', '#form-delete-product', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.submit();
            }
        })
    })

    $(document).on('submit', '#form-update-product', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Do you want to save?',
            showCancelButton: true,
            confirmButtonText: 'Save',
        }).then((result) => {
            if (result.isConfirmed) {
                let data = {
                    'name': $('#name').val(),
                    'price': $('#price').val(),
                    'unit': $('#unit').val(),
                    'stock': $('#stock').val(),
                    'body': $('#body').val(),
                };
                $('#message-update_name').html("");
                $('#message-update_price').html("");
                $('#message-update_unit').html("");
                $('#message-update_stock').html("");
                $('#message-update_body').html("");

                $.post({
                    url: $(this).attr('action'),
                    data: data,
                    processing: true,
                }).done(function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success.',
                        text: 'Update Success',
                    }).then(function() {
                        $('#table-products').DataTable().ajax.reload();
                    });
                }).fail(function(data){
                    if(data.status == 422) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Incorrect input',
                            text: 'Your input is incorrect!',
                        });
                        let errors = data.responseJSON.errors;
                        for(let e in errors){
                            $('#message-update_' + e).append(`<span class="text-red-600 text-xs italic">${errors[e]}</span>`);
                        }
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: data.responseJSON.status,
                            text: data.responseJSON.message,
                        })
                    }

                });
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
