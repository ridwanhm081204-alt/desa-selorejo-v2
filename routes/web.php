<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Public\BerandaController::class, 'index'])->name('beranda');
Route::post('/polling/{id}/vote', [\App\Http\Controllers\Public\BerandaController::class, 'vote'])->name('polling.vote');

// Profil Desa
Route::get('/profil/sejarah', [\App\Http\Controllers\Public\ProfilController::class, 'sejarah'])->name('profil.sejarah');
Route::get('/profil/visi-misi', [\App\Http\Controllers\Public\ProfilController::class, 'visiMisi'])->name('profil.visi-misi');
Route::get('/profil/geografis', [\App\Http\Controllers\Public\ProfilController::class, 'geografis'])->name('profil.geografis');
Route::get('/profil/peta', [\App\Http\Controllers\Public\ProfilController::class, 'peta'])->name('profil.peta');

// Pemerintahan
Route::get('/pemerintahan/struktur', [\App\Http\Controllers\Public\PemerintahanController::class, 'struktur'])->name('pemerintahan.struktur');
Route::get('/pemerintahan/bpd', [\App\Http\Controllers\Public\PemerintahanController::class, 'bpd'])->name('pemerintahan.bpd');
Route::get('/pemerintahan/lembaga', [\App\Http\Controllers\Public\PemerintahanController::class, 'lembaga'])->name('pemerintahan.lembaga');
Route::get('/pemerintahan/perangkat-rt-rw', [\App\Http\Controllers\Public\PemerintahanController::class, 'perangkatRtRw'])->name('pemerintahan.perangkat-rt-rw');
Route::get('/pemerintahan/produkhukum', [\App\Http\Controllers\Public\PemerintahanController::class, 'produkHukum'])->name('pemerintahan.produk-hukum');

// Wisata & Produk
Route::get('/wisata', [\App\Http\Controllers\Public\WisataController::class, 'index'])->name('wisata.index');
Route::get('/wisata/{id}', [\App\Http\Controllers\Public\WisataController::class, 'show'])->name('wisata.show');
Route::post('/wisata/share/{id}', [\App\Http\Controllers\Public\WisataController::class, 'share'])->name('wisata.share');
Route::post('/wisata/react/{id}', [\App\Http\Controllers\Public\WisataController::class, 'react'])->name('wisata.react');
Route::resource('/produk', \App\Http\Controllers\Public\ProdukController::class)->only(['index', 'show']);
Route::post('/produk/share/{id}', [\App\Http\Controllers\Public\ProdukController::class, 'share'])->name('produk.share');
Route::post('/produk/{id}/review', [\App\Http\Controllers\Public\ProdukController::class, 'storeReview'])->name('produk.review');
Route::get('/produk/{id}/checkout', [\App\Http\Controllers\Public\ProdukController::class, 'checkout'])->name('produk.checkout');
Route::post('/produk/{id}/checkout', [\App\Http\Controllers\Public\ProdukController::class, 'processCheckout'])->name('produk.process');

// Data Desa
Route::get('/statistik', [\App\Http\Controllers\Public\DataDesaController::class, 'statistik'])->name('statistik');
Route::get('/transparansi', [\App\Http\Controllers\Public\DataDesaController::class, 'apbdes'])->name('transparansi');

