<div id="products-detail" class="detail mt-5">
    <table id="table-products" class="text-sm display" data-url="{{ route('get-products') }}" style="width:100%">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody class=" text-gray-700 bg-white">
        </tbody>
    </table>
</div>


@include('admin.partials.product.detail')

<script>
    $(document).ready(function() {
        let tableSupport = $('#table-products').DataTable({
            ajax: $("#table-products").data('url'),
            columns: [
                { data: 'name' },
                { data: 'price'},
                { data: 'stock' },
                { data: 'detail'}
            ]
        })
    })

    $(document).on('click', '.view-detail-product', function(e) {
        $('#product-detail').fadeOut(100);
        let url = window.location.origin + $(this).data('url');
        $.get({
            url: url,
            processing: true,
        }).done(function(data) {
            $('#product-detail').fadeIn(100);
            $('#img-temp').attr('src', window.location.origin + '/storage/' + data.data.images);
            $('#form-update-image-product').attr('action', window.location.origin + '/admin/products/update-image/' + data.data.slug);
            $('#form-update-product').attr('action', window.location.origin + '/admin/products/update/' + data.data.slug);
            $('#form-delete-product').attr('action', window.location.origin + '/admin/products/delete/' +  data.data.slug);
            $('#name').val(data.data.name);
            $('#price').val(data.data.price);
            $('#unit').val(data.data.unit);
            $('#stock').val(data.data.stock);
            tinymce.activeEditor.setContent(data.data.description);
            // $('#status').val(data.data.status);
            // $('#status').data('value', data.data.status);
            // $('#type').val(data.data.type);
            // $('#type').data('value', data.data.type);
            // $('#form-update-article').data('slug', data.data.slug);
        }).fail(function(data) {
            Swal.fire({
                icon: 'error',
                title: data.responseJSON.status,
                text: data.responseJSON.message,
            })
        })
    })
</script>
