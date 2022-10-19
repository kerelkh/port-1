@extends('admin.index')

@section('admin-content')
<div class="p-2">
    <h1 class="text-2xl font-medium pb-2 border-b border-gray-200">Gallery</h1>
    @if(session('session-gallery-message'))
    <x-message-notice type="message" value="{{ session('session-gallery-message') }}"></x-message-notice>
    @endif
    @if(session('session-gallery-error'))
    <x-message-notice type="error" value="{{ session('session-gallery-error') }}"></x-message-notice>
    @endif
    @include('admin.partials.gallery.table')

</div>

@endsection
