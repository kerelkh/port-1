<div id="support-detail" class="text-xs sm:text-sm md:text-base detail mt-5" style="display:none">
    <table id="table-support" class="text-sm display overflow-scroll" data-url="{{ route('get-supports') }}" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>URL</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class=" text-gray-700">
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        let tableSupport = $('#table-support').DataTable({
            ajax: $("#table-support").data('url'),
            columns: [
                { data: 'name'},
                { data: 'url' },
                { data: 'edit'}
            ]
        })
    })

    $(document).on('click', '.support-delete-btn', function(e) {
        let url = window.location.origin + '/content/support-delete/' + $(this).data('support');
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
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                    }).done(function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Deleted',
                        }).then(function() {
                            $('#table-support').DataTable().ajax.reload();
                        });
                    }).fail(function(data){
                        Swal.fire({
                            icon: 'error',
                            title: data.responseJSON.status,
                            text: data.responseJSON.message,
                        })
                    });
                }
            })
    })
</script>
