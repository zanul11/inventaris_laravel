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


Route::get('/', 'AuthController@index');

// Route::get('login', ['as' => 'login', 'uses' => 'FrontController@index']);
Route::get('login', ['as' => 'login', 'uses' => 'AuthController@index']);
Route::get('/auth', 'AuthController@show');
// Route::resource('register', 'FrontController');
// Route::get('/send', 'PklController@send');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/auth/logout', 'AuthController@logout');
    Route::get('/dashboard', 'DashboardController@index');

    //USER
    Route::get('ss-user', 'UserController@getServerSide')->name('ss.user');
    Route::post('user/delete/{user}', 'UserController@delete');
    Route::resource('user', 'UserController');

    //SATUAN
    Route::get('ss-satuan', 'SatuanController@getServerSide')->name('ss.satuan');
    Route::post('/satuan/edit', 'SatuanController@edits');
    Route::resource('satuan', 'SatuanController');

    //JENIS
    Route::get('ss-jenis', 'JenisController@getServerSide')->name('ss.jenis');
    Route::post('/jenis/edit', 'JenisController@edits');
    Route::resource('jenis', 'JenisController');

    //JENIS
    Route::get('ss-jenis-kwitansi', 'JenisKwitansiController@getServerSide')->name('ss.jenis_kwitansi');
    Route::post('/jenis-kwitansi/edit', 'JenisKwitansiController@edits');
    Route::resource('jenis-kwitansi', 'JenisKwitansiController');
    Route::get('get-jenis-kwitansi', 'JenisKwitansiController@getJenis');
    Route::post('get-jumlah-jenis', 'JenisKwitansiController@getJumlahJenis');

    //BARANG
    Route::get('get-bidang', 'BarangController@getBidang');
    Route::get('get-barang', 'BarangController@getBarang');
    Route::get('ss-barang', 'BarangController@getServerSide')->name('ss.barang');
    Route::post('/barang/edit', 'BarangController@edits');
    Route::post('barang/delete/{barang}', 'BarangController@delete');
    Route::get('barang/deleted', 'BarangController@barangDeleted');
    Route::get('barang/all', 'BarangController@barangAll');
    Route::resource('barang', 'BarangController');

    //PEGAWAI
    Route::get('ss-pegawai', 'PegawaiController@getServerSide')->name('ss.pegawai');
    Route::post('/pegawai/edit', 'PegawaiController@edits');
    Route::post('/pegawai/tambah_dokumen', 'PegawaiController@tambah_dokumen');
    Route::post('/pegawai/hapus_dokumen/{id}', 'PegawaiController@hapus_dokumen');
    Route::resource('pegawai', 'PegawaiController');

    //BARANG MASUK
    Route::post('/barang_masuk/edit', 'BarangMasukController@edits');
    Route::post('barang_masuk/delete/{barang}', 'BarangMasukController@delete');
    Route::get('ss-barang-masuk', 'BarangMasukController@getServerSide')->name('ss.barang.masuk');
    Route::get('ss-barang-keluar', 'BarangKeluarController@getServerSide')->name('ss.barang.keluar');
    Route::resource('barang_masuk', 'BarangMasukController');

    //BARANG KELUAR
    Route::post('/barang_keluar/get-detail-barang', 'BarangKeluarController@getSelectedBarang');
    Route::post('/barang_keluar/edit', 'BarangKeluarController@edits');
    Route::post('barang_keluar/delete/{barang}', 'BarangKeluarController@delete');
    Route::get('barang_keluar/cetak/{barang}', 'BarangKeluarController@cetak');
    Route::get('barang_keluar/get-data/{barang}', 'BarangKeluarController@getData');
    // Route::post('/barang_keluar/get-selected-barang', 'BarangKeluarController@getSelectedBarang');
    Route::get('ss-barang-keluar', 'BarangKeluarController@getServerSide')->name('ss.barang.keluar');
    Route::resource('barang_keluar', 'BarangKeluarController');

    //KWITANSI
    Route::post('/kwitansi/get-detail-barang', 'KwitansiController@getSelectedBarang');
    Route::post('/kwitansi/edit', 'KwitansiController@edits');
    Route::post('kwitansi/delete/{kwitansi}', 'KwitansiController@delete');
    Route::get('ss-kwitansi', 'KwitansiController@getServerSide')->name('ss.kwitansi');
    Route::resource('kwitansi', 'KwitansiController');

    //LOGISTIK
    Route::get('ss-logistik', 'LogistikController@getServerSide')->name('ss.logistik');
    Route::resource('logistik', 'LogistikController');

    //PERALATAN
    Route::get('ss-peralatan', 'PeralatanController@getServerSide')->name('ss.peralatan');
    Route::post('peralatan/rusak', 'PeralatanController@rusakPeralatan');
    Route::post('peralatan/tambah', 'PeralatanController@tambahPeralatan');

    Route::resource('peralatan', 'PeralatanController');

    //LOKASI
    Route::post('/lokasi/edit', 'LokasiController@edits');
    Route::post('lokasi/delete/{lokasi}', 'LokasiController@delete');
    Route::get('ss-lokasi', 'LokasiController@getServerSide')->name('ss.lokasi');
    Route::get('getLokasi', 'LokasiController@getLokasi');
    Route::resource('lokasi', 'LokasiController');

    //JABATAN
    Route::post('/jabatan/edit', 'JabatanController@edits');
    Route::post('jabatan/delete/{jabatan}', 'JabatanController@delete');
    Route::get('ss-jabatan', 'JabatanController@getServerSide')->name('ss.jabatan');
    Route::resource('jabatan', 'JabatanController');

    Route::resource('kelengkapan', 'KelengkapanController');

    //KAS
    Route::post('/kas/get-detail-barang', 'KasController@getSelectedBarang');
    Route::post('/kas/get-selected-kas', 'KasController@getSelectedKas');
    Route::get('/kas/get-kwitansi-all', 'KasController@getKwitansiAll');
    Route::post('/kas/edit', 'KasController@edits');
    Route::post('kas/delete', 'KasController@delete');
    Route::get('ss-kas', 'KasController@getServerSide')->name('ss.kas');
    Route::resource('kas', 'KasController');
    Route::get('/rkk', 'KasController@cetakRKK');
    Route::get('/voucher', 'KasController@cetakVoucher');

    Route::post('kas-tmp/delete', 'KasTmpController@delete');
    Route::get('/kas-tmp/getKwitansiAll', 'KasTmpController@getKwitansiAll');
    Route::resource('kas-tmp', 'KasTmpController');

    //BANTUAN
    Route::post('pelanggan/delete/{pelanggan}', 'Bantuan\PelangganController@delete');
    Route::resource('pelanggan', 'Bantuan\PelangganController');
    Route::get('ss-pelanggan', 'Bantuan\PelangganController@getServerSide')->name('ss.pelanggan');
    Route::resource('pembayaran', 'Bantuan\PembayaranController');

    //SELECT2
    Route::get('select2/pelanggan', 'Bantuan\Select2Controller@pelanggan')->name('select2.pelanggan');
    Route::get('select2/bantuan', 'Bantuan\Select2Controller@bantuan')->name('select2.bantuan');
    Route::get('select2/pelanggan-all', 'Bantuan\Select2Controller@pelangganAll');
    Route::post('select2/tagihan', 'Bantuan\Select2Controller@tagihan');

    //Laporan

    Route::resource('laporan', 'LaporanController');
    Route::resource('laporan-masuk', 'LaporanBarangMasukController');
    Route::resource('laporan-keluar', 'LaporanBarangKeluarController');
    Route::get('laporan-kwitansi', 'KwitansiController@cetak');
});
