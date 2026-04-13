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

// Wisata & Produk
Route::get('/wisata', [\App\Http\Controllers\Public\WisataController::class, 'index'])->name('wisata');
Route::resource('/produk', \App\Http\Controllers\Public\ProdukController::class)->only(['index', 'show']);
Route::get('/produk/{id}/checkout', [\App\Http\Controllers\Public\ProdukController::class, 'checkout'])->name('produk.checkout');
Route::post('/produk/{id}/checkout', [\App\Http\Controllers\Public\ProdukController::class, 'processCheckout'])->name('produk.process');

// Data Desa
Route::get('/statistik', [\App\Http\Controllers\Public\DataDesaController::class, 'statistik'])->name('statistik');
Route::get('/transparansi', [\App\Http\Controllers\Public\DataDesaController::class, 'apbdes'])->name('transparansi');

// Berita & Galeri
Route::get('/berita', [\App\Http\Controllers\Public\BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [\App\Http\Controllers\Public\BeritaController::class, 'show'])->name('berita.show');
Route::post('/berita/react/{id}', [\App\Http\Controllers\Public\BeritaController::class, 'react'])->name('berita.react');
Route::get('/galeri', [\App\Http\Controllers\Public\GaleriController::class, 'index'])->name('galeri');

// Kontak
Route::get('/kontak', [\App\Http\Controllers\Public\KontakController::class, 'index'])->name('kontak.index');
Route::post('/kontak', [\App\Http\Controllers\Public\KontakController::class, 'store'])->name('kontak.store');

Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout')->middleware('auth');
// Operator
Route::middleware(['auth', 'role:operator,admin'])->prefix('operator')->name('operator.')->group(function() {
    Route::get('/dashboard', [\App\Http\Controllers\Operator\DashboardController::class, 'index']);
    
    // Profil
    Route::get('/profil', [\App\Http\Controllers\Operator\ProfilController::class, 'edit']);
    Route::post('/profil', [\App\Http\Controllers\Operator\ProfilController::class, 'update']);
    
    // Pemerintahan
    Route::post('struktur/hero', [\App\Http\Controllers\Operator\StrukturController::class, 'updateHero']);
    Route::resource('struktur', \App\Http\Controllers\Operator\StrukturController::class)->except(['show']);
    Route::post('bpd/hero', [\App\Http\Controllers\Operator\BpdController::class, 'updateHero']);
    Route::resource('bpd', \App\Http\Controllers\Operator\BpdController::class)->except(['show']);
    Route::post('lembaga/hero', [\App\Http\Controllers\Operator\LembagaController::class, 'updateHero']);
    Route::resource('lembaga', \App\Http\Controllers\Operator\LembagaController::class)->except(['show']);
    
    // Wisata
    Route::post('wisata/hero', [\App\Http\Controllers\Operator\WisataController::class, 'updateHero']);
    Route::resource('wisata', \App\Http\Controllers\Operator\WisataController::class)->except(['show']);
    
    // Produk
    Route::post('produk/hero', [\App\Http\Controllers\Operator\ProdukController::class, 'updateHero']);
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

