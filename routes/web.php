<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\managerController;
use App\Http\Controllers\productController;
use App\Http\Controllers\supplierController;
use App\Http\Controllers\transactionController;
use App\Http\Middleware\CheckIfAdmin;
use App\Http\Middleware\RedirectBasedOnRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard'); // Redirect to a different page if logged in
    }
    return redirect()->route('login');
});

// Dashboard with Role-Based Redirection
Route::get('/dashboard', function () {
})->middleware(['auth', 'verified', RedirectBasedOnRole::class])->name('dashboard');

// Admin Routes
Route::middleware(['auth', CheckIfAdmin::class])->group(function () {
    Route::get('/admin/dashboard', [adminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/create-user', [adminController::class, 'showCreateAccountForm'])->name('create-user');
    Route::post('/admin/create-user', [adminController::class, 'storeAccount'])->name('store-user');
});

// Manager Routes
Route::middleware(['auth'])->group(function() {
    Route::get('/manager/dashboard', [managerController::class, 'managerDashboard'])->name('manager.dashboard');
});


// Product Route
Route::get('/products', [productController::class, 'showProductsTables'])->name('products');
Route::post('/products', [productController::class, 'showProductsTables'])->name('products.store');

Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// Supplier Routes
Route::get('/suppliers', [supplierController::class, 'showSuppliers'])->name('suppliers');
Route::post('/suppliers', [SupplierController::class, 'supplierStore'])->name('suppliers.store');

// Transaction Routes
Route::get('/suppliers', [supplierController::class, 'showSuppliers'])->name('suppliers');
Route::post('/transactions', [transactionController::class, 'transactionStore'])->name('transaction.store');
Route::get('/transaction/in', [TransactionController::class, 'transactionIn'])->name('transaction.in');
Route::get('/transaction/out', [TransactionController::class, 'transactionOut'])->name('transaction.out');

// Customer route
Route::get('/customers', [customerController::class, 'showCustomers'])->name('customers');
Route::put('/customers/{id}', [customerController::class, 'update'])->name('customers.update');
Route::delete('/customers/{id}', [customerController::class, 'destroy'])->name('customers.destroy');

require __DIR__.'/auth.php';
