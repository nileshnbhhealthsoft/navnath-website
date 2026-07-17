<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\ContactSubmissionController as AdminContactSubmissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SiteMediaController;
use App\Http\Controllers\Admin\SiteContentController;
use App\Http\Controllers\ContactSubmissionController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::post('/contact', [ContactSubmissionController::class, 'store'])
    ->middleware('throttle:contact')
    ->name('contact.store');

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/login', [AdminAuthController::class, 'create'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'store'])->middleware('throttle:10,1')->name('login.store');

    Route::middleware('admin.auth')->group(function (): void {
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::get('/content', [SiteContentController::class, 'edit'])->name('content.edit');
        Route::put('/content', [SiteContentController::class, 'update'])->name('content.update');
        Route::get('/media', [SiteMediaController::class, 'edit'])->name('media.edit');
        Route::put('/media', [SiteMediaController::class, 'update'])->name('media.update');
        Route::get('/messages', [AdminContactSubmissionController::class, 'index'])->name('messages.index');
        Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');
    });
});
