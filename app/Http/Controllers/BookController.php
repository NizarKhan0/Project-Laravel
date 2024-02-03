<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        //kalau nak amik data dari table lain ke apa..tengok function dia kat mana?
        //contoh mcm aku punya guna modal so dia memang ada kat index je semua mcm store/edit/delete
        //jadi aku hanya perlu declare dkeat tempat mana yang nak guna data sahaja

        // Retrieve categories before validation
        $categories = Category::all();


        $books = Book::all();
        return view('admin.book.booklist', ['categories' => $categories, 'booklist' => $books]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_code' => 'required|unique:books|max:255',
            'title' => 'required|max:255',
            'categories' => 'array', // Assuming categories is an array in your form
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Add image validation rules
            //makna nya kau boleh paggil array dari form lain
        ]);

        $newName = '';
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('cover', $newName);
        }

        // Assign the new cover name to the request
        $request['cover'] = $newName;

        $book = new Book;
        $book->book_code = $request->book_code;
        $book->title = $request->title;
        $book->cover = $request->cover;

        $book->save();

        // Sync the categories
        $book->categories()->sync($request->input('categories', []));

        return redirect()->route('booklist')->with('status', 'The new book has been added successfully');
    }

    public function edit($slug)
    {

        $book = Book::with('categories')->where('slug', $slug)->first();
        $categories = Category::all();
        return view('admin.book.booklist', ['categories' => $categories, 'booklist' => $book]);
    }
    public function update(Request $request, $slug)
    {
        // Validate the form data
        $request->validate([
            'book_code' => 'required|unique:books,book_code,' . $slug . ',slug|max:255',
            'title' => 'required|string|max:255',
            'categories' => 'array',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // Add more validation rules as needed
        ]);

        // Find the book by its slug
        $book = Book::where('slug', $slug)->firstOrFail();

        if (!$book) {
            return redirect()->route('booklist')->with('error', 'Sorry, the requested book was not found.');
        }

        // For changing slug name on update
        $book->slug = null;

        $newName = $request->title; // Set the image name as the title by default

        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('cover', $newName);

            // Delete the existing image (if any)
            if ($book->cover) {
                Storage::disk('public')->delete('cover/' . $book->cover);
            }

            // Update cover name when the image is changed
            $book->cover = $newName;
        }

        // Update book details
        $book->book_code = $request->book_code;
        $book->title = $request->title;

        // Update the slug only if it's present in the request and different from the current slug
        // if ($request->has('slug') && $request->slug !== $slug) {
        //     $book->slug = $request->slug;
        // }

        $book->save();

        // Sync the categories
        $book->categories()->sync($request->input('categories', []));

        // Redirect back to the book list or show the updated book details
        return redirect()->route('booklist')->with('status', 'The book details have been successfully updated.');
    }
    public function softDelete($slug)
    {
        // Find the book by its slug
        $book = Book::where('slug', $slug)->first();

        // Check if the book exists
        if (!$book) {
        return redirect()->route('booklist')->with('error', 'Sorry, the requested book was not found.');

        }

        // Soft delete the book
        $book->delete();

        // You can redirect back or to any other route after successful deletion
        return redirect()->route('booklist')->with('status', 'The book has been deleted successfully.');

    }


    public function deleted()
    {
        $deletedBooks = Book::onlyTrashed()->get();

        return view('admin.book.softdeletedlist', ['deletedBooks' => $deletedBooks]);
    }

    public function restore($slug)
    {
        $book = Book::withTrashed()->where('slug', $slug)->first();
        $book->restore();
    return redirect()->route('booklist')->with('status', 'The book has been restored successfully.');

    }

}