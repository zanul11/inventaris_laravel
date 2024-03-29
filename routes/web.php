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
//ABSEN
Route::resource('absen', 'AbsenController');
Route::group(['middleware' => 'auth'], function () {
    Route::resource('kirim-email', 'MailController');
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

    //PINJAM
    Route::post('/pinjam/kembali', 'PinjamController@pinjamKembali');
    Route::post('/pinjam/hapus', 'PinjamController@pinjamHapus');
    Route::post('/get-peralatan/detail', 'PinjamController@getSelectedAlat');
    Route::post('/get-peralatan/kembalian', 'PinjamController@getKembalainAlat');
    Route::post('/pinjam/edit', 'PinjamController@edits');
    Route::get('get-peralatan', 'PinjamController@getAlat');
    Route::get('get-peralatan/{id}', 'PinjamController@getAlatById');
    Route::get('ss-pinjam', 'PinjamController@getServerSide')->name('ss.pinjam');
    Route::resource('pinjam', 'PinjamController');

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


    //PROYEK
    Route::get('/proyek/cetak/{proyek}', 'ProyekController@cetakKelangkapan');
    Route::get('/proyek/getdata', 'ProyekController@getData');
    Route::get('ss-proyek', 'ProyekController@getServerSide')->name('ss.proyek');
    Route::post('/proyek/edit', 'ProyekController@edits');
    Route::resource('proyek', 'ProyekController');

    //BARANG MASUK
    Route::post('/barang_masuk/edit', 'BarangMasukController@edits');
    Route::get('barang_masuk/delete/{barang}', 'BarangMasukController@delete');
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

    //JAM KERJA
    Route::resource('jam-kerja', 'JamKerjaController');
    Route::post('tidak_hadir/filter', 'TidakHadirController@filter');
    Route::resource('tidak_hadir', 'TidakHadirController');
    Route::resource('rekap', 'RekapController');
    Route::resource('rincian', 'RincianController');
    Route::resource('posting', 'PostingController');

    //KEHADIRAN
    Route::resource('kehadiran', 'KehadiranController');

    Route::get('ss-jenis-izin', 'JenisIzinController@getServerSide')->name('ss.jenis-izin');
    Route::resource('jenis-izin', 'JenisIzinController');

    Route::get('ss-libur', 'LiburController@getServerSide')->name('ss.libur');
    Route::resource('libur', 'LiburController');

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


    //JENIS AKUNTING
    Route::get('ss-jenis-akunting', 'JenisAkuntingController@getServerSide')->name('ss.jenis-akunting');
    Route::post('/jenis-akunting/edit', 'JenisAkuntingController@edits');
    Route::resource('jenis-akunting', 'JenisAkuntingController');

    //PEMASUKAN
    Route::get('ss-pemasukan', 'PemasukanController@getServerSide')->name('ss.pemasukan');
    Route::resource('pemasukan', 'PemasukanController');

    //PENGELUARAN
    Route::get('ss-pengeluaran', 'PengeluaranController@getServerSide')->name('ss.pengeluaran');
    Route::get('pengeluaran/{pengeluaran}/konfirmasi', 'PengeluaranController@konfirmasi');
    Route::resource('pengeluaran', 'PengeluaranController');


    //LAPORAN AKUNTING
    Route::get('ss-laporan-akunting', 'LaporanAkuntingController@getServerSide')->name('ss.laporan-akunting');
    Route::resource('laporan-akunting', 'LaporanAkuntingController');
});
