<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RentLogs extends Model
{
    use HasFactory;

    protected $table = 'rent_logs';

    protected $fillable = ['user_id', 'book_id', 'rent_date', 'return_date'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
    //Book::where('id', $request->book_id)->update(['status' => 'not available']);
        //     RentLogs::create([
        //     'user_id' => $request->user_id,
        //     'book_id' => $request->book_id,
        //     'rent_date' => $request->rent_date,
        //     'return_date' => $request->return_date,
        // ]);

        // // Retrieve all rent logs including the newly added entry
        // $rentLogs = Rentlogs::all();

        //         $request['rent_date'] = Carbon::now()->toDateString();
        // $request['return_date'] = Carbon::now()->addDay(3)->toDateString();

        //     // Get all books and pluck the 'status' attribute
        //     $books = Book::pluck('status');

        //     // Output the result
        //     dd($books);

        // if ($books['status'] != 'in stock') {
        //         return redirect()->route('book.rent')
        //             ->with('error', 'Cannot rent, one or more books are not available')
        //             ->with('alert-error', 'alert-danger');
        //     }

        // else{
        //     try {
        //         //code...
        //         DB::beginTransaction();

        //         RentLogs::create($request->all());

        //         $book = Book::findOrFail($request->book_id);
        //         $book->status = 'not available';
        //         $book->save();

        //         DB::commit();

        //     return redirect()->route('book.rent')
        //         ->with('success', 'Rented success')
        //         ->with('alert-success', 'alert-success');

        //     } catch (\Throwable $th) {
        //         //throw $th;
        //         DB::rollBack();
        //         dd($th);
        //     }