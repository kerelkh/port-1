<div id="referral-detail" class="text-xs sm:text-sm md:text-base detail mt-5" style="display:none">
    <table id="table-referral" class="text-sm display w-full" data-url="{{ route('get-referrals') }}" style="width:100%">
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
        let tableReferral = $('#table-referral').DataTable({
            ajax: $("#table-referral").data('url'),
            columns: [
                { data: 'name'},
                { data: 'url' },
                { data: 'edit'}
            ]
        })
    })

    $(document).on('click', '.referral-delete-btn', function(e) {
        let url = window.location.origin + '/content/referral-delete/' + $(this).data('referral');
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
                            $('#table-referral').DataTable().ajax.reload();
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
