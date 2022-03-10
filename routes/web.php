<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\TransactController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------

| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/Users/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/Users/AddTransaction', [App\Http\Controllers\User\TransactController::class, 'addtransact'])->name('addtransact');
Route::get('/Users/PendingTransactions', [App\Http\Controllers\User\TransactController::class, 'pendingtransact'])->name('Pendingtransact');
Route::get('/Users/ApprovedTransactions', [App\Http\Controllers\User\TransactController::class, 'approvedtransact'])->name('Approvedtransact');
Route::get('/Users/ScheduledTransactions', [App\Http\Controllers\User\TransactController::class, 'scheduletransact'])->name('scheduled');

Route::get('/Users/MonthlyRECsReport', [App\Http\Controllers\User\TransactController::class, 'report'])->name('report');

Route::get('/Users/Search', [App\Http\Controllers\User\TransactController::class, 'search'])->name('search');
Route::get('generate-pdf', [App\Http\Controllers\User\TransactController::class, 'generatePDF'])->name('generatePDF');

Route::get('/Users/compliance', [App\Http\Controllers\User\TransactController::class, 'compliance'])->name('compliance');

Route::post('/Users/compliance', [App\Http\Controllers\User\TransactController::class, 'compliancereq'])->name('compliancereq');
Route::get('/Users/expired', [App\Http\Controllers\User\TransactController::class, 'expired'])->name('expired');

Route::resource('AddTransaction', TransactController::class);