// Berita & Galeri
Route::get('/berita', [\App\Http\Controllers\Public\BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [\App\Http\Controllers\Public\BeritaController::class, 'show'])->name('berita.show');
Route::post('/berita/react/{id}', [\App\Http\Controllers\Public\BeritaController::class, 'react'])->name('berita.react');
Route::post('/berita/share/{id}', [\App\Http\Controllers\Public\BeritaController::class, 'share'])->name('berita.share');
Route::get('/galeri', [\App\Http\Controllers\Public\GaleriController::class, 'index'])->name('galeri');

// Kontak
Route::get('/kontak', [\App\Http\Controllers\Public\KontakController::class, 'index'])->name('kontak.index');
Route::post('/kontak', [\App\Http\Controllers\Public\KontakController::class, 'store'])->name('kontak.store');

// Sistem Layanan Administrasi Desa
Route::prefix('layanan')->name('layanan.')->group(function() {
    Route::get('/', [\App\Http\Controllers\Public\LayananController::class, 'index'])->name('index');
    Route::get('/akta-kelahiran', [\App\Http\Controllers\Public\LayananController::class, 'formAktaKelahiran'])->name('akta-kelahiran');
    Route::get('/akta-kematian', [\App\Http\Controllers\Public\LayananController::class, 'formAktaKematian'])->name('akta-kematian');
    Route::get('/kartu-keluarga', [\App\Http\Controllers\Public\LayananController::class, 'formKk'])->name('kk');
    Route::get('/ktp', [\App\Http\Controllers\Public\LayananController::class, 'formKtp'])->name('ktp');
    Route::post('/store', [\App\Http\Controllers\Public\LayananController::class, 'store'])->name('store');
    Route::get('/sukses', [\App\Http\Controllers\Public\LayananController::class, 'sukses'])->name('sukses');
    Route::get('/cek-status', [\App\Http\Controllers\Public\LayananController::class, 'cekStatus'])->name('cek-status');
    Route::get('/cek-status/hasil', [\App\Http\Controllers\Public\LayananController::class, 'hasilStatus'])->name('hasil-status');
});

// KKN UNS 178 Profil
Route::get('/kkn-uns-178', [\App\Http\Controllers\Public\KknController::class, 'index'])->name('kkn.profil');

Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Operator
Route::middleware(['auth', 'role:operator,admin'])->prefix('operator')->name('operator.')->group(function() {
    Route::get('/dashboard', [\App\Http\Controllers\Operator\DashboardController::class, 'index']);
    
    // Layanan Administrasi Desa
    Route::get('/layanan', [\App\Http\Controllers\Operator\LayananController::class, 'index'])->name('layanan.index');
    Route::get('/layanan/{id}', [\App\Http\Controllers\Operator\LayananController::class, 'show'])->name('layanan.show');
    Route::post('/layanan/{id}/status', [\App\Http\Controllers\Operator\LayananController::class, 'updateStatus'])->name('layanan.status');
    Route::get('/layanan/{id}/notif', [\App\Http\Controllers\Operator\LayananController::class, 'kirimNotifikasi'])->name('layanan.notif');

    // Konten Layanan (edit nama/deskripsi/ikon kartu layanan di halaman publik)
    Route::get('/layanan-konten', [\App\Http\Controllers\Operator\LayananKontenController::class, 'index'])->name('layanan-konten.index');
    Route::post('/layanan-konten/batch', [\App\Http\Controllers\Operator\LayananKontenController::class, 'updateBatch'])->name('layanan-konten.batch');
    Route::put('/layanan-konten/{id}', [\App\Http\Controllers\Operator\LayananKontenController::class, 'update'])->name('layanan-konten.update');
    Route::post('/layanan-konten/{id}/syarat', [\App\Http\Controllers\Operator\LayananKontenController::class, 'storeSyarat'])->name('layanan-konten.syarat.store');
    Route::put('/layanan-konten/syarat/{syarat_id}', [\App\Http\Controllers\Operator\LayananKontenController::class, 'updateSyarat'])->name('layanan-konten.syarat.update');
    Route::delete('/layanan-konten/syarat/{syarat_id}', [\App\Http\Controllers\Operator\LayananKontenController::class, 'destroySyarat'])->name('layanan-konten.syarat.destroy');

    // KKN UNS 178
    Route::get('/kkn', [\App\Http\Controllers\Operator\KknController::class, 'index'])->name('kkn.index');
    Route::post('/kkn/settings', [\App\Http\Controllers\Operator\KknController::class, 'updateSettings'])->name('kkn.settings');
    Route::post('/kkn/reorder', [\App\Http\Controllers\Operator\KknController::class, 'reorder'])->name('kkn.reorder');
    Route::get('/kkn/create', [\App\Http\Controllers\Operator\KknController::class, 'create'])->name('kkn.create');
    Route::post('/kkn', [\App\Http\Controllers\Operator\KknController::class, 'store'])->name('kkn.store');
    Route::get('/kkn/{id}/edit', [\App\Http\Controllers\Operator\KknController::class, 'edit'])->name('kkn.edit');
    Route::put('/kkn/{id}', [\App\Http\Controllers\Operator\KknController::class, 'update'])->name('kkn.update');
    Route::delete('/kkn/{id}', [\App\Http\Controllers\Operator\KknController::class, 'destroy'])->name('kkn.destroy');
    
    
    // Profil
    Route::get('/profil/sejarah', [\App\Http\Controllers\Operator\ProfilController::class, 'sejarah'])->name('profil.sejarah');
    Route::get('/profil/visi-misi', [\App\Http\Controllers\Operator\ProfilController::class, 'visiMisi'])->name('profil.visi-misi');
    Route::get('/profil/geografis', [\App\Http\Controllers\Operator\ProfilController::class, 'geografis'])->name('profil.geografis');
    Route::get('/profil/peta', [\App\Http\Controllers\Operator\ProfilController::class, 'peta'])->name('profil.peta');
    Route::post('/profil', [\App\Http\Controllers\Operator\ProfilController::class, 'update'])->name('profil.update');
    
    // Pemerintahan
    Route::post('struktur/hero', [\App\Http\Controllers\Operator\StrukturController::class, 'updateHero']);
    Route::resource('struktur', \App\Http\Controllers\Operator\StrukturController::class)->except(['show']);
    Route::post('bpd/hero', [\App\Http\Controllers\Operator\BpdController::class, 'updateHero']);
    Route::resource('bpd', \App\Http\Controllers\Operator\BpdController::class)->except(['show']);
    Route::post('lembaga/hero', [\App\Http\Controllers\Operator\LembagaController::class, 'updateHero']);
    Route::resource('lembaga', \App\Http\Controllers\Operator\LembagaController::class)->except(['show']);
    Route::post('perangkat-rt-rw/hero', [\App\Http\Controllers\Operator\PerangkatRtRwController::class, 'updateHero'])->name('perangkat-rt-rw.hero');
    Route::resource('perangkat-rt-rw', \App\Http\Controllers\Operator\PerangkatRtRwController::class)->except(['show']);
    Route::post('produkhukum/hero', [\App\Http\Controllers\Operator\ProdukHukumController::class, 'updateHero']);
    Route::resource('produkhukum', \App\Http\Controllers\Operator\ProdukHukumController::class)->except(['show']);
    
    // Wisata
    Route::post('wisata/hero', [\App\Http\Controllers\Operator\WisataController::class, 'updateHero']);
    Route::resource('wisata', \App\Http\Controllers\Operator\WisataController::class)->except(['show']);
    
    // Produk
    Route::post('produk/hero', [\App\Http\Controllers\Operator\ProdukController::class, 'updateHero']);
    Route::get('produk/transaksi', [\App\Http\Controllers\Operator\ProdukController::class, 'transaksi'])->name('produk.transaksi');
    Route::post('produk/transaksi/{id}/status', [\App\Http\Controllers\Operator\ProdukController::class, 'updateTransaksiStatus'])->name('produk.transaksi.status');
    Route::resource('produk', \App\Http\Controllers\Operator\ProdukController::class)->except(['show']);
    // Statistik
    Route::post('statistik/hero', [\App\Http\Controllers\Operator\StatistikController::class, 'updateHero']);
    Route::resource('statistik', \App\Http\Controllers\Operator\StatistikController::class)->except(['show']);
    
    // APBDes / Transparansi
    Route::post('apbdes/hero', [\App\Http\Controllers\Operator\ApbdesController::class, 'updateHero']);
    Route::resource('apbdes', \App\Http\Controllers\Operator\ApbdesController::class)->except(['show']);
    
    // Berita
    Route::post('berita/hero', [\App\Http\Controllers\Operator\BeritaController::class, 'updateHero']);
    Route::resource('berita', \App\Http\Controllers\Operator\BeritaController::class);
    
    // Galeri
    Route::post('galeri/hero', [\App\Http\Controllers\Operator\GaleriController::class, 'updateHero']);
    Route::resource('galeri', \App\Http\Controllers\Operator\GaleriController::class);
    // Polling
    Route::post('/polling/hero', [\App\Http\Controllers\Operator\PollingController::class, 'updateHero'])->name('polling.hero');
    Route::resource('polling', \App\Http\Controllers\Operator\PollingController::class)->except(['show']);
    Route::get('/polling/{id}/hasil', [\App\Http\Controllers\Operator\PollingController::class, 'hasil']);
    
    // Kontak & Widget
    Route::post('/widget/hero', [\App\Http\Controllers\Operator\WidgetController::class, 'updateHero'])->name('widget.hero');
    Route::get('/widget', [\App\Http\Controllers\Operator\WidgetController::class, 'edit'])->name('widget.edit');
    Route::post('/widget', [\App\Http\Controllers\Operator\WidgetController::class, 'update'])->name('widget.update');
    
    // Pesan
    Route::get('/pesan', [\App\Http\Controllers\Operator\PesanController::class, 'index']);
    Route::get('/pesan/{id}', [\App\Http\Controllers\Operator\PesanController::class, 'show']);
    Route::post('/pesan/{id}/baca', [\App\Http\Controllers\Operator\PesanController::class, 'baca']);
    
    // Ganti Password dll
    Route::get('/settings/password', [\App\Http\Controllers\Operator\ProfileController::class, 'editPassword'])->name('settings.password');
    Route::post('/settings/password', [\App\Http\Controllers\Operator\ProfileController::class, 'updatePassword'])->name('settings.password.update');
});

// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function() {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index']);
    Route::resource('operator', \App\Http\Controllers\Admin\OperatorController::class)->except(['show']);
    
    Route::get('/backup', [\App\Http\Controllers\Admin\BackupController::class, 'index']);
    Route::post('/backup', [\App\Http\Controllers\Admin\BackupController::class, 'backup']);
    Route::post('/backup/import', [\App\Http\Controllers\Admin\BackupController::class, 'import'])->name('backup.import');
    Route::get('/backup/download', [\App\Http\Controllers\Admin\BackupController::class, 'backup']);
    
    Route::get('/log', [\App\Http\Controllers\Admin\LogController::class, 'index']);
    
    Route::get('/pengaturan', [\App\Http\Controllers\Admin\SettingController::class, 'index']);
    Route::post('/pengaturan', [\App\Http\Controllers\Admin\SettingController::class, 'update']);
});

