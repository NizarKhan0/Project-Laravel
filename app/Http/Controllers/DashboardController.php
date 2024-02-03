<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        //$request->session()->flush();
        $bookCount = Book::count();
        // Example: Assuming your model is named 'Book'
        $currentMonthData = Book::whereMonth('created_at', now()->month)->first();
        $previousMonthData = Book::whereMonth('created_at', now()->subMonth()->month)->first();

        if ($previousMonthData && $previousMonthData->value != 0) {
            $percentageChange = (($currentMonthData->value - $previousMonthData->value) / $previousMonthData->value) * 100;
        } else {
            // Handle the case where $previousMonthData is not available or has a value of 0 to avoid division by zero.
            $percentageChange = 0;
        }


        $categoryCount = Category::count();
                // Example: Assuming your model is named 'Category'
        $currentMonthData = Category::whereMonth('created_at', now()->month)->first();
        $previousMonthData = Category::whereMonth('created_at', now()->subMonth()->month)->first();

        if ($previousMonthData && $previousMonthData->value != 0) {
            $percentageChange = (($currentMonthData->value - $previousMonthData->value) / $previousMonthData->value) * 100;
        } else {
            // Handle the case where $previousMonthData is not available or has a value of 0 to avoid division by zero.
            $percentageChange = 0;
        }


        $userCount = User::count();
                // Example: Assuming your model is named 'User'
        $currentMonthData = User::whereMonth('created_at', now()->month)->first();
        $previousMonthData = User::whereMonth('created_at', now()->subMonth()->month)->first();

        if ($previousMonthData && $previousMonthData->value != 0) {
            $percentageChange = (($currentMonthData->value - $previousMonthData->value) / $previousMonthData->value) * 100;
        } else {
            // Handle the case where $previousMonthData is not available or has a value of 0 to avoid division by zero.
            $percentageChange = 0;
        }


        return view('admin.dashboard', ['book_count' => $bookCount, 'category_count' => $categoryCount, 'user_count' => $userCount]);
    }
}