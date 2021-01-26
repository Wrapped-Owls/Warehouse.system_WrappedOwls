<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagement;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InoutController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ItemReportController;
use App\Http\Controllers\CollaboratorController;

Route::get(
	'/', function () {
	return redirect('home');
}
)
     ->name('main');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])
     ->name('home');
Route::get('/request/{id}', [HomeController::class, 'approve'])
     ->name('approve');
Route::get('/request/refuse/{id}', [HomeController::class, 'refuse'])
     ->name('refuse');
Route::get('/request/refuse_collaborator/{id}', [CollaboratorController::class, 'refuse'])
     ->name('refuse_collaborator');
Route::get('/request/approve_collaborator/{id}', [CollaboratorController::class, 'approve'])
     ->name('approve_collaborator');
Route::get('/requests/approved', [InoutController::class, 'index'])
     ->name('approved_requests');
Route::get('/item/{id}/release', [InoutController::class, 'release'])
     ->name('release');
Route::post('/item/{id}/receive', [InoutController::class, 'receive'])
     ->name('receive');
Route::get('/search', [ItemController::class, 'search'])
     ->name('search');

Route::resource('/area', 'App\Http\Controllers\AreaController');
Route::resource('/changeData', 'App\Http\Controllers\ChangeDataController');
Route::resource('/product', 'App\Http\Controllers\ProductController');
Route::resource('/inout', 'App\Http\Controllers\ItemController');
Route::resource('/item', 'App\Http\Controllers\ItemRequestController');
Route::resource('/activities', 'App\Http\Controllers\ActivityController');
Route::resource('/user', 'App\Http\Controllers\UserManagement');

Route::post('transfer/{id}', [ItemController::class, 'transfer'])
     ->name('inout.transfer');
Route::get('product/{id}/detail', [ProductController::class, 'detail'])
     ->name('product.detail');
Route::get('product/{id}/remove', [ProductController::class, 'remove'])
     ->name('product.remove');
Route::get('area{id}/remove', [AreaController::class, 'remove'])
     ->name('area.remove');
Route::get('/request_admin', [ItemController::class, 'admin'])
     ->name('request_admin');

Route::get('/collaborator', [CollaboratorController::class, 'collaborator'])
     ->middleware('collaborator');
Route::get('/backup', [BackupController::class, 'index'])
     ->name('backup.index');
Route::post('/backup/import', [BackupController::class, 'importBackup'])
     ->name('backup.import');
Route::post('/backup', [BackupController::class, 'generateBackup'])
     ->name('backup.store');

Route::get('/itemReport', [ItemReportController::class, 'index'])
     ->name('itemReport');

Route::get('/baixarqr/{id}', [ItemReportController::class, 'qr_print'])
     ->name('baixarqr');

Route::get('admin/pdf', [ItemReportController::class, 'fun_pdf']);

Route::get('/reportDownload', [ItemReportController::class, 'downloadsPage'])
     ->name('reportPage');
Route::get('/download/{pdfname}', [ItemReportController::class, 'makeDownload']);
Route::post('/user/{id}/restore', [UserManagement::class, 'restore'])
     ->name('restoreUser');
