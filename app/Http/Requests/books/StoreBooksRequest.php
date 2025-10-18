<?php

namespace App\Http\Requests\books;

use Illuminate\Foundation\Http\FormRequest;

class StoreBooksRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:10|max:100',
            'author' => 'required|string|min:5|max:255',
            'publisher' => 'required|string|min:4|max:255',
            'publication_year' => 'required|integer|digits:4|min:1900|max:' . date('Y'),
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'isbn' => 'nullable|string|unique:books,isbn|regex:/^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$/',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // Title messages
            'title.required' => 'Judul buku wajib diisi.',
            'title.string' => 'Judul buku harus berupa teks.',
            'title.max' => 'Judul buku maksimal 255 karakter.',

            // Author messages
            'author.required' => 'Nama pengarang wajib diisi.',
            'author.string' => 'Nama pengarang harus berupa teks.',
            'author.max' => 'Nama pengarang maksimal 255 karakter.',

            // Publisher messages
            'publisher.required' => 'Nama penerbit wajib diisi.',
            'publisher.string' => 'Nama penerbit harus berupa teks.',
            'publisher.max' => 'Nama penerbit maksimal 255 karakter.',
            'publisher.min' => 'Nama penerbit minimal 4 karakter.',

            // Publication Year messages
            'publication_year.required' => 'Tahun terbit wajib diisi.',
            'publication_year.integer' => 'Tahun terbit harus berupa angka.',
            'publication_year.digits' => 'Tahun terbit harus 4 digit.',
            'publication_year.min' => 'Tahun terbit minimal 1900.',
            'publication_year.max' => 'Tahun terbit tidak boleh melebihi tahun sekarang.',

            // Category messages
            'category_id.required' => 'Kategori buku wajib diisi.',
            'category_id.string' => 'Kategori buku harus berupa teks.',
            'category_id.max' => 'Kategori buku maksimal 100 karakter.',

            // Stock messages
            'stock.required' => 'Jumlah stok wajib diisi.',
            'stock.integer' => 'Jumlah stok harus berupa angka.',
            'stock.min' => 'Jumlah stok tidak boleh kurang dari 0.',

            // ISBN messages
            'isbn.string' => 'Nomor ISBN harus berupa teks.',
            'isbn.unique' => 'Nomor ISBN sudah terdaftar di sistem.',
            'isbn.regex' => 'Format nomor ISBN tidak valid. Harus 10 atau 13 digit.',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title' => 'judul buku',
            'author' => 'pengarang',
            'publisher' => 'penerbit',
            'publication_year' => 'tahun terbit',
            'category_id' => 'kategori',
            'stock' => 'stok',
            'isbn' => 'ISBN',
        ];
    }
}
