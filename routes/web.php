<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::get('books/{book}/delete', [BookController::class, 'delete'])->name('books.delete');
Route::resource('books', BookController::class);
