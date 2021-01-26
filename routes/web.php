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

Route::get(
	'/', function () {
	return redirect('home');
}
)
     ->name('main');

Auth::routes();

Route::get('/home', 'HomeController@index')
     ->name('home');
Route::get('/request/{id}', 'HomeController@approve')
     ->name('approve');
Route::get('/request/refuse/{id}', 'HomeController@refuse')
     ->name('refuse');
Route::get('/request/refuse_collaborator/{id}', 'CollaboratorController@refuse')
     ->name('refuse_collaborator');
Route::get('/request/approve_collaborator/{id}', 'CollaboratorController@approve')
     ->name('approve_collaborator');
Route::get('/requests/approved', 'InoutController@index')
     ->name('approved_requests');
Route::get('/item/{id}/release', 'InoutController@release')
     ->name('release');
Route::post('/item/{id}/receive', 'InoutController@receive')
     ->name('receive');
Route::get('/search', 'ItemController@search')
     ->name('search');
Route::resource('/area', 'AreaController');
Route::resource('/changeData', 'ChangeDataController');
Route::resource('/product', 'ProductController');
Route::resource('/inout', 'ItemController');
Route::resource('/item', 'ItemRequestController');
Route::resource('/activities', 'ActivityController');
Route::post('transfer/{id}', 'ItemController@transfer')
     ->name('inout.transfer');
Route::get('product/{id}/detail', 'ProductController@detail')
     ->name('product.detail');
Route::get('product/{id}/remove', 'ProductController@remove')
     ->name('product.remove');
Route::get('area{id}/remove', 'AreaController@remove')
     ->name('area.remove');
Route::get('/request_admin', 'ItemController@admin')
     ->name('request_admin');

Route::get('/collaborator', 'CollaboratorController@collaborator')
     ->middleware('collaborator');
Route::get('/backup', 'BackupController@index')
     ->name('backup.index');
Route::post('/backup/import', 'BackupController@importBackup')
     ->name('backup.import');
Route::post('/backup', 'BackupController@generateBackup')
     ->name('backup.store');

Route::get('/itemReport', 'ItemReportController@index')
     ->name('itemReport');

Route::get('/baixarqr/{id}', 'ItemReportController@qr_print')
     ->name('baixarqr');

Route::get('admin/pdf', 'ItemReportController@fun_pdf');

Route::get('/reportDownload', 'ItemReportController@downloadsPage')
     ->name('reportPage');
Route::get('/download/{pdfname}', 'ItemReportController@makeDownload');
Route::resource('/user', 'UserManagement');
Route::post('/user/{id}/restore', 'UserManagement@restore')
     ->name('restoreUser');
