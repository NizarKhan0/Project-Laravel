<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RentLogController;
use App\Http\Controllers\BookRentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//index for public book
Route::get('/', [PublicController::class, 'index'])->name('books.public');

Route::middleware('only_guest')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate']);
    Route::get('register', [AuthController::class, 'register']);
    Route::post('register', [AuthController::class, 'registerProcess']);
});

Route::middleware('auth')->group(function() {

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/user/profile', [UserController::class, 'profile'])->name('profile')->middleware('only_user');

    // Route::get('/book/public', [BookController::class, 'index'])->name('book-public');

    Route::middleware('only_admin')->group(function () {

        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/admin/book/booklist', [BookController::class, 'index'])->name('booklist');
        Route::post('/admin/book/create', [BookController::class, 'store'])->name('booklist.store');
        Route::get('/admin/book/edit/{slug}', [BookController::class, 'edit'])->name('booklist.edit');
        Route::put('/admin/book/update/{slug}', [BookController::class, 'update'])->name('booklist.update');
        Route::get('/admin/book/delete/{slug}', [BookController::class, 'softDelete'])->name('booklist.softDelete');
        Route::get('/admin/book/softdelete-list', [BookController::class, 'deleted'])->name('booklist.deleted');
        Route::get('/admin/book/softdelete-list/{slug}', [BookController::class, 'restore'])->name('booklist.restore');

        Route::get('/admin/rent-logs', [RentLogController::class, 'index'])->name('rent-logs');

        Route::get('/admin/book-rent', [BookRentController::class, 'index'])->name('book.rent');
        Route::post('/admin/book-rent', [BookRentController::class, 'store'])->name('book.store');
        Route::get('/admin/book-return', [BookRentController::class, 'return'])->name('book.return');
        Route::post('/admin/book-return', [BookRentController::class, 'returnBook'])->name('book.returnBook');
        Route::get('/delete-old-rent-logs/{id}', [BookRentController::class, 'deleteOldRentLogs'])
            ->name('delete.old.rent.logs');

        Route::get('/admin/category', [CategoryController::class, 'index'])->name('categories');
        Route::post('/admin/category/create', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/admin/category/edit/{slug}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/admin/category/update/{slug}', [CategoryController::class, 'update'])->name('categories.update');
        Route::get('/admin/category/delete/{slug}', [CategoryController::class, 'softDelete'])->name('categories.softDelete');
        Route::get('/admin/category/deleted', [CategoryController::class, 'deleted'])->name('categories.deleted');
        Route::get('/admin/category/restore/{slug}', [CategoryController::class, 'restore'])->name('categories.restore');

        Route::get('/users', [UserController::class, 'activeUser'])->name('active.users');
        Route::get('/admin/user/pending', [UserController::class, 'registeredUser'])->name('registered.users');
        Route::get('/admin/user/detail/{slug}', [UserController::class, 'detailUser'])->name('detail.users');
        Route::get('/admin/user/approve/{slug}', [UserController::class, 'approveUser'])->name('approve.users');
        Route::get('/admin/user/reject/{slug}', [UserController::class, 'rejectUser'])->name('reject.users');
        Route::get('/admin/user/ban/{slug}', [UserController::class, 'banUser'])->name('ban.users');
        Route::get('/admin/user/banned', [UserController::class, 'bannedUser'])->name('banned.users');
        Route::get('/admin/user/restore/{slug}', [UserController::class, 'restoreUser'])->name('restore.users');

    });
});