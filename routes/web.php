<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\TransactController;
use App\Http\Controllers\Admin\admincontroller;
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
Route::group(['middleware' => 'auth'], function () {

Route::get('/Admin/home', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin')->middleware('role:admin');

Route::get('/Admin/Registration', [App\Http\Controllers\Admin\Admincontroller::class, 'Registration'])->name('Registration')->middleware('role:admin');

Route::get('/Admin/Registration/Edit/{id}', [App\Http\Controllers\Admin\Admincontroller::class, 'EditMandatedParticipants'])->name('EditMandatedParticipants')->middleware('role:admin');

Route::post('Updatemandated', [App\Http\Controllers\Admin\Admincontroller::class, 'Updatemandated'])->name('Updatemandated')->middleware('role:admin');

Route::post('Deletemandated', [App\Http\Controllers\Admin\Admincontroller::class, 'Deletemandated'])->name('Deletemandated')->middleware('role:admin');

Route::get('/Admin/View', [App\Http\Controllers\Admin\Admincontroller::class, 'ViewMandatedParticipants'])->name('ViewMandatedParticipants')->middleware('role:admin');

Route::post('Storemandated', [App\Http\Controllers\Admin\Admincontroller::class, 'Storemandated'])->name('Storemandated')->middleware('role:admin');

Route::get('/Admin/UserRegistration', [App\Http\Controllers\Admin\Admincontroller::class, 'UserRegistration'])->name('UserRegistration')->middleware('role:admin');

Route::get('/Admin/ViewUserList', [App\Http\Controllers\Admin\Admincontroller::class, 'ViewUserList'])->name('ViewUserList')->middleware('role:admin');

Route::post('registerUser', [App\Http\Controllers\Admin\Admincontroller::class, 'registerUser'])->name('registerUser')->middleware('role:admin');



Route::get('/Users/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('role:user');

Route::get('/Users/AddTransaction', [App\Http\Controllers\User\TransactController::class, 'addtransact'])->name('addtransact')->middleware('role:user');
Route::get('/Users/PendingTransactions', [App\Http\Controllers\User\TransactController::class, 'pendingtransact'])->name('Pendingtransact')->middleware('role:user');
Route::get('/Users/ApprovedTransactions', [App\Http\Controllers\User\TransactController::class, 'approvedtransact'])->name('Approvedtransact')->middleware('role:user');
Route::get('/Users/ScheduledTransactions', [App\Http\Controllers\User\TransactController::class, 'scheduletransact'])->name('scheduled')->middleware('role:user');

Route::get('/Users/MonthlyRECsReport', [App\Http\Controllers\User\TransactController::class, 'report'])->name('report')->middleware('role:user');

Route::get('/Users/Search', [App\Http\Controllers\User\TransactController::class, 'search'])->name('search')->middleware('role:user');
Route::get('generate-pdf', [App\Http\Controllers\User\TransactController::class, 'generatePDF'])->name('generatePDF')->middleware('role:user');

Route::get('/Users/compliance', [App\Http\Controllers\User\TransactController::class, 'compliance'])->name('compliance')->middleware('role:user');

Route::post('/Users/compliance', [App\Http\Controllers\User\TransactController::class, 'compliancereq'])->name('compliancereq')->middleware('role:user');
Route::get('/Users/expired', [App\Http\Controllers\User\TransactController::class, 'expired'])->name('expired')->middleware('role:user');

Route::resource('AddTransaction', TransactController::class)->middleware('role:user');;

});
Route::get('/rtyuiodkasfaksdfnmvcnlvfagylrvfvDAV/error/a/qdfghjkdlaswuq/1dasnjd/asd123o12t4e7tgykfga26et8of1yfe19e7rd1fo2g31t307812t4g812ypodwte812o6', [App\Http\Controllers\User\TransactController::class, 'error']);