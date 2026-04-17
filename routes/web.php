<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/books', [BookController::class, 'index'])->name('books.index');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');

    Route::get('/dashboard', [BookController::class, 'myBooks'])->name('dashboard');

    Route::post('/request/{book_id}', [RequestController::class, 'sendRequest'])->name('requests.send');
    Route::get('/requests', [RequestController::class, 'incomingRequests'])->name('requests.index');
    Route::post('/requests/{id}/accept', [RequestController::class, 'accept'])->name('requests.accept');
    Route::post('/requests/{id}/reject', [RequestController::class, 'reject'])->name('requests.reject');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
});

Route::get('/books/{id}', [BookController::class, 'show'])
    ->where('id', '[0-9]+')
    ->name('books.show');
