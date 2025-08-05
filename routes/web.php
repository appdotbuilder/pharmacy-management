<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DrugController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Drug management routes
    Route::resource('drugs', DrugController::class);
    
    // Placeholder routes for other features
    Route::get('customers', function () {
        return Inertia::render('customers/index', ['customers' => []]);
    })->name('customers.index');
    
    Route::get('prescriptions', function () {
        return Inertia::render('prescriptions/index', ['prescriptions' => []]);
    })->name('prescriptions.index');
    
    Route::get('sales', function () {
        return Inertia::render('sales/index', ['sales' => []]);
    })->name('sales.index');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
