<!-- Main modal -->
<div id="quote-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex justify-between items-start p-4 rounded-t border-b ">
                <h3 class="text-xl font-semibold text-gray-900 ">
                    Add New Quote
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="quote-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('store-quote') }}" method="POST" id="form-quote">
            <div class="p-6 space-y-6">
                <!-- content -->
                    @csrf
                    <div class="gap-5">
                        <div class="relative z-0 mb-6 w-full group">
                            <input type="text" name="quote_quote" id="quote_quote" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="quote_quote" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Quote</label>
                            <div id="message-quote_quote"></div>
                        </div>
                        <div class="relative z-0 mb-6 w-full group">
                            <input type="text" name="quote_name" id="quote_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="quote_name" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
                            <div id="message-quote_name"></div>
                        </div>
                    </div>
            </div>
            <!-- Modal footer -->
            <div class="flex justify-end items-center p-6 space-x-2 rounded-b border-t border-gray-200 ">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Add New Quote</button>
                <button data-modal-toggle="quote-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancel</button>
            </div>
        </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#form-quote').on('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                showCancelButton: true,
                confirmButtonText: 'Save',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#message-quote_quote').val("");
                    $('#message-quote_name').val("");
                    $.post({
                        url: $(this).attr('action'),
                        data: {
                            'quote_quote': $('#quote_quote').val(),
                            'quote_name': $('#quote_name').val(),
                        },
                        processing: true,
                    }).done(function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: `${data.status}`,
                            text: `${data.message}`,
                        }).then(function() {
                            $('#table-quotes').DataTable().ajax.reload();
                            $('#quote_quote').val('');
                            $('#quote_name').val('');

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
                }
            })
        })
    })
</script>
