<?php

use App\Http\Controllers\DownloadPdfController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login');

Route::get('/{record}/license', [DownloadPdfController::class, 'license'])->name('licenses.pdf.download');
Route::get('/{record}/prescription', [DownloadPdfController::class, 'prescription'])->name('prescription.pdf.download');
Route::get('/{record}/patient', [DownloadPdfController::class, 'patient'])->name('patient.pdf.download');
