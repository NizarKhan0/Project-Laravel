<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookRentController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', '!=', 1)->where('status', '!=', 'inactive')->get();
        $books = Book::all();
        return view('admin.book.rent', ['users' => $users, 'books' => $books]);
    }

    public function store(Request $request)
    {
        $request['rent_date'] = now()->toDateString();
        $request['return_date'] = now()->addDay(3)->toDateString();

        $book = Book::findOrFail($request->book_id)->only('status');

        if ($book['status'] != 'in stock') {
            return redirect()->route('book.rent')
                ->with('error', 'Cannot rent, the book is not available.')
                ->with('alert-error', 'alert-danger');
        } else {
            $bookCount = RentLogs::where('user_id', $request->user_id)->where('actual_return_date', null)
                ->count();
            if ($bookCount >= 3) {
                return redirect()->route('book.rent')
                    ->with('error', 'Cannot rent, the user has reached the limit of rented books.')
                    ->with('alert-error', 'alert-danger');
            } else {
                try {
                    // Check if the book is already rented by another user
                    $isBookRented = RentLogs::where('book_id', $request->book_id)
                        ->where('actual_return_date', null)
                        ->exists();

                    if ($isBookRented) {
                        return redirect()->route('book.rent')
                            ->with('error', 'Cannot rent, the book is already rented by another user.')
                            ->with('alert-error', 'alert-danger');
                    }

                    // Start database transaction
                    DB::beginTransaction();

                    RentLogs::create($request->all());

                    $book = Book::findOrFail($request->book_id);
                    $book->status = 'not available';
                    $book->save();

                    // Commit the transaction
                    DB::commit();

                    return redirect()->route('book.rent')
                        ->with('success', 'Book rented successfully.')
                        ->with('alert-success', 'alert-success');

                } catch (\Throwable $th) {
                    // Rollback the transaction on error
                    DB::rollBack();

                    return redirect()->route('book.rent')
                        ->with('error', 'An error occurred while renting the book. Please try again.')
                        ->with('alert-error', 'alert-danger');
                }
            }
        }
    }
   public function return ()
    {
        $users = User::where('role_id', '!=', 1)->where('status', '!=', 'inactive')->get();
        $books = Book::all();
        return view('admin.book.returnBook', ['users' => $users, 'books' => $books]);
    }
    public function returnBook(Request $request)
    {
        // Check if the user has an active rental for the specified book
        $rent = RentLogs::where('user_id', $request->user_id)
            ->where('book_id', $request->book_id)
            ->where('actual_return_date', null);

        $rentData = $rent->first();
        $countData = $rent->count();

        if ($countData == 1) {
            // User has an active rental, update actual_return_date
            $rentData->actual_return_date = Carbon::now()->toDateString();
            $rentData->save();

            $book = Book::findOrFail($request->book_id);
            $book->status = 'in stock';
            $book->save();

            return redirect()->route('book.return')
                ->with('success', 'Book returned successfully.')
                ->with('alert-success', 'alert-success');
        } elseif ($countData == 0) {
            // No active rental found, check if the user had returned the book earlier
            $previousRental = RentLogs::where('user_id', $request->user_id)
                ->where('book_id', $request->book_id)
                ->whereNotNull('actual_return_date')
                ->latest()
                ->first();

            if ($previousRental) {
                // User had returned the book earlier, update actual_return_date to null
                $previousRental->actual_return_date = null;
                $previousRental->save();

                // Now you can proceed to rent the book again

                // ... Your code to rent the book again goes here ...

                return redirect()->route('book.return')
                    ->with('success', 'Book rental renewed successfully.')
                    ->with('alert-success', 'alert-success');
            } else {
                return redirect()->route('book.return')
                    ->with('error', 'No active rental found for the specified user and book.')
                    ->with('alert-error', 'alert-danger');
            }
        }
    }

    public function deleteOldRentLogs($id)
    {
        $rentlogs = RentLogs::where('id', $id)->first();

        if ($rentlogs) {
            $rentlogs->forceDelete();
            return redirect()->route('rent-logs', ['id' => $id])
                ->with('status', 'Rent log record deleted successfully.');
        } else {
            return redirect()->route('rent-logs', ['id' => $id])
                ->with('error', 'Rent log record not found.')
                ->with('alert-error', 'alert-danger');
        }
    }
}