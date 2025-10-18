<div>
    <div class="mb-3">
        <x-input
            name="title"
            label="Judul"
            :value="old('title', $book->title ?? '')" />
    </div>

    <div class="mb-3">
        <x-input
            name="author"
            label="Penulis"
            :value="old('author', $book->author ?? '')" />
    </div>

    <div class="mb-3">
        <x-input
            name="publisher"
            label="Penerbit"
            :value="old('publisher', $book->publisher ?? '')" />
    </div>

    <div class="mb-3">
        <x-input
            type="number"
            name="publication_year"
            label="Tahun Terbit"
            min="1900"
            :max="date('Y')"
            :value="old('publication_year', $book->publication_year ?? '')" />
    </div>

    <div class="mb-3">
        <x-input
            type="number"
            name="stock"
            label="Jumlah Stok"
            min="1"
            max="1000"
            :value="old('stock', $book->stock ?? '')" />
    </div>


    <div class="mb-3">
        <label for="category_id" class="form-label">Kategori</label>
        <select
            class="form-select @error('category_id') is-invalid @enderror"
            id="category_id"
            name="category_id">

            {{-- jika tidak ada kategori --}}
            <option value="" selected disabled>Pilih kategori</option>

            @foreach ($categories as $category)

            {{-- mempertahankan kategori yang dipilih sebelumnya --}}
            <option
                value="{{ $category->id }}"
                @selected(old('category_id', $book->category_id ?? '')==$category->id)
                >
                {{ $category->name }}
            </option>

            @endforeach

        </select>

        @error('category_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <x-input
            name="isbn"
            label="ISBN"
            :value="old('isbn', $book->isbn ?? '')" />
    </div>

    <div>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </div>


</div>
