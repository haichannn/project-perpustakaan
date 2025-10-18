@extends('layouts.app')

@section("title", "Tambah Buku")

@section("content")
<div class="mx-auto my-auto d-grid gap-4" style="max-width: 600px;">

    <h1 class="mt-5 fs-1 text-capitalize text-lead">Tambah buku</h1>

    {{-- Form tambah buku --}}

    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf

        @include('books._form', ['categories' => $categories])

    </form>
</div>
@endsection
