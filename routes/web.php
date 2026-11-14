
<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Halaman pembelajaran
Route::get('/tutorial', function () {
    return view('pages.tutorial');
});

Route::get('/quiz', function () {
    return view('pages.quiz');
});

// Fitur Wetland Explorer
Route::get('/exploration', function () {
    return view('pages.exploration');
});

Route::get('/missions', function () {
    return view('pages.missions');
});

// Dashboard siswa - hanya untuk pengguna yang sudah login
Route::get('/dashboard', function () {
    return view('student.dashboard');
})->middleware('auth')->name('dashboard');

// Profil pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Autentikasi Breeze
require __DIR__.'/auth.php';