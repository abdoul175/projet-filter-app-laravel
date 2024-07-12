<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FileController::class, 'index']);
Route::post('/import', [FileController::class, 'import'])->name('import');
Route::post('/export', [FileController::class, 'export'])->name('export');