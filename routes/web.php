<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;

// User Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::get('/events/{id}/checkout', [EventController::class, 'checkout'])->name('events.checkout');
Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('events', AdminEventController::class)->except(['show']);
    Route::get('/transactions', [AdminTransactionController::class, 'index'])->name('transactions.index');
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
    Route::get('/categories/{id}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
});
