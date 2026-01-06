<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AutomationController;

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AutomationController::class, 'index'])->name('dashboard');
    Route::post('/run', [AutomationController::class, 'run'])->name('run-automation');
});
