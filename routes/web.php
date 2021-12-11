<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();
Route::middleware('auth')->group(function (){
	Route::get('dashboard', 'Backend\DashboardController@index')->name('dashboard');
	Route::get('profil', 'Backend\AdminController@edit_profil')->name('profil');
	Route::post('profil-update/{id}', 'Backend\AdminController@submit_data_profil')->name('profil-update');

	Route::middleware('role_user:0,1,2')->group(function(){
		Route::prefix('konfirmasi-pendaftaran')->group(function (){
			Route::middleware('role_user:0')->group(function(){
				Route::get('/', 'RegisterController@list_pendaftar')->name('konfirmasi-pendaftaran-index');
				Route::get('edit/{id}', 'RegisterController@edit_status_pendaftar')->name('konfirmasi-pendaftaran-edit');
				Route::post('update-status-pendaftar/{id}', 'RegisterController@update_status_pendaftar')->name('update-status-pendaftar');
			});
			Route::middleware('role_user:1,2')->group(function(){
				Route::get('form-data-diri', 'RegisterController@form_data_diri')->name('form-data-diri');
				Route::post('submit-data-diri/{id}', 'RegisterController@submit_data_diri')->name('submit-data-diri');
				// Route::get('delete/{id}', 'Backend\KamarController@delete')->name('kamar-delete');
			});
		});

		Route::prefix('laporan')->group(function (){
			Route::middleware('role_user:0')->group(function(){
				Route::get('/', 'Backend\ArisanController@laporan_index')->name('laporan-index');
				Route::get('laporan-keuangan/{id}', 'Backend\ArisanController@laporan_keuangan')->name('laporan-keuangan');
			});
			Route::middleware('role_user:1,2')->group(function(){
				Route::get('form-data-diri', 'RegisterController@form_data_diri')->name('form-data-diri');
				Route::post('submit-data-diri/{id}', 'RegisterController@submit_data_diri')->name('submit-data-diri');
				// Route::get('delete/{id}', 'Backend\KamarController@delete')->name('kamar-delete');
			});
		});
	});

	//Route Arisan
	Route::prefix('arisan')->group(function (){
		Route::get('/', 'Backend\ArisanController@index')->name('arisan-index');
		Route::middleware('role_user:0,1,2')->group(function(){
			Route::middleware('role_user:1')->group(function(){
				Route::post('', 'Backend\ArisanController@create')->name('arisan-create');
				Route::get('edit/{id}', 'Backend\ArisanController@editAjax')->name('arisan-ajax-edit');
				Route::put('update/{id}', 'Backend\ArisanController@update')->name('arisan-update');
				Route::post('batal/{id}', 'Backend\ArisanController@update_batal')->name('arisan-update-batal');
				Route::post('aktif/{id}', 'Backend\ArisanController@update_aktif')->name('arisan-update-aktif');
				Route::post('selesai/{id}', 'Backend\ArisanController@update_selesai')->name('arisan-update-selesai');
				Route::get('detail-periode/{id}', 'Backend\ArisanController@detail_periode')->name('detail-periode');
			});
			Route::get('daftar-pemenang', 'Backend\ArisanController@list_pemenang')->name('daftar-pemenang');
			Route::middleware('role_user:0')->group(function(){
				Route::get('daftar-invoice', 'Backend\ArisanController@list_invoice')->name('daftar-invoice');
				Route::get('form-transfer-pemenang/{id}', 'Backend\ArisanController@form_transfer_pemenang')->name('form-transfer-pemenang');
				Route::post('update-status-pemenang/{id}', 'Backend\ArisanController@update_status_pemenang')->name('update-status-pemenang');
			});
			Route::post('join-arisan/{id}', 'Backend\ArisanController@join_arisan')->name('join-arisan');
			Route::get('arisan-saya', 'Backend\ArisanController@arisan_saya')->name('arisan-saya');
			Route::get('tanggungan-arisan/{id}', 'Backend\ArisanController@tanggungan_arisan')->name('tanggungan-arisan');
			Route::get('invoice/{id}', 'Backend\ArisanController@invoice')->name('invoice');
			Route::get('cek-invoice/{id}', 'Backend\ArisanController@cek_bukti_iuran')->name('cek-invoice');
			Route::post('pembayaran/{id}', 'Backend\ArisanController@pembayaran')->name('pembayaran');
			Route::post('update-status-pembayaran/{id}', 'Backend\ArisanController@update_status_pembayaran')->name('update-status-pembayaran');
			Route::get('status-bayar-periode/{id}/{periode}', 'Backend\ArisanController@status_bayar_periode')->name('status-bayar-periode');
			Route::post('undi-pemenang/{id}/{periode}', 'Backend\ArisanController@undi_pemenang')->name('undi-pemenang');
		});
	});

});

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/register', 'RegisterController@register')->name('register');

