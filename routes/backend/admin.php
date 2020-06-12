<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\CompanyController;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
// specific company
Route::group(['namespace' => 'Company'], function () {
    // Company CRUD
    Route::get('company', [CompanyController::class, 'index'])->name('company.index');
    Route::get('company/create', [CompanyController::class, 'create'])->name('company.create');
    Route::post('company', [CompanyController::class, 'store'])->name('company.store');
    Route::get('company/deactivated', [CompanyController::class, 'deactivated'])->name('company.deactivated');

    // Specific Company
    Route::group(['prefix' => 'company/{company}'], function () {
        // Company
        Route::get('/', [CompanyController::class, 'show'])->name('company.show');
        Route::get('edit', [CompanyController::class, 'edit'])->name('company.edit');
        Route::patch('/', [CompanyController::class, 'update'])->name('company.update');
        Route::delete('/', [CompanyController::class, 'destroy'])->name('company.destroy');
        Route::get('mark/{status}', [CompanyController::class, 'mark'])->name('company.mark')->where(['status' => '[0,1]']);

    });
});

// specific customer
Route::group(['namespace' => 'Customer'], function () {
    // Customer CRUD
    Route::get('customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('customer/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('customer', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('customer/deactivated', [CustomerController::class, 'deactivated'])->name('customer.deactivated');

    // Specific Customer
    Route::group(['prefix' => 'customer/{customer}'], function () {
        // Customer
        Route::get('/', [CustomerController::class, 'show'])->name('customer.show');
        Route::get('edit', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::patch('/', [CustomerController::class, 'update'])->name('customer.update');
        Route::delete('/', [CustomerController::class, 'destroy'])->name('customer.destroy');
        Route::get('mark/{status}', [CustomerController::class, 'mark'])->name('customer.mark')->where(['status' => '[0,1]']);

    });
});
