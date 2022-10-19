@extends('admin.index')

@section('admin-content')
<div class="p-2">
    <h1 class="text-lg font-medium font-serif text-gray-800 mb-5">Product's Management</h1>
    @if(session('update-image-product-message'))
    <x-message-notice type="message" value="{{ session('update-image-product-message') }}"></x-message-notice>
    @endif
    @if(session('update-image-product-error'))
    <x-message-notice type="error" value="{{ session('update-image-product-error') }}"></x-message-notice>
    @endif
    @if(session('session-product-message'))
    <x-message-notice type="message" value="{{ session('session-product-message') }}"></x-message-notice>
    @endif
    @if(session('session-product-error'))
    <x-message-notice type="error" value="{{ session('session-product-error') }}"></x-message-notice>
    @endif
    <a href="{{ route('create-product') }}" class="block p-2 px-4 rounded text-white bg-gray-600 hover:bg-gray-800 w-fit mb-5"><i class="fa-solid fa-plus"></i> Add New Product</a>
    @include('admin.partials.product.table')
</div>

@endsection
