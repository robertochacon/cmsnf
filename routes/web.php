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

//reportes dashboard
Route::get('/patients_report', [DownloadPdfController::class, 'patients_report'])->name('patients_report');
Route::get('/consultations_report', [DownloadPdfController::class, 'consultations_report'])->name('consultations_report');
Route::get('/emergencies_report', [DownloadPdfController::class, 'emergencies_report'])->name('emergencies_report');
Route::get('/licenses_report', [DownloadPdfController::class, 'licenses_report'])->name('licenses_report');
Route::get('/payments_report', [DownloadPdfController::class, 'payments_report'])->name('payments_report');

