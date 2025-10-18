@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
<div class="mx-auto my-auto d-grid gap-4">
    <h1 class="mt-5"> Daftar Buku </h1>

    <section class="my-4 d-flex justify-content-between align-items-center">
        <div class="col-auto">
            <a href="{{ route('books.create') }}" class="btn btn-success">Tambah buku</a>
        </div>
        <div class="col-6">
            <form action="{{ route('books.index') }}" method="get" autocomplete="off">
                @csrf
                <x-input
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari buku berdasarkan judul, penulis atau penerbit" />
            </form>
        </div>
    </section>

    {{-- Pesan sukses --}}
    @if (session('success'))
    <x-alert type="success" :message="session('success')" />
    @endif

    {{-- Pesan gagal --}}
    @if (session('error'))
    <x-alert type="danger" :message="session('error')" />
    @endif

    <div>
        <table class="table table-hover table-bordered table-striped">

            <thead>
                <tr class="text-center align-middle">
                    <th scope="col">No.</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Penulis</th>
                    <th scope="col">Penerbit</th>
                    <!-- <th scope="col">Kategori</th> -->
                    <!-- <th scope="col">ISBN</th> -->
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>

                {{-- Ambil data buku --}}
                @foreach ($books as $book)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->publisher }}</td>
                    <!-- <td>{{ $book->category_name }}</td> -->
                    <!-- <td>{{ $book->isbn }}</td> -->

                    <td class="col-auto text-center">
                        <div class="d-flex justify-content-center gap-2">


                            {{-- Comming soon --}}
                            <!-- <a href="#" class="btn btn-primary">Show</a> -->

                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Hapus
                            </button>

                            {{-- Modal konfirmasi hapus --}}
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="fs-4 text-capitalize" id="exampleModalLabel">Berbahaya</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-lead">Apakah Anda yakin ingin menghapus buku ini?</p>
                                            <p class="text-danger fw-bold">Data yang sudah dihapus tidak dapat dikembalikan.</p>
                                        </div>
                                        <form action="{{ route('books.destroy', $book->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Konfirmasi</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary">Edit</a>
                        </div>
                    </td>
                </tr>
                @endforeach


                {{-- Jika tidak ada data buku --}}
                @if ($books->isEmpty())
                <tr>
                    <td colspan="7" class="text-center fs-4 fw-normal m-5">Buku tidak tersedia</td>
                </tr>
                @endif
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="row mt-5">
            <div>
                {{ $books->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
