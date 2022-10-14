<div id="article-detail" class="my-10 py-5" style="display:none">
    <div class="flex justify-between items-center mb-10">
        <h2 class="text-lg text-gray-800 font-medium"><i class='fa-solid fa-circle-info mb-5'></i> Detail</h2>
        <div class="w-1/2 flex justify-center items-center gap-5">
            <div class="w-1/2">
                <label for="status" class="sr-only">Status</label>
                <select id="status" data-value='' data-url="/admin/articles/updateStatusArticle/" name="status" class="block py-2.5 px-0 w-full text-sm text-gray-800 bg-transparent border-0 border-b-2 font-medium border-gray-800 appearance-none focus:outline-none focus:ring-0 peer">
                    <option value="draft">Draft</option>
                    <option value="publish">Publish</option>
                </select>
            </div>
            <div class="w-1/2">
                <label for="type" class="sr-only">Type</label>
                <select id="type" data-value='' data-url="/admin/articles/updateTypeArticle/" name="type" class="block py-2.5 px-0 w-full text-sm text-gray-800 bg-transparent border-0 border-b-2 font-medium border-gray-800 appearance-none focus:outline-none focus:ring-0 peer">
                    <option value="article">Article</option>
                    <option value="project">Project</option>
                </select>
            </div>
        </div>
    </div>
    <form action="/admin/articles/updateArticle/" method="POST" data-slug='' enctype="multipart/form-data" id="form-update-article">
        @csrf
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
            <div id="message-images"></div>
        </div>
        <div class="mb-5">
            <div class="relative z-0 mb-6 w-full group">
                <input type="text" name="title" id="title" class="block py-2.5 px-0 w-full text-gray-900 font-serif bg-transparent border-0 border-gray-300 appearance-none text-2xl focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="title" class="peer-focus:font-medium absolute text-2xl text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-sm peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Title</label>
            </div>
            <div id="message-title"></div>
        </div>
        <div class="mb-5">
            <div class="relative z-0 mb-6 w-full group">
                <textarea name="description" id="description" class="block py-2.5 px-0 w-full text-gray-900 bg-transparent border-0 border-gray-300 appearance-none text-lg focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " onkeyup="textAreaAdjust(this)"  required></textarea>
                <label for="description" class="peer-focus:font-medium absolute text-2xl text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-sm peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Description</label>
            </div>
            <div id="message-description"></div>
        </div>

        <div class="mb-5">
            <div class="relative z-0 mb-6 w-full group">
                <textarea name="body" id="body" placeholder=" " value="{{ old('body') }}"></textarea>
            </div>
            <div id="message-body"></div>
        </div>
        <button type='submit' class="bg-gray-800 hover:bg-gray-900 text-white text-lg py-2 px-5 rounded shadow">Update Article</button>
    </form>
</div>

<script>
    $(document).ready(function(){
        $('#status').on('change', function(e) {
            let url = window.location.origin + $(this).data('url') + $('#form-update-article').data('slug') + '/' + $(this).val();
            Swal.fire({
                title: 'Are you sure?',
                showCancelButton: true,
                confirmButtonText: 'Save',
            }).then((result) => {
                if(result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'PUT',
                    }).done(function(data) {
                            Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Status Update to ' + $('#status').val()  ,
                        }).then(function() {
                            location.reload();
                        });
                    }).fail(function(data) {
                        if(data.status == 422) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Incorrect input',
                                text: 'Your input is incorrect!',
                            });
                            let errors = data.responseJSON.errors;
                            for(let e in errors){
                                $('#message-' + e).append(`<span class="text-red-600 text-xs italic">${errors[e]}</span>`);
                            }
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: data.responseJSON.status,
                                text: data.responseJSON.message,
                            })
                        }
                    })
                }else{
                    $('#status').val($(this).data('value'));
                }
             })
        })

        $('#type').on('change', function(e) {
            let url = window.location.origin + $(this).data('url') + $('#form-update-article').data('slug') + '/' + $(this).val();
            Swal.fire({
                title: 'Are you sure?',
                showCancelButton: true,
                confirmButtonText: 'Save',
            }).then((result) => {
                if(result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'PUT',
                    }).done(function(data) {
                            Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Type Update to ' + $('#type').val()  ,
                        }).then(function() {
                            location.reload();
                        });
                    }).fail(function(data) {
                        if(data.status == 422) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Incorrect input',
                                text: 'Your input is incorrect!',
                            });
                            let errors = data.responseJSON.errors;
                            for(let e in errors){
                                $('#message-' + e).append(`<span class="text-red-600 text-xs italic">${errors[e]}</span>`);
                            }
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: data.responseJSON.status,
                                text: data.responseJSON.message,
                            })
                        }
                    })
                }else{
                    $('#type').val($(this).data('value'));
                }
             })
        })
    })
    $(document).on('submit', '#form-update-article', function(e) {
        e.preventDefault();
        let url = window.location.origin + $(this).attr('action') + $(this).data('slug');
        Swal.fire({
            title: 'Are you sure?',
            showCancelButton: true,
            confirmButtonText: 'Save',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $('#message-images').html('');
                $('#message-title').html('');
                $('#message-description').html('');
                $('#message-body').html('');

                let formData = new FormData();
                formData.append('title', $('#title').val());
                formData.append('description', $('#description').val());
                formData.append('body', $('#body').val());
                if($('#images').val()){
                    formData.append('images', $("#images")[0].files[0]);
                }
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    contentType: false,
                    processData: false,
                }).done(function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'UPDATED.',
                    }).then(function() {
                        location.reload();
                    });
                }).fail(function(data){
                    // $('#loading').fadeOut(300);
                    // console.log(data.responseJSON.message);
                    if(data.status == 422) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Incorrect input',
                            text: 'Your input is incorrect!',
                        });
                        let errors = data.responseJSON.errors;
                        for(let e in errors){
                            $('#message-' + e).append(`<span class="text-red-600 text-xs italic">${errors[e]}</span>`);
                        }
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: data.responseJSON.status,
                            text: data.responseJSON.message,
                        })
                    }

                });
            }});
    });

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
