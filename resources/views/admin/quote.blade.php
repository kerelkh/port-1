@extends('admin.index')

@section('admin-content')
<div class="p-2">
    <h1 class="text-lg font-medium font-serif text-gray-800 mb-5">Quote's Management</h1>
    <button type="button" data-modal-toggle="quote-modal" class="view-modal-btn bg-gray-800 text-white hover:shadow-lg transition p-2 rounded-lg text-sm md:text-base"><i class="fa-solid fa-plus"></i> Add Quote.</button>
    @include('admin.partials.quote.modal')
    @include('admin.partials.quote.table')
</div>
@endsection
