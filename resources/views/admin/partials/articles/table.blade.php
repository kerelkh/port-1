<div id="articles-detail" class="detail mt-5">
    <table id="table-articles" class="text-sm display" data-url="{{ route('get-articles') }}" style="width:100%">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Type</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody class=" text-gray-700">
        </tbody>
    </table>
</div>


@include('admin.partials.articles.detail')

<script>
    $(document).ready(function() {
        let tableSupport = $('#table-articles').DataTable({
            ajax: $("#table-articles").data('url'),
            columns: [
                { data: 'title' },
                { data: 'status'},
                { data: 'type' },
                { data: 'detail'}
            ]
        })
    })

    $(document).on('click', '.view-detail-article', function(e) {
        let url = window.location.origin + $(this).data('url');
        $.get({
            url: url,
            processing: true,
        }).done(function(data) {
            $('#form-delete-article').attr('action' , window.location.origin + '/admin/articles/delete/' + data.data.slug);
            $('#article-detail').fadeIn(100);
            $('#img-temp').attr('src', window.location.origin + '/storage/' + data.data.images);
            $('#title').val(data.data.title);
            $('#description').val(data.data.description);
            $('#status').val(data.data.status);
            $('#status').data('value', data.data.status);
            $('#type').val(data.data.type);
            $('#type').data('value', data.data.type);
            tinymce.activeEditor.setContent(data.data.body);
            $('#form-update-article').data('slug', data.data.slug);
        }).fail(function(data) {
            Swal.fire({
                icon: 'error',
                title: data.responseJSON.status,
                text: data.responseJSON.message,
            })
        })
    })

    // $(document).on('click', '.support-delete-btn', function(e) {
    //     let url = window.location.origin + '/content/support-delete/' + $(this).data('support');
    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: "You won't be able to revert this!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes, delete it!'
    //         }).then((result) => {
    //             if (result.isConfirmed) {
    //                 $.ajax({
    //                     url: url,
    //                     type: 'DELETE',
    //                 }).done(function(data) {
    //                     Swal.fire({
    //                         icon: 'success',
    //                         title: 'Success',
    //                         text: 'Deleted',
    //                     }).then(function() {
    //                         $('#table-articles').DataTable().ajax.reload();
    //                     });
    //                 }).fail(function(data){
    //                     Swal.fire({
    //                         icon: 'error',
    //                         title: data.responseJSON.status,
    //                         text: data.responseJSON.message,
    //                     })
    //                 });
    //             }
    //         })
    // })
</script>
