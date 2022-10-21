<div id="gallery-detail" class="detail mt-5">
    <table id="table-gallery" class="text-xs sm:text-sm display" data-url="{{ route('get-galleries') }}" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody class=" text-gray-700">
        </tbody>
    </table>
</div>

@include('admin.partials.gallery.detail')

<script>
    $(document).ready(function() {
        let tableQUote = $('#table-gallery').DataTable({
            ajax: $("#table-gallery").data('url'),
            columns: [
                { data: 'name'},
                { data: 'date'},
                { data: 'Detail'}
            ]
        })
    })

    $(document).on("click", '.view-photo-detail', function(e) {
        let url = window.location.origin + '/admin/gallery/' + $(this).data('photo');
        $.get({
            url: url,
            processing: true,
        }).done(function(data) {
            $('#message-notice').hide();
            $('#form-photo-update').fadeIn(100);
            $('#form-delete-gallery').fadeIn(100);
            $('#form-delete-gallery').attr('action', window.location.origin + '/admin/gallery/' + data.data.id);
            $('#update-photo_name').val(data.data.name);
            $('#img-temp-update').attr('src', window.location.origin + '/storage/' + data.data.images);
            $('#form-photo-update').attr('action', window.location.origin + '/admin/gallery/' + data.data.id);
        })
    })
</script>
