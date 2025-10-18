<?php

namespace App\Http\Controllers;

use App\Http\Requests\books\StoreBooksRequest;
use App\Http\Requests\books\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, DB $database)
    {
        $search = $request->input('search');

        $books = $database::table('books')

            // Apply search filter if provided
            ->when($search, function ($query, $search) {
                return $query->where('books.title', 'like', '%' . $search . '%')
                    ->orWhere('books.author', 'like', '%' . $search . '%')
                    ->orWhere('books.publisher', 'like', '%' . $search . '%');
            })
            ->select('books.id', 'books.title', 'books.author', 'books.publisher', 'books.publication_year', 'books.stock', 'books.isbn', 'categories.name as category_name')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->paginate(10)
            ->appends(['search' => $search]);

        return view("books.index", compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(DB $database): View
    {

        // Get all categories for the dropdown
        $categories = $database::table('categories')->select('id', 'name')->get();

        // This method can be used to show a form for creating a new book
        return view('books.create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBooksRequest $bookRequest, DB $database)
    {
        // Validate the request
        $validatedData = $bookRequest->validated();

        // Insert the book into the database
        $database::table('books')->insert([
            'title' => $validatedData['title'],
            'author' => $validatedData['author'],
            'publisher' => $validatedData['publisher'],
            'publication_year' => $validatedData['publication_year'],
            'category_id' => $validatedData['category_id'],
            'stock' => $validatedData['stock'],
            'isbn' => $validatedData['isbn'] ?? null,
        ]);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan');
    }
    /**
     * Display the specified resource.
     */
    public function show(Book $book) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book, DB $database): View
    {
        // get all categories for the dropdown
        $categories = $database::table('categories')->select('id', 'name')->get();

        return view("books.edit", compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        // Validate the request
        $validatedDataUpdate = $request->validated();

        // Update the book in the database
        $book->update([
            'title' => $validatedDataUpdate['title'],
            'author' => $validatedDataUpdate['author'],
            'publisher' => $validatedDataUpdate['publisher'],
            'publication_year' => $validatedDataUpdate['publication_year'],
            'category_id' => $validatedDataUpdate['category_id'],
            'stock' => $validatedDataUpdate['stock'],
            'isbn' => $validatedDataUpdate['isbn'] ?? null,
        ]);

        return redirect()->route('books.index')->with('success', 'Buku berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DB $database, int $BookID)
    {
        // Validate the ID
        if (!is_numeric($BookID) || $BookID <= 0) {
            return redirect()->route('books.index')->with('error', 'Kesalahan data');
        }

        // Check if the book exists
        $book = $database::table('books')->where('id', $BookID);

        if (!$book->first()) {
            return redirect()->route('books.index')->with('error', 'Buku tidak tersedia');
        }

        $book->delete();

        return redirect()->route("books.index")->with('success', 'Buku berhasil di hapus');
    }
}
