@extends("layouts.app")

@section("title", "Edit Buku")

@section("content")
<div class="mx-auto my-auto d-grid gap-4" style="max-width: 600px;">

    <h1 class="mt-5 fs-1 text-capitalize text-lead">Edit buku</h1>

    {{-- Form Edit buku --}}

    <form action="{{ route('books.update', $book->id) }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf

        @method('PUT')

        @include('books._form', ['categories' => $categories, 'book' => $book])

    </form>
</div>
@endsection
