<div id="quotes-detail" class="detail mt-5">
    <table id="table-quotes" class="text-xs sm:text-sm display" data-url="{{ route('get-quotes') }}" style="width:100%">
        <thead>
            <tr>
                <th>Quote</th>
                <th>Name</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class=" text-gray-700">
        </tbody>
    </table>
</div>


{{-- @include('admin.partials.articles.detail') --}}

<script>
    $(document).ready(function() {
        let tableQUote = $('#table-quotes').DataTable({
            ajax: $("#table-quotes").data('url'),
            columns: [
                { data: 'quote' },
                { data: 'name'},
                { data: 'delete'}
            ]
        })
    })

    $(document).on('click', '.delete-quote-btn', function(e) {
        let url = window.location.origin + '/admin/quotes/delete/' + $(this).data('quote');
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
                        $('#table-quotes').DataTable().ajax.reload();
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
