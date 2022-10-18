@extends('admin.index')

@section('admin-content')
<div class="p-2">
    <h1 class="text-2xl font-medium pb-2 border-b border-gray-200">Content</h1>
    <div class="mt-5">
        <div class="p-2 rounded-lg  bg-white shadow mb-5">
            <div class="flex justify-between">
                <button data-toggle='support-detail' data-table="table-support" class="view-btn bg-green-600 text-white hover:bg-green-800 transition p-2 rounded-lg">View Support Me.</button>
                <button type="button" data-modal-toggle="support-modal" class="view-modal-btn bg-gray-800 text-white hover:shadow-lg transition p-2 rounded-lg">Add Support Me.</button>
            </div>
            @include('admin.partials.support.support')
            @include('admin.partials.support.modal')
        </div>
        <div class="p-2 rounded-lg  bg-white shadow mb-5">
            <div class="flex justify-between">
                <button data-toggle='referral-detail' data-table="table-referral" class="view-btn bg-green-600 text-white hover:bg-green-800 transition p-2 rounded-lg ">View Referral.</button>
                <button type="button" data-modal-toggle="referral-modal" class="view-modal-btn bg-gray-800 text-white hover:shadow-lg transition p-2 rounded-lg">Add Referral.</button>
            </div>
            @include('admin.partials.referral.referral')
            @include('admin.partials.referral.modal')
        </div>
        <div class="p-2 rounded-lg  bg-white shadow mb-5">
            <div class="flex justify-between">
                <button data-toggle='portrait-detail' class="view-btn bg-green-600 text-white hover:bg-green-800 transition p-2 rounded-lg ">View Portrait Banner.</button>
            </div>
            @include('admin.partials.portrait.portrait')
        </div>
        <div class="p-2 rounded-lg  bg-white shadow mb-5">
            <div class="flex justify-between">
                <button data-toggle='square-detail' class="view-btn bg-green-600 text-white hover:bg-green-800 transition p-2 rounded-lg ">View Square Banner.</button>
            </div>
            @include('admin.partials.square.square')
        </div>
    </div>
</div>

<script>
    $(document).on('click', '.view-btn', function(e){
        $('.detail').hide();
        $('#' + $(this).data('toggle')).fadeIn(100);
        $('#' + $(this).data('table')).DataTable().ajax.reload();
    })
</script>
@endsection
