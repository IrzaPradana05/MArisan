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
Route::get('/executor', 'Backend\DashboardController@executor');

Auth::routes();
Route::middleware('auth')->group(function (){
	Route::get('dashboard', 'Backend\DashboardController@index')->name('dashboard');

	Route::prefix('konfirmasi-pendaftaran')->group(function (){
		Route::get('/', 'RegisterController@list_pendaftar')->name('konfirmasi-pendaftaran-index');
		Route::get('form-data-diri', 'RegisterController@form_data_diri')->name('form-data-diri');
		Route::post('submit-data-diri/{id}', 'RegisterController@submit_data_diri')->name('submit-data-diri');
		Route::get('edit/{id}', 'RegisterController@edit_status_pendaftar')->name('konfirmasi-pendaftaran-edit');
		Route::post('update-status-pendaftar/{id}', 'RegisterController@update_status_pendaftar')->name('update-status-pendaftar');
		// Route::get('delete/{id}', 'Backend\KamarController@delete')->name('kamar-delete');
	});

//===============================================================================
	Route::middleware('role_user:0')->group(function(){
		//Route Pusat Data
		Route::prefix('pusat-data')->group(function (){

			//Route Master Kamar
			Route::prefix('kamar')->group(function (){
				Route::get('/', 'Backend\KamarController@index')->name('kamar-index');
				Route::post('', 'Backend\KamarController@create')->name('kamar-create');
				Route::get('edit/{id}', 'Backend\KamarController@editAjax')->name('kamar-ajax-edit');
				Route::put('update/{id}', 'Backend\KamarController@update')->name('kamar-update');
				Route::get('delete/{id}', 'Backend\KamarController@delete')->name('kamar-delete');
			});

			//Route Master Kelas
			Route::prefix('kelas')->group(function (){
				Route::get('/', 'Backend\KelasController@index')->name('kelas-index');
				Route::post('', 'Backend\KelasController@create')->name('kelas-create');
				Route::get('edit/{id}', 'Backend\KelasController@editAjax')->name('kelas-ajax-edit');
				Route::put('update/{id}', 'Backend\KelasController@update')->name('kelas-update');
				Route::get('delete/{id}', 'Backend\KelasController@delete')->name('kelas-delete');
			});

			//Route Master Siswa
			Route::prefix('siswa')->group(function (){
				Route::get('/', 'Backend\SiswaController@index')->name('siswa-index');
				Route::post('', 'Backend\SiswaController@create')->name('siswa-create');
				Route::get('edit/{id}', 'Backend\SiswaController@editAjax')->name('siswa-ajax-edit');
				Route::put('update/{id}', 'Backend\SiswaController@update')->name('siswa-update');
				Route::get('delete/{id}', 'Backend\SiswaController@delete')->name('siswa-delete');
			});

			//Route Master Admin BK
			Route::prefix('admin')->group(function (){
				Route::get('/', 'Backend\AdminController@index')->name('admin-index');
				Route::post('', 'Backend\AdminController@create')->name('admin-create');
				Route::get('edit/{id}', 'Backend\AdminController@editAjax')->name('admin-ajax-edit');
				Route::put('update/{id}', 'Backend\AdminController@update')->name('admin-update');
				Route::get('delete/{id}', 'Backend\AdminController@delete')->name('admin-delete');
			});

			//Route Master Admin BK
			Route::prefix('wali')->group(function (){
				Route::get('/', 'Backend\WaliController@index')->name('wali-index');
				Route::post('', 'Backend\WaliController@create')->name('wali-create');
				Route::get('edit/{id}', 'Backend\WaliController@editAjax')->name('wali-ajax-edit');
				Route::put('update/{id}', 'Backend\WaliController@update')->name('wali-update');
				Route::get('delete/{id}', 'Backend\WaliController@delete')->name('wali-delete');
			});
		});

	});

	//Route Pelanggaran
	Route::prefix('pelanggaran')->group(function (){
		Route::get('/', 'Backend\PelanggaranController@index')->name('pelanggaran-index');
		Route::middleware('role_user:0')->group(function(){
			Route::post('', 'Backend\PelanggaranController@create')->name('pelanggaran-create');
			Route::get('edit/{id}', 'Backend\PelanggaranController@editAjax')->name('pelanggaran-ajax-edit');
			Route::put('update/{id}', 'Backend\PelanggaranController@update')->name('pelanggaran-update');
			Route::get('delete/{id}', 'Backend\PelanggaranController@delete')->name('pelanggaran-delete');
		});
	});

	//Route Arisan
	Route::prefix('arisan')->group(function (){
		Route::get('/', 'Backend\ArisanController@index')->name('arisan-index');
		Route::middleware('role_user:0')->group(function(){
			Route::post('', 'Backend\ArisanController@create')->name('arisan-create');
			Route::get('edit/{id}', 'Backend\ArisanController@editAjax')->name('arisan-ajax-edit');
			Route::put('update/{id}', 'Backend\ArisanController@update')->name('arisan-update');
		});
	});

	Route::middleware('role_user:0')->group(function(){
		//Route Surat Tindak
		Route::prefix('surat-tindak')->group(function (){
			Route::get('/', 'Backend\SuratTindakController@index')->name('surat-tindak-index');
			Route::post('', 'Backend\SuratTindakController@create')->name('surat-tindak-create');
			Route::get('edit/{id}', 'Backend\SuratTindakController@editAjax')->name('surat-tindak-ajax-edit');
			Route::put('update/{id}', 'Backend\SuratTindakController@update')->name('surat-tindak-update');
			Route::get('delete/{id}', 'Backend\SuratTindakController@delete')->name('surat-tindak-delete');
			Route::post('cetak-surat', 'Backend\SuratTindakController@cetak_surat')->name('surat-tindak-cetak');
		});
	});

	//Route Prestasi
	Route::prefix('prestasi')->group(function (){
		Route::get('/', 'Backend\PrestasiController@index')->name('prestasi-index');
		Route::middleware('role_user:0')->group(function(){
			Route::post('', 'Backend\PrestasiController@create')->name('prestasi-create');
			Route::get('edit/{id}', 'Backend\PrestasiController@editAjax')->name('prestasi-ajax-edit');
			Route::put('update/{id}', 'Backend\PrestasiController@update')->name('prestasi-update');
			Route::get('delete/{id}', 'Backend\PrestasiController@delete')->name('prestasi-delete');
		});
	});

	//Route Konseling
	Route::prefix('konseling')->group(function (){
		Route::get('/', 'Backend\KonselingController@index')->name('konseling-index');
		Route::middleware('role_user:0')->group(function(){
			Route::post('', 'Backend\KonselingController@create')->name('konseling-create');
			Route::get('edit/{id}', 'Backend\KonselingController@editAjax')->name('konseling-ajax-edit');
			Route::put('update/{id}', 'Backend\KonselingController@update')->name('konseling-update');
			Route::get('delete/{id}', 'Backend\KonselingController@delete')->name('konseling-delete');
		});
	});

	//Route Karir
	Route::prefix('karir')->group(function (){
		Route::get('/', 'Backend\KarirController@index')->name('karir-index');
		Route::middleware('role_user:0')->group(function(){
			Route::post('', 'Backend\KarirController@create')->name('karir-create');
			Route::get('edit/{id}', 'Backend\KarirController@editAjax')->name('karir-ajax-edit');
			Route::put('update/{id}', 'Backend\KarirController@update')->name('karir-update');
			Route::get('delete/{id}', 'Backend\KarirController@delete')->name('karir-delete');
		});
	});

	//Route Pengumuman
	Route::prefix('pengumuman')->group(function (){
		Route::get('/', 'Backend\PengumumanController@index')->name('pengumuman-index');
		Route::middleware('role_user:0')->group(function(){
			Route::post('', 'Backend\PengumumanController@create')->name('pengumuman-create');
			Route::get('edit/{id}', 'Backend\PengumumanController@editAjax')->name('pengumuman-ajax-edit');
			Route::put('update/{id}', 'Backend\PengumumanController@update')->name('pengumuman-update');
			Route::get('delete/{id}', 'Backend\PengumumanController@delete')->name('pengumuman-delete');
		});
	});

	//Route Psikotes
	Route::prefix('psikotes')->group(function (){
		Route::get('/{id}', 'Backend\HasilPsikotesController@index')->name('psikotes-index');
		Route::middleware('role_user:0')->group(function(){
			Route::post('{id}', 'Backend\HasilPsikotesController@create')->name('psikotes-create');
			Route::get('edit/{id}', 'Backend\HasilPsikotesController@editAjax')->name('psikotes-ajax-edit');
			Route::put('update/{id_pengumuman}/{id}', 'Backend\HasilPsikotesController@update')->name('psikotes-update');
			Route::get('delete/{id_pengumuman}/{id}', 'Backend\HasilPsikotesController@delete')->name('psikotes-delete');
		});
	});

		//Route Peserta
		Route::prefix('peserta-psikotes')->group(function (){
			Route::middleware('role_user:0')->group(function(){
				Route::get('/{id}', 'Backend\PesertaController@index')->name('peserta-index');
				Route::post('{id}', 'Backend\PesertaController@create')->name('peserta-create');
				Route::get('edit/{id}', 'Backend\PesertaController@editAjax')->name('peserta-ajax-edit');
				Route::put('update/{id_pengumuman}/{id}', 'Backend\PesertaController@update')->name('peserta-update');
				Route::get('delete/{id_pengumuman}/{id}', 'Backend\PesertaController@delete')->name('peserta-delete');
			});
			Route::middleware('role_user:1')->group(function(){
				Route::get('daftar-psikotes/{id}', 'Backend\PesertaController@daftar')->name('peserta-daftar');
			});
	});

	//Route Reflin
	Route::prefix('reflin')->group(function (){
		Route::get('/', 'Backend\HasilReflinController@index')->name('reflin-index');
		Route::middleware('role_user:0')->group(function(){
			Route::post('', 'Backend\HasilReflinController@create')->name('reflin-create');
			Route::get('edit/{id}', 'Backend\HasilReflinController@editAjax')->name('reflin-ajax-edit');
			Route::put('update/{id}', 'Backend\HasilReflinController@update')->name('reflin-update');
			Route::get('delete/{id}', 'Backend\HasilReflinController@delete')->name('reflin-delete');
		});
	});

		//Route Chat
		Route::prefix('chat')->group(function (){
			Route::middleware('role_user:1,0')->group(function(){
				Route::get('/', 'Backend\PesanController@index')->name('chat-index');
				Route::get('message/{id}', 'Backend\PesanController@chat_panel')->name('chat-panel');
				Route::post('', 'Backend\PesanController@create')->name('chat-create');
			});
			Route::middleware('role_user:0')->group(function(){
				Route::get('edit/{id}', 'Backend\PesanController@editAjax')->name('chat-ajax-edit');
				Route::put('update/{id}', 'Backend\PesanController@update')->name('chat-update');
				Route::get('delete/{id}', 'Backend\PesanController@delete')->name('chat-delete');
			});
		});
});

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/register', 'RegisterController@register')->name('register');

