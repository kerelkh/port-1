@extends('admin.index')

@section('admin-content')
<div class="p-2">
    <h1 class="text-lg font-medium font-serif text-gray-800 mb-5">Article's Management</h1>
    <a href="{{ route('create-article') }}" class="block p-2 px-4 rounded text-white bg-gray-600 hover:bg-gray-800 w-fit mb-5"><i class="fa-solid fa-plus"></i> Add New Article</a>
    @include('admin.partials.articles.table')
</div>

@endsection
