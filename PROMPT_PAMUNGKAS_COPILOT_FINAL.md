# 🔥 PROMPT PAMUNGKAS — FINAL INSPECTION & COMPLETION
## Website Desa Wisata Petik Jeruk Selorejo | desa-selorejo-v2
### Copilot Agent Mode (Bypass Approvals ON) | Laravel + SQLite | Ridwan Hakim Mashadi K3523066

---

> **CARA PAKAI:** Paste prompt ini SATU KALI ke Copilot Agent dalam keadaan Bypass Approvals aktif.
> Copilot akan mengeksekusi seluruh to-do list secara berurutan dan menyeluruh di project:
> **C:\Users\Lenovo\Herd\desa-selorejo-v2**

---

## ═══════════════════════════════════════════════════
## KONTEKS PROJECT (BACA DULU SEBELUM MULAI)
## ═══════════════════════════════════════════════════

```
Kamu adalah Senior Laravel Full-Stack Engineer + Senior CSS/UI/UX Architect kelas internasional 
yang sangat berpengalaman. Kamu akan melakukan FINAL INSPECTION & COMPLETION secara menyeluruh 
terhadap project Laravel yang sudah ada di C:\Users\Lenovo\Herd\desa-selorejo-v2

IDENTITAS PROJECT:
- Nama: Website Desa Wisata Petik Jeruk Selorejo
- Lokasi: Desa Selorejo, Kec. Dau, Kab. Malang, Jawa Timur
- Developer: Ridwan Hakim Mashadi (KKN Tematik UNS 2026)
- Tujuan: Portal informasi desa + media promosi wisata petik jeruk

TECH STACK FINAL (WAJIB, tidak boleh diganti):
- Backend  : Laravel 11 (PHP 8.4.x)
- Database : SQLite (BUKAN MySQL — ganti ke SQLite jika masih MySQL)
- Frontend : Bootstrap 5, Chart.js (CDN), Lucide Icons (via CDN script tag)
- Storage  : Laravel local disk (public)
- Server   : Laravel Herd (Windows)

TIGA ROLE PENGGUNA:
1. Pengunjung Publik (tanpa login) — 11 halaman baca
2. Operator Desa (login) — 13 fungsi CRUD konten
3. Admin/Root (login) — 4 fungsi sistem

KREDENSIAL DEMO:
- Admin   : admin@selorejo.desa.id     / admin123
- Operator: operator@selorejo.desa.id  / operator123

WARNA TEMA:
- --primary  : #2d6a4f (hijau tua)
- --secondary: #74c69d (hijau muda)
- --accent   : #f4a261 (oranye jeruk)
- --bg-light : #f0f7f4
- --text-dark: #1b4332

Sekarang kerjakan seluruh TODO LIST di bawah ini dari atas ke bawah, 
satu per satu, hingga 100% selesai. Jangan berhenti sampai semua selesai.
```

---

## ═══════════════════════════════════════════════════
## TODO LIST — EKSEKUSI BERURUTAN & MENYELURUH
## ═══════════════════════════════════════════════════

---

### ▶ BLOK 0 — MIGRASI DATABASE KE SQLITE

```
TODO 0.1 — CEK & GANTI KE SQLITE
Buka file .env di root project. Ubah konfigurasi database menjadi:
  DB_CONNECTION=sqlite
  DB_DATABASE=${base_path}/database/database.sqlite
Hapus baris DB_HOST, DB_PORT, DB_USERNAME, DB_PASSWORD jika ada.

TODO 0.2 — BUAT FILE SQLITE
Pastikan file database/database.sqlite sudah ada.
Jika belum, buat dengan perintah: New-Item -Path database\database.sqlite -ItemType File
Atau buat via PHP: touch(database_path('database.sqlite'));

TODO 0.3 — CEK config/database.php
Pastikan driver sqlite sudah ada dengan konfigurasi:
  'default' => env('DB_CONNECTION', 'sqlite'),
  'sqlite' => [
    'driver'   => 'sqlite',
    'url'      => env('DATABASE_URL'),
    'database' => env('DB_DATABASE', database_path('database.sqlite')),
    'prefix'   => '',
    'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
  ],

TODO 0.4 — FRESH MIGRATE
Jalankan: php artisan migrate:fresh
Pastikan semua 17 tabel berhasil dibuat tanpa error.
Jika ada error foreign key di SQLite, pastikan foreign_key_constraints diset true
dan urutan migration sudah benar (users dibuat sebelum activity_logs).
```

---

### ▶ BLOK 1 — AUDIT & PERBAIKAN STRUKTUR PROJECT

```
TODO 1.1 — SCAN SELURUH STRUKTUR DIREKTORI
Baca dan analisis seluruh isi direktori project:
  - app/Http/Controllers/ (semua controller publik, operator, admin)
  - app/Models/ (semua model)
  - database/migrations/ (semua file migration)
  - database/seeders/ (semua seeder yang ada)
  - resources/views/ (semua blade view)
  - routes/web.php (semua route)
Buat catatan internal: mana yang sudah ada, mana yang belum ada/kosong.

TODO 1.2 — VERIFIKASI SEMUA MODEL SUDAH ADA
Pastikan model berikut SUDAH ADA di app/Models/ dengan fillable & cast yang benar:
  - User.php         (fillable: name, email, password, role)
  - Profile.php      (fillable: sejarah, visi_misi, geografi, batas_wilayah, peta_embed)
  - StrukturOrganisasi.php (fillable: jabatan, nama_pejabat, foto, urutan)
  - Bpd.php          (fillable: nama, jabatan, foto)
  - LembagaDesa.php  (fillable: nama_lembaga, jenis, ketua, deskripsi, foto)
  - Wisata.php       (fillable: judul, deskripsi, harga_tiket, jadwal, aturan, gambar)
  - Produk.php       (fillable: nama, deskripsi, harga, gambar, stok)
  - Galeri.php       (fillable: tipe, url, caption, kategori, tanggal)
  - StatistikPenduduk.php (fillable: tahun, jenis_data, label, nilai)
  - Apbdes.php       (fillable: tahun, jenis, bidang, nominal, dokumen_pdf)
  - Berita.php       (fillable: judul, slug, konten, gambar, kategori, tanggal, penulis, status_publish)
  - Polling.php      (fillable: pertanyaan, jumlah_ya, jumlah_tidak, tanggal_mulai, tanggal_selesai, is_active)
  - WidgetAparat.php (fillable: foto_kades, nama_kades, sambutan)
  - TautanTerkait.php (fillable: nama, url)
  - KontakMessage.php (fillable: nama, email, pesan, status_baca)
  - Setting.php      (fillable: key, value)
  - ActivityLog.php  (fillable: user_id, action; belongsTo User)
Jika model belum ada, buat dengan php artisan make:model [NamaModel].

TODO 1.3 — VERIFIKASI SEMUA CONTROLLER ADA & LENGKAP
Pastikan controller berikut ada dan semua method-nya berfungsi:
  PUBLIC (app/Http/Controllers/Public/):
  - BerandaController@index
  - ProfilController@sejarah, @visiMisi, @geografis
  - PemerintahanController@struktur, @bpd, @lembaga
  - WisataController@index
  - ProdukController@index
  - GaleriController@index
  - StatistikController@index
  - TransparansiController@index
  - BeritaController@index, @show
  - KontakController@index, @kirim
  - PollingController@vote
  OPERATOR (app/Http/Controllers/Operator/):
  - DashboardController@index
  - ProfilController@edit, @update
  - StrukturController@index, @create, @store, @edit, @update, @destroy
  - BpdController@index, @create, @store, @edit, @update, @destroy
  - LembagaController@index, @create, @store, @edit, @update, @destroy
  - WisataController@edit, @update
  - ProdukController@index, @create, @store, @edit, @update, @destroy
  - GaleriController@index, @create, @store, @edit, @update, @destroy
  - StatistikController@index, @create, @store, @edit, @update, @destroy
  - ApbdesController@index, @store, @edit, @update, @destroy
  - BeritaController@index, @create, @store, @edit, @update, @destroy
  - PollingController@index, @create, @store, @edit, @update, @destroy, @hasil
  - WidgetController@edit, @update
  - PesanController@index, @show, @baca
  - ProfileController@editPassword, @updatePassword
  ADMIN (app/Http/Controllers/Admin/):
  - DashboardController@index
  - OperatorController@index, @create, @store, @edit, @update, @destroy
  - BackupController@index, @backup
  - LogController@index
  - PengaturanController@index, @update
Jika ada yang belum ada atau belum lengkap, buat dan lengkapi.

TODO 1.4 — VERIFIKASI ROUTES WEB.PHP LENGKAP
Buka routes/web.php. Pastikan semua route berikut ADA dan terhubung ke controller yang benar:
  - Route publik: /, /profil/*, /pemerintahan/*, /wisata, /produk, /galeri,
    /statistik, /transparansi, /berita, /berita/{slug}, /kontak, /polling/vote
  - Route auth: GET/POST /login, POST /logout
  - Route operator: prefix 'operator', middleware ['auth', 'role:operator,admin']
    semua resource dari StrukturController sampai ProfileController
  - Route admin: prefix 'admin', middleware ['auth', 'role:admin']
    OperatorController, BackupController, LogController, PengaturanController
Jika route belum ada, tambahkan.

TODO 1.5 — VERIFIKASI MIDDLEWARE ROLE ADA
Pastikan ada Middleware RoleMiddleware di app/Http/Middleware/RoleMiddleware.php yang
mengecek $user->role apakah sesuai dengan role yang diizinkan.
Pastikan middleware ini sudah didaftarkan di bootstrap/app.php atau Kernel.php dengan alias 'role'.
```

---

### ▶ BLOK 2 — PENGISIAN DATA REAL DESA SELOREJO (SEEDER KOMPREHENSIF)

```
TODO 2.1 — BUAT/UPDATE DatabaseSeeder.php
Pastikan DatabaseSeeder memanggil semua seeder berikut secara berurutan:
  $this->call([
    UserSeeder::class,
    ProfileSeeder::class,
    StrukturOrganisasiSeeder::class,
    BpdSeeder::class,
    LembagaDesaSeeder::class,
    WisataSeeder::class,
    ProdukSeeder::class,
    GaleriSeeder::class,
    StatistikPendudukSeeder::class,
    ApbdesSeeder::class,
    BeritaSeeder::class,
    PollingSeeder::class,
    WidgetAparatSeeder::class,
    TautanTerkaitSeeder::class,
    SettingSeeder::class,
  ]);

TODO 2.2 — UserSeeder.php
Buat/update dengan data:
  User::create(['name'=>'Administrator','email'=>'admin@selorejo.desa.id',
    'password'=>Hash::make('admin123'),'role'=>'admin']);
  User::create(['name'=>'Operator Desa','email'=>'operator@selorejo.desa.id',
    'password'=>Hash::make('operator123'),'role'=>'operator']);

TODO 2.3 — ProfileSeeder.php
Isi dengan data REAL Desa Selorejo:
  sejarah: "Desa Selorejo adalah sebuah desa yang terletak di Kecamatan Dau, 
    Kabupaten Malang, Provinsi Jawa Timur. Desa ini dikenal sebagai salah satu 
    sentra produksi jeruk keprok terbesar di Kabupaten Malang. Nama Selorejo 
    berasal dari kata 'selo' (batu) dan 'rejo' (makmur), yang bermakna 
    kemakmuran di atas tanah berbatu. Desa ini mulai berkembang sebagai 
    kawasan agrowisata sejak tahun 1990-an ketika perkebunan jeruk keprok 
    mulai dikelola secara lebih terstruktur oleh warga."
  visi_misi: "VISI: Terwujudnya Desa Selorejo yang Mandiri, Sejahtera, 
    dan Berdaya Saing Berbasis Agrowisata yang Berkelanjutan.\n\n
    MISI:\n1. Meningkatkan produktivitas pertanian jeruk keprok dan produk unggulan desa.\n
    2. Mengembangkan potensi wisata petik jeruk secara profesional dan berkelanjutan.\n
    3. Meningkatkan kualitas infrastruktur dan pelayanan publik.\n
    4. Memberdayakan sumber daya manusia lokal melalui pelatihan dan pendidikan.\n
    5. Mewujudkan tata kelola pemerintahan desa yang transparan dan akuntabel."
  geografi: "Desa Selorejo memiliki luas wilayah sekitar 623 hektare dengan 
    ketinggian antara 600-700 meter di atas permukaan laut. Kondisi topografi 
    berbukit dengan kemiringan sedang hingga curam sangat cocok untuk budidaya 
    jeruk keprok. Suhu rata-rata berkisar 18-26°C dengan curah hujan sekitar 
    1.800-2.200 mm per tahun."
  batas_wilayah: "Utara: Desa Mulyoagung, Kec. Dau\n
    Selatan: Desa Sumbersekar, Kec. Dau\n
    Timur: Desa Petungsewu, Kec. Dau\n
    Barat: Desa Kucur, Kec. Dau"
  peta_embed: '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15806.!2d112.5588!3d-7.9438!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e788595e6ad879d%3A0x1e8b9e09a63f76e7!2sDau%2C%20Malang%20Regency%2C%20East%20Java!5e0!3m2!1sen!2sid!4v1617000000000!5m2!1sen!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'

TODO 2.4 — StrukturOrganisasiSeeder.php
Buat data struktur organisasi pemerintah desa yang realistis:
  $data = [
    ['jabatan'=>'Kepala Desa','nama_pejabat'=>'H. Sutrisno, S.P.','urutan'=>1,'foto'=>null],
    ['jabatan'=>'Sekretaris Desa','nama_pejabat'=>'Bambang Eko Prasetyo','urutan'=>2,'foto'=>null],
    ['jabatan'=>'Kaur Keuangan','nama_pejabat'=>'Siti Nurhayati','urutan'=>3,'foto'=>null],
    ['jabatan'=>'Kaur Tata Usaha','nama_pejabat'=>'Ahmad Fauzi','urutan'=>4,'foto'=>null],
    ['jabatan'=>'Kaur Perencanaan','nama_pejabat'=>'Dewi Rahayu','urutan'=>5,'foto'=>null],
    ['jabatan'=>'Kasi Pemerintahan','nama_pejabat'=>'Joko Santoso','urutan'=>6,'foto'=>null],
    ['jabatan'=>'Kasi Kesejahteraan','nama_pejabat'=>'Sri Wahyuni','urutan'=>7,'foto'=>null],
    ['jabatan'=>'Kasi Pelayanan','nama_pejabat'=>'Hendra Wijaya','urutan'=>8,'foto'=>null],
    ['jabatan'=>'Kepala Dusun Selorejo','nama_pejabat'=>'Suprapto','urutan'=>9,'foto'=>null],
    ['jabatan'=>'Kepala Dusun Kebonagung','nama_pejabat'=>'Wahyudi','urutan'=>10,'foto'=>null],
  ];
  StrukturOrganisasi::insert($data);

TODO 2.5 — BpdSeeder.php
  $data = [
    ['nama'=>'Moch. Zainul Arifin','jabatan'=>'Ketua BPD'],
    ['nama'=>'Slamet Riyadi','jabatan'=>'Wakil Ketua BPD'],
    ['nama'=>'Nurul Hidayah','jabatan'=>'Sekretaris BPD'],
    ['nama'=>'Agus Supriyanto','jabatan'=>'Anggota BPD'],
    ['nama'=>'Eni Kusumawati','jabatan'=>'Anggota BPD'],
    ['nama'=>'Fandi Ahmad','jabatan'=>'Anggota BPD'],
    ['nama'=>'Ratna Dewi','jabatan'=>'Anggota BPD'],
  ];
  Bpd::insert($data);

TODO 2.6 — LembagaDesaSeeder.php
  $data = [
    ['nama_lembaga'=>'LPMD','jenis'=>'LPMD',
     'ketua'=>'Pardi Susanto',
     'deskripsi'=>'Lembaga Pemberdayaan Masyarakat Desa Selorejo bertugas merencanakan 
       dan menggerakkan swadaya gotong royong masyarakat dalam pelaksanaan pembangunan.'],
    ['nama_lembaga'=>'Karang Taruna Selorejo Muda','jenis'=>'Karang Taruna',
     'ketua'=>'Rizky Pratama',
     'deskripsi'=>'Karang Taruna Desa Selorejo aktif dalam kegiatan kepemudaan, 
       sosial, dan pengembangan potensi wisata desa bagi generasi muda.'],
    ['nama_lembaga'=>'PKK Desa Selorejo','jenis'=>'PKK',
     'ketua'=>'Ny. Hj. Sutrisno',
     'deskripsi'=>'PKK Desa Selorejo aktif dalam pemberdayaan perempuan, 
       posyandu, ketahanan pangan keluarga, dan kegiatan sosial kemasyarakatan.'],
    ['nama_lembaga'=>'Linmas Desa Selorejo','jenis'=>'Linmas',
     'ketua'=>'Suharto',
     'deskripsi'=>'Satuan Perlindungan Masyarakat (Linmas) Desa Selorejo bertugas 
       menjaga ketentraman, ketertiban, dan keamanan lingkungan desa.'],
  ];
  LembagaDesa::insert($data);

TODO 2.7 — WisataSeeder.php
  Wisata::create([
    'judul' => 'Wisata Petik Jeruk Keprok Selorejo',
    'deskripsi' => 'Selamat datang di surga jeruk Kecamatan Dau! Wisata Petik Jeruk Selorejo
      menawarkan pengalaman langsung memetik jeruk keprok segar dari pohonnya di kebun 
      seluas puluhan hektare dengan pemandangan alam pegunungan yang menakjubkan.
      
      Jeruk keprok Selorejo terkenal dengan rasanya yang manis-segar, kulitnya yang tipis, 
      dan kandungan air yang tinggi. Perkebunan ini telah menjadi destinasi wisata agro 
      unggulan di Kabupaten Malang sejak tahun 1990-an.
      
      Fasilitas tersedia: area parkir luas, toilet bersih, gazebo istirahat, 
      pemandu wisata lokal, warung kuliner khas desa, dan oleh-oleh jeruk segar.',
    'harga_tiket' => 25000,
    'jadwal' => "Senin - Jumat : 08.00 - 16.00 WIB\nSabtu - Minggu: 07.00 - 17.00 WIB\n
      Hari Libur Nasional: 07.00 - 17.00 WIB\n\nMusim Panen Jeruk: Mei - Agustus & Oktober - Desember",
    'aturan' => "1. Tiket masuk sudah termasuk hak petik jeruk 1 kg per orang.\n
      2. Jeruk tambahan dibeli dengan harga Rp 10.000/kg.\n
      3. Dilarang membuang sampah sembarangan di area kebun.\n
      4. Pengunjung wajib menjaga ketertiban dan tidak merusak tanaman.\n
      5. Anak-anak di bawah 5 tahun gratis, didampingi orang tua.\n
      6. Dilarang membawa hewan peliharaan ke dalam area kebun.\n
      7. Gunakan alas kaki yang nyaman karena medan berbukit.",
  ]);

TODO 2.8 — ProdukSeeder.php
  $data = [
    ['nama'=>'Jeruk Keprok Selorejo (1 kg)','deskripsi'=>'Jeruk keprok segar langsung 
      dari kebun petani Desa Selorejo. Manis, segar, kulitnya tipis mudah dikupas. 
      Dipanen pada musim puncak untuk menjamin kualitas terbaik.',
      'harga'=>15000,'stok'=>'Tersedia'],
    ['nama'=>'Jeruk Keprok Premium Box (5 kg)','deskripsi'=>'Paket premium jeruk keprok 
      Selorejo dalam kemasan box cantik, cocok untuk oleh-oleh dan hadiah. 
      Dijamin segar dan dipilih secara manual.',
      'harga'=>70000,'stok'=>'Tersedia'],
    ['nama'=>'Sari Jeruk Segar (500 ml)','deskripsi'=>'Minuman sari jeruk keprok 
      asli Selorejo tanpa pengawet, diolah langsung dari buah segar. 
      Tersedia dalam kemasan botol 500 ml.',
      'harga'=>12000,'stok'=>'Tersedia'],
    ['nama'=>'Tebu Manis Selorejo','deskripsi'=>'Batang tebu manis pilihan dari lahan 
      pertanian Desa Selorejo. Dapat diolah menjadi air tebu segar yang menyegarkan.',
      'harga'=>8000,'stok'=>'Tersedia'],
    ['nama'=>'Pupuk Organik Kompos Selorejo (25 kg)','deskripsi'=>'Pupuk organik 
      berkualitas tinggi berbahan dasar kotoran ternak sapi dan kambing serta limbah 
      organik perkebunan. Cocok untuk semua jenis tanaman buah dan sayuran.',
      'harga'=>45000,'stok'=>'Tersedia'],
    ['nama'=>'Selai Jeruk Homemade (250 gr)','deskripsi'=>'Selai jeruk keprok buatan 
      ibu-ibu PKK Desa Selorejo. Rasa asli jeruk tanpa pewarna buatan, cocok 
      untuk olesan roti atau campuran minuman.',
      'harga'=>20000,'stok'=>'Tersedia'],
  ];
  foreach ($data as $item) { Produk::create($item); }

TODO 2.9 — GaleriSeeder.php
Buat 12 item galeri menggunakan foto berkualitas tinggi dari Unsplash 
yang relevan dengan tema agrowisata, jeruk, dan desa:
  $data = [
    ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1611080626919-7cf5a9dbab12?w=800',
     'caption'=>'Kebun Jeruk Keprok Desa Selorejo','kategori'=>'Wisata Petik Jeruk',
     'tanggal'=>'2025-08-15'],
    ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1582979512210-99b6a53386f9?w=800',
     'caption'=>'Proses Pemetikan Jeruk Bersama Wisatawan','kategori'=>'Wisata Petik Jeruk',
     'tanggal'=>'2025-08-20'],
    ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1560472355-536de3962603?w=800',
     'caption'=>'Produk Unggulan Jeruk Keprok Selorejo','kategori'=>'Produk Desa',
     'tanggal'=>'2025-09-01'],
    ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=800',
     'caption'=>'Hamparan Lahan Pertanian Desa Selorejo','kategori'=>'Pertanian',
     'tanggal'=>'2025-07-10'],
    ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=800',
     'caption'=>'Keindahan Alam Pegunungan Desa Selorejo','kategori'=>'Alam',
     'tanggal'=>'2025-06-20'],
    ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1627483297886-49710ae1fc22?w=800',
     'caption'=>'Panen Raya Jeruk Keprok 2025','kategori'=>'Wisata Petik Jeruk',
     'tanggal'=>'2025-08-01'],
    ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1594735935338-7f03d0b3a6e0?w=800',
     'caption'=>'Kegiatan Gotong Royong Masyarakat','kategori'=>'Kegiatan Desa',
     'tanggal'=>'2025-05-15'],
    ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1599707367072-cd6ada2bc375?w=800',
     'caption'=>'Pupuk Organik Produksi Kelompok Tani','kategori'=>'Produk Desa',
     'tanggal'=>'2025-04-10'],
    ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?w=800',
     'caption'=>'Ibu-ibu PKK Membuat Selai Jeruk','kategori'=>'Kegiatan Desa',
     'tanggal'=>'2025-07-25'],
    ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1546514355-7fdc90ccbd03?w=800',
     'caption'=>'Pengunjung Menikmati Wisata Kebun','kategori'=>'Wisata Petik Jeruk',
     'tanggal'=>'2025-08-18'],
    ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1606787364406-a3cdf06c6d0c?w=800',
     'caption'=>'Oleh-oleh Jeruk Segar untuk Wisatawan','kategori'=>'Produk Desa',
     'tanggal'=>'2025-09-05'],
    ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=800',
     'caption'=>'Kegiatan KKN UNS di Desa Selorejo','kategori'=>'Kegiatan KKN',
     'tanggal'=>'2025-10-01'],
  ];
  Galeri::insert($data);

TODO 2.10 — StatistikPendudukSeeder.php
Data statistik realistis Desa Selorejo (estimasi berdasarkan desa seukuran):
  $tahun = 2024;
  $data = [
    // Berdasarkan Gender
    ['tahun'=>$tahun,'jenis_data'=>'gender','label'=>'Laki-laki','nilai'=>1847],
    ['tahun'=>$tahun,'jenis_data'=>'gender','label'=>'Perempuan','nilai'=>1793],
    // Berdasarkan Kelompok Usia
    ['tahun'=>$tahun,'jenis_data'=>'usia','label'=>'0-14 tahun','nilai'=>612],
    ['tahun'=>$tahun,'jenis_data'=>'usia','label'=>'15-29 tahun','nilai'=>748],
    ['tahun'=>$tahun,'jenis_data'=>'usia','label'=>'30-44 tahun','nilai'=>689],
    ['tahun'=>$tahun,'jenis_data'=>'usia','label'=>'45-59 tahun','nilai'=>421],
    ['tahun'=>$tahun,'jenis_data'=>'usia','label'=>'60+ tahun','nilai'=>170],
    // Berdasarkan Pendidikan
    ['tahun'=>$tahun,'jenis_data'=>'pendidikan','label'=>'Tidak/Belum Sekolah','nilai'=>198],
    ['tahun'=>$tahun,'jenis_data'=>'pendidikan','label'=>'SD/Sederajat','nilai'=>823],
    ['tahun'=>$tahun,'jenis_data'=>'pendidikan','label'=>'SMP/Sederajat','nilai'=>612],
    ['tahun'=>$tahun,'jenis_data'=>'pendidikan','label'=>'SMA/Sederajat','nilai'=>734],
    ['tahun'=>$tahun,'jenis_data'=>'pendidikan','label'=>'D3/S1/S2/S3','nilai'=>273],
    // Berdasarkan Pekerjaan
    ['tahun'=>$tahun,'jenis_data'=>'pekerjaan','label'=>'Petani/Berkebun','nilai'=>892],
    ['tahun'=>$tahun,'jenis_data'=>'pekerjaan','label'=>'Buruh Tani','nilai'=>312],
    ['tahun'=>$tahun,'jenis_data'=>'pekerjaan','label'=>'Pedagang/Wirausaha','nilai'=>287],
    ['tahun'=>$tahun,'jenis_data'=>'pekerjaan','label'=>'PNS/TNI/Polri','nilai'=>64],
    ['tahun'=>$tahun,'jenis_data'=>'pekerjaan','label'=>'Pelajar/Mahasiswa','nilai'=>523],
    ['tahun'=>$tahun,'jenis_data'=>'pekerjaan','label'=>'Lainnya','nilai'=>562],
    // Berdasarkan Agama
    ['tahun'=>$tahun,'jenis_data'=>'agama','label'=>'Islam','nilai'=>3584],
    ['tahun'=>$tahun,'jenis_data'=>'agama','label'=>'Kristen','nilai'=>42],
    ['tahun'=>$tahun,'jenis_data'=>'agama','label'=>'Lainnya','nilai'=>14],
  ];
  StatistikPenduduk::insert($data);

TODO 2.11 — ApbdesSeeder.php
Data APBDes realistis (estimasi desa kategori mandiri Kab. Malang):
  $tahun = 2024;
  $pendapatan = [
    ['tahun'=>$tahun,'jenis'=>'pendapatan','bidang'=>'Dana Desa (APBN)','nominal'=>987650000],
    ['tahun'=>$tahun,'jenis'=>'pendapatan','bidang'=>'Alokasi Dana Desa (ADD)','nominal'=>412300000],
    ['tahun'=>$tahun,'jenis'=>'pendapatan','bidang'=>'Bagi Hasil Pajak Daerah','nominal'=>38500000],
    ['tahun'=>$tahun,'jenis'=>'pendapatan','bidang'=>'Pendapatan Asli Desa (PADes)','nominal'=>125000000],
    ['tahun'=>$tahun,'jenis'=>'pendapatan','bidang'=>'Bantuan Keuangan Provinsi','nominal'=>150000000],
  ];
  $belanja = [
    ['tahun'=>$tahun,'jenis'=>'belanja','bidang'=>'Bidang Pemerintahan Desa','nominal'=>312450000],
    ['tahun'=>$tahun,'jenis'=>'belanja','bidang'=>'Bidang Pembangunan','nominal'=>728900000],
    ['tahun'=>$tahun,'jenis'=>'belanja','bidang'=>'Bidang Pembinaan Kemasyarakatan','nominal'=>187600000],
    ['tahun'=>$tahun,'jenis'=>'belanja','bidang'=>'Bidang Pemberdayaan Masyarakat','nominal'=>245000000],
    ['tahun'=>$tahun,'jenis'=>'belanja','bidang'=>'Bidang Penanggulangan Bencana','nominal'=>67500000],
    ['tahun'=>$tahun,'jenis'=>'belanja','bidang'=>'Bidang Pengembangan Wisata Desa','nominal'=>170000000],
  ];
  Apbdes::insert(array_merge($pendapatan, $belanja));

TODO 2.12 — BeritaSeeder.php
Buat 8 berita yang relevan dan realistis:
  $berita = [
    [
      'judul' => 'Kunjungan Wisatawan ke Desa Selorejo Meningkat 40% di Musim Panen 2025',
      'slug' => 'kunjungan-wisatawan-meningkat-40-persen-musim-panen-2025',
      'konten' => '<p>Desa Selorejo, Kecamatan Dau, Kabupaten Malang kembali mencatat rekor 
        kunjungan wisatawan pada musim panen jeruk keprok tahun 2025. Berdasarkan data 
        yang dihimpun Pemerintah Desa Selorejo, jumlah kunjungan wisatawan mencapai 
        lebih dari 8.500 orang selama periode Juli-Agustus 2025.</p>
        <p>Kepala Desa Selorejo, H. Sutrisno, S.P., mengungkapkan bahwa peningkatan ini 
        tidak lepas dari berbagai upaya promosi digital yang dilakukan bersama Tim KKN 
        Universitas Sebelas Maret (UNS) Surakarta.</p>
        <p>"Kami sangat bersyukur antusias masyarakat luar sangat tinggi. Wisata petik 
        jeruk kami memiliki keunggulan tersendiri karena pengunjung bisa langsung 
        memetik dari pohon dan membawa pulang oleh-oleh segar," ujar Pak Sutrisno.</p>',
      'kategori' => 'Kabar Desa',
      'tanggal' => '2025-08-25',
      'penulis' => 'Admin Desa',
      'status_publish' => 'publish',
    ],
    [
      'judul' => 'Peluncuran Website Resmi Desa Selorejo: Langkah Nyata Digitalisasi Desa',
      'slug' => 'peluncuran-website-resmi-desa-selorejo',
      'konten' => '<p>Pemerintah Desa Selorejo secara resmi meluncurkan website desa sebagai 
        bagian dari program digitalisasi desa yang didukung oleh Tim Kuliah Kerja Nyata 
        (KKN) Tematik Universitas Sebelas Maret (UNS) Surakarta 2026.</p>
        <p>Website yang beralamat di selorejo.desa.id ini menyajikan informasi lengkap 
        meliputi profil desa, struktur pemerintahan, data kependudukan, transparansi 
        anggaran APBDes, hingga informasi wisata petik jeruk yang menjadi andalan desa.</p>
        <p>Ridwan Hakim Mashadi, mahasiswa PTIK FKIP UNS yang menjadi penanggungjawab 
        pengembangan website, berharap platform ini dapat memperluas jangkauan promosi 
        wisata Selorejo ke tingkat nasional.</p>',
      'kategori' => 'Kegiatan KKN',
      'tanggal' => '2026-04-01',
      'penulis' => 'Tim KKN UNS 2026',
      'status_publish' => 'publish',
    ],
    [
      'judul' => 'Posyandu Balita Rutin Bulan April 2026 — Dusun Selorejo & Kebonagung',
      'slug' => 'posyandu-balita-april-2026',
      'konten' => '<p>Pemerintah Desa Selorejo menginformasikan jadwal Posyandu Balita rutin 
        bulan April 2026. Posyandu merupakan kegiatan kesehatan rutin yang diselenggarakan 
        oleh kader PKK dan Puskesmas Kecamatan Dau.</p>
        <p><strong>Jadwal Posyandu April 2026:</strong></p>
        <ul><li>Dusun Selorejo: Selasa, 15 April 2026, Pukul 08.00-11.00 WIB, 
        di Balai Dusun Selorejo</li>
        <li>Dusun Kebonagung: Rabu, 16 April 2026, Pukul 08.00-11.00 WIB, 
        di Rumah Kader RW 03</li></ul>
        <p>Seluruh ibu yang memiliki balita usia 0-5 tahun diharapkan hadir untuk 
        penimbangan, imunisasi, dan konsultasi gizi.</p>',
      'kategori' => 'Pengumuman',
      'tanggal' => '2026-04-08',
      'penulis' => 'Admin Desa',
      'status_publish' => 'publish',
    ],
    [
      'judul' => 'Kelompok Tani Selorejo Raih Penghargaan Petani Berprestasi Kab. Malang 2025',
      'slug' => 'kelompok-tani-raih-penghargaan-petani-berprestasi-2025',
      'konten' => '<p>Kelompok Tani "Maju Bersama" Desa Selorejo berhasil meraih penghargaan 
        sebagai Kelompok Tani Berprestasi Kabupaten Malang Tahun 2025 dalam kategori 
        Tanaman Hortikultura. Penghargaan diserahkan langsung oleh Bupati Malang 
        dalam acara Hari Tani Nasional di Pendopo Kabupaten.</p>
        <p>Ketua Kelompok Tani Maju Bersama, Pak Suprapto, menyatakan bahwa penghargaan 
        ini adalah buah dari kerja keras seluruh petani jeruk keprok Selorejo yang 
        konsisten menerapkan pertanian organik ramah lingkungan selama 3 tahun terakhir.</p>',
      'kategori' => 'Kabar Desa',
      'tanggal' => '2025-09-10',
      'penulis' => 'Admin Desa',
      'status_publish' => 'publish',
    ],
    [
      'judul' => 'Pengumuman Pembukaan Wisata Petik Jeruk Musim Panen Oktober 2025',
      'slug' => 'pengumuman-pembukaan-wisata-petik-jeruk-oktober-2025',
      'konten' => '<p>Pemerintah Desa Selorejo dengan gembira mengumumkan pembukaan kembali 
        Wisata Petik Jeruk Keprok Selorejo untuk musim panen Oktober - Desember 2025.</p>
        <p>Harga tiket masuk: Rp 25.000/orang (sudah termasuk hak petik 1 kg jeruk segar). 
        Pembelian tiket dapat dilakukan langsung di lokasi atau menghubungi kontak desa.</p>
        <p>Demi kenyamanan bersama, pengunjung dimohon hadir sesuai jadwal dan 
        mematuhi tata tertib yang berlaku di area kebun.</p>',
      'kategori' => 'Info Wisata',
      'tanggal' => '2025-09-28',
      'penulis' => 'Admin Desa',
      'status_publish' => 'publish',
    ],
    [
      'judul' => 'Program CERDIK: KKN UNS Hadirkan Literasi Digital untuk Warga Selorejo',
      'slug' => 'program-cerdik-kkn-uns-literasi-digital',
      'konten' => '<p>Tim KKN Tematik UNS 2026 di Desa Selorejo secara resmi meluncurkan 
        program CERDIK (Cerdas Digital Desa Selorejo) sebagai upaya peningkatan 
        literasi digital masyarakat desa.</p>
        <p>Program ini mencakup pelatihan penggunaan smartphone untuk produktivitas, 
        pengenalan e-commerce untuk pemasaran produk desa, penerapan media sosial 
        untuk promosi wisata, serta keamanan digital untuk menghindari hoaks dan penipuan online.</p>
        <p>"Kami ingin warga Selorejo tidak hanya jago bertani, tapi juga mahir memasarkan 
        produknya secara digital," ujar Ridwan Hakim Mashadi, mahasiswa PTIK UNS 
        penanggungjawab program CERDIK.</p>',
      'kategori' => 'Kegiatan KKN',
      'tanggal' => '2026-03-15',
      'penulis' => 'Tim KKN UNS 2026',
      'status_publish' => 'publish',
    ],
    [
      'judul' => 'Perbaikan Jalan Usaha Tani Selesai: Akses Kebun Makin Mudah',
      'slug' => 'perbaikan-jalan-usaha-tani-selesai',
      'konten' => '<p>Pemerintah Desa Selorejo berhasil menyelesaikan proyek perbaikan jalan 
        usaha tani sepanjang 1,2 kilometer yang menghubungkan permukiman warga dengan 
        area perkebunan jeruk keprok di bagian barat desa.</p>
        <p>Proyek ini merupakan bagian dari program penggunaan Dana Desa tahun 2024 
        dalam bidang pembangunan infrastruktur pedesaan dan pemberdayaan ekonomi lokal.</p>',
      'kategori' => 'Kabar Desa',
      'tanggal' => '2025-03-20',
      'penulis' => 'Admin Desa',
      'status_publish' => 'publish',
    ],
    [
      'judul' => 'Transparansi APBDes 2024: Realisasi Anggaran Desa Selorejo',
      'slug' => 'transparansi-apbdes-2024-realisasi-anggaran',
      'konten' => '<p>Dalam rangka mewujudkan tata kelola pemerintahan desa yang transparan 
        dan akuntabel, Pemerintah Desa Selorejo mempublikasikan realisasi Anggaran 
        Pendapatan dan Belanja Desa (APBDes) Tahun 2024.</p>
        <p>Total pendapatan desa tahun 2024 mencapai Rp 1.713.450.000 bersumber dari 
        Dana Desa APBN, Alokasi Dana Desa (ADD), bagi hasil pajak, Pendapatan Asli 
        Desa (PADes), dan bantuan keuangan provinsi.</p>
        <p>Seluruh dokumen APBDes dapat diunduh melalui menu Transparansi di website ini.</p>',
      'kategori' => 'Kabar Desa',
      'tanggal' => '2025-01-15',
      'penulis' => 'Admin Desa',
      'status_publish' => 'publish',
    ],
  ];
  foreach ($berita as $item) { Berita::create($item); }

TODO 2.13 — PollingSeeder.php
  Polling::create([
    'pertanyaan' => 'Apakah Anda puas dengan pelayanan Pemerintah Desa Selorejo bulan ini?',
    'jumlah_ya' => 47,
    'jumlah_tidak' => 8,
    'tanggal_mulai' => '2026-04-01',
    'tanggal_selesai' => '2026-04-30',
    'is_active' => true,
  ]);

TODO 2.14 — WidgetAparatSeeder.php
  WidgetAparat::create([
    'foto_kades' => null,
    'nama_kades' => 'H. Sutrisno, S.P.',
    'sambutan' => 'Selamat datang di website resmi Desa Selorejo. Kami berkomitmen 
      untuk mewujudkan desa yang mandiri, transparan, dan berdaya saing melalui 
      pemanfaatan teknologi digital. Kunjungi kebun jeruk keprok kami dan 
      rasakan pengalaman agrowisata yang tak terlupakan.',
  ]);

TODO 2.15 — TautanTerkaitSeeder.php
  $data = [
    ['nama'=>'Pemerintah Kabupaten Malang','url'=>'https://malangkab.go.id'],
    ['nama'=>'Kementerian Desa PDTT','url'=>'https://kemendesa.go.id'],
    ['nama'=>'Sistem Informasi Desa','url'=>'https://sid.kemendesa.go.id'],
    ['nama'=>'Puskesmas Kec. Dau','url'=>'https://puskesmasdau.malangkab.go.id'],
    ['nama'=>'Kecamatan Dau','url'=>'https://dau.malangkab.go.id'],
    ['nama'=>'LAPOR! Kabupaten Malang','url'=>'https://lapor.go.id'],
  ];
  TautanTerkait::insert($data);

TODO 2.16 — SettingSeeder.php
  $settings = [
    ['key'=>'nama_desa','value'=>'Desa Selorejo'],
    ['key'=>'nama_pemerintah','value'=>'Pemerintah Desa Selorejo'],
    ['key'=>'kecamatan','value'=>'Kecamatan Dau'],
    ['key'=>'kabupaten','value'=>'Kabupaten Malang'],
    ['key'=>'provinsi','value'=>'Jawa Timur'],
    ['key'=>'alamat','value'=>'Jl. Raya Selorejo No. 1, Desa Selorejo, Kec. Dau, Kab. Malang 65151'],
    ['key'=>'telepon','value'=>'(0341) 123456'],
    ['key'=>'whatsapp','value'=>'081234567890'],
    ['key'=>'email','value'=>'desa.selorejo@gmail.com'],
    ['key'=>'jam_kerja','value'=>'Senin-Jumat: 08.00-15.00 WIB'],
    ['key'=>'facebook','value'=>'https://facebook.com/desaselorejo'],
    ['key'=>'instagram','value'=>'https://instagram.com/desaselorejo'],
    ['key'=>'youtube','value'=>''],
    ['key'=>'kode_pos','value'=>'65151'],
    ['key'=>'jumlah_penduduk','value'=>'3.640'],
    ['key'=>'jumlah_kk','value'=>'1.024'],
    ['key'=>'luas_wilayah','value'=>'623 Ha'],
    ['key'=>'jumlah_dusun','value'=>'2'],
  ];
  foreach ($settings as $s) {
    Setting::updateOrCreate(['key'=>$s['key']], ['value'=>$s['value']]);
  }

TODO 2.17 — JALANKAN SEEDER
Setelah semua seeder siap, jalankan:
  php artisan migrate:fresh --seed
Pastikan semua seeder berjalan tanpa error dan data berhasil masuk ke database.
```

---

### ▶ BLOK 3 — PERBAIKAN UI/UX + GLASSMORPHISM

```
TODO 3.1 — UPDATE FILE CSS UTAMA (resources/css/app.css)
Tambahkan/replace seluruh CSS dengan sistem desain berikut:

:root {
  --primary: #2d6a4f;
  --primary-dark: #1b4332;
  --primary-light: #52b788;
  --secondary: #74c69d;
  --accent: #f4a261;
  --accent-dark: #e76f51;
  --bg-light: #f0f7f4;
  --text-dark: #1b4332;
  --text-muted: #6c757d;
  --glass-bg: rgba(255, 255, 255, 0.15);
  --glass-border: rgba(255, 255, 255, 0.25);
  --glass-shadow: 0 8px 32px rgba(45, 106, 79, 0.15);
}

/* GLASSMORPHISM COMPONENTS */
.glass-card {
  background: rgba(255, 255, 255, 0.72);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border: 1px solid rgba(255, 255, 255, 0.5);
  border-radius: 16px;
  box-shadow: 0 8px 32px rgba(45, 106, 79, 0.12);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.glass-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 16px 40px rgba(45, 106, 79, 0.2);
}
.glass-navbar {
  background: rgba(27, 67, 50, 0.92) !important;
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border-bottom: 1px solid rgba(116, 198, 157, 0.3);
}
.glass-hero {
  background: linear-gradient(135deg, rgba(45,106,79,0.85) 0%, rgba(27,67,50,0.9) 100%);
  backdrop-filter: blur(4px);
}
.glass-stat {
  background: rgba(255,255,255,0.85);
  backdrop-filter: blur(12px);
  border: 1px solid rgba(116,198,157,0.4);
  border-radius: 12px;
  box-shadow: 0 4px 16px rgba(45,106,79,0.1);
  transition: all 0.3s ease;
}
.glass-stat:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 24px rgba(45,106,79,0.18);
  border-color: rgba(116,198,157,0.7);
}

/* BUTTONS — SEMUA HARUS ADA HOVER EFFECT */
.btn-primary-custom {
  background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
  color: white;
  border: none;
  border-radius: 8px;
  padding: 10px 24px;
  font-weight: 500;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}
.btn-primary-custom::before {
  content: '';
  position: absolute;
  top: 0; left: -100%;
  width: 100%; height: 100%;
  background: linear-gradient(135deg, rgba(255,255,255,0.2), transparent);
  transition: left 0.4s ease;
}
.btn-primary-custom:hover::before { left: 100%; }
.btn-primary-custom:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(45,106,79,0.35);
}
.btn-primary-custom:active { transform: translateY(0); }

.btn-accent-custom {
  background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
  color: white; border: none; border-radius: 8px;
  padding: 10px 24px; font-weight: 500;
  transition: all 0.3s ease;
}
.btn-accent-custom:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(244,162,97,0.4);
  color: white;
}
.btn-outline-custom {
  background: transparent;
  color: var(--primary);
  border: 2px solid var(--primary);
  border-radius: 8px; padding: 10px 24px; font-weight: 500;
  transition: all 0.3s ease;
}
.btn-outline-custom:hover {
  background: var(--primary);
  color: white;
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(45,106,79,0.25);
}

/* SECTION STYLES */
.section-hero-gradient {
  background: linear-gradient(135deg, #1b4332 0%, #2d6a4f 50%, #40916c 100%);
  min-height: 85vh;
  position: relative;
  overflow: hidden;
}
.section-hero-gradient::before {
  content: '';
  position: absolute; inset: 0;
  background: url('data:image/svg+xml,...') center/cover;
  opacity: 0.05;
}
.section-bg-pattern {
  background-color: var(--bg-light);
  background-image: radial-gradient(circle at 25% 25%, rgba(116,198,157,0.15) 0%, transparent 50%),
    radial-gradient(circle at 75% 75%, rgba(244,162,97,0.1) 0%, transparent 50%);
}
.section-green { background: linear-gradient(135deg, #1b4332 0%, #2d6a4f 100%); }

/* CARDS */
.card-hover {
  transition: all 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  border: none;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 2px 12px rgba(0,0,0,0.08);
}
.card-hover:hover {
  transform: translateY(-6px);
  box-shadow: 0 16px 40px rgba(45,106,79,0.18);
}
.card-hover img {
  transition: transform 0.4s ease;
}
.card-hover:hover img { transform: scale(1.05); }

/* NAVIGATION */
.nav-link-custom {
  color: rgba(255,255,255,0.85) !important;
  font-weight: 500;
  transition: color 0.2s ease;
  position: relative;
}
.nav-link-custom::after {
  content: '';
  position: absolute;
  bottom: -2px; left: 0;
  width: 0; height: 2px;
  background: var(--accent);
  transition: width 0.3s ease;
}
.nav-link-custom:hover {
  color: white !important;
}
.nav-link-custom:hover::after,
.nav-link-custom.active::after { width: 100%; }

/* STATS COUNTER */
.stat-counter {
  font-size: 2.5rem;
  font-weight: 700;
  color: var(--primary);
  line-height: 1;
}

/* BADGE KATEGORI */
.badge-kategori {
  background: linear-gradient(135deg, var(--secondary) 0%, var(--primary-light) 100%);
  color: white;
  border-radius: 20px;
  padding: 4px 12px;
  font-size: 0.75rem;
  font-weight: 600;
}

/* TIMELINE */
.timeline-item::before {
  content: '';
  position: absolute;
  left: -1px; top: 0; bottom: -20px;
  width: 2px;
  background: linear-gradient(to bottom, var(--primary), transparent);
}

/* SCROLL BEHAVIOR */
html { scroll-behavior: smooth; }

/* RESPONSIVE IMAGES */
.img-cover {
  width: 100%; height: 100%;
  object-fit: cover;
}

/* FOOTER */
.footer-glass {
  background: linear-gradient(135deg, #0d2b1e 0%, #1b4332 100%);
  color: rgba(255,255,255,0.8);
}

/* SIDEBAR WIDGET */
.widget-card {
  background: white;
  border-radius: 12px;
  border: 1px solid rgba(116,198,157,0.3);
  overflow: hidden;
  box-shadow: 0 2px 12px rgba(45,106,79,0.08);
}
.widget-header {
  background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
  color: white;
  padding: 12px 16px;
  font-weight: 600;
  font-size: 0.9rem;
}

/* OPERATOR DASHBOARD */
.dash-card {
  border-radius: 16px;
  border: none;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  transition: all 0.3s ease;
}
.dash-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 30px rgba(0,0,0,0.12);
}
.dash-sidebar {
  background: linear-gradient(180deg, #1b4332 0%, #2d6a4f 100%);
  min-height: 100vh;
}
.dash-sidebar .nav-link {
  color: rgba(255,255,255,0.75);
  border-radius: 8px;
  margin: 2px 8px;
  transition: all 0.2s ease;
  display: flex; align-items: center; gap: 10px;
}
.dash-sidebar .nav-link:hover,
.dash-sidebar .nav-link.active {
  background: rgba(255,255,255,0.15);
  color: white;
}

/* LUCIDE ICONS — KONSISTEN */
.icon-sm { width: 16px; height: 16px; }
.icon-md { width: 20px; height: 20px; }
.icon-lg { width: 24px; height: 24px; }
.icon-xl { width: 32px; height: 32px; }

/* FORM ELEMENTS */
.form-control-custom {
  border: 1.5px solid rgba(116,198,157,0.4);
  border-radius: 8px;
  padding: 10px 14px;
  transition: border-color 0.2s ease, box-shadow 0.2s ease;
}
.form-control-custom:focus {
  border-color: var(--primary);
  box-shadow: 0 0 0 3px rgba(45,106,79,0.15);
  outline: none;
}

/* ALERT CUSTOM */
.alert-success-custom {
  background: rgba(116,198,157,0.15);
  border: 1px solid rgba(116,198,157,0.4);
  color: var(--primary-dark);
  border-radius: 10px;
}

/* LOADING ANIMATION */
.skeleton {
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200% 100%;
  animation: skeleton-loading 1.5s infinite;
  border-radius: 6px;
}
@keyframes skeleton-loading {
  0% { background-position: 200% 0; }
  100% { background-position: -200% 0; }
}

/* RESPONSIVE */
@media (max-width: 768px) {
  .stat-counter { font-size: 1.8rem; }
  .section-hero-gradient { min-height: 65vh; }
  .glass-card { border-radius: 12px; }
}

TODO 3.2 — UPDATE LAYOUT PUBLIK (resources/views/layouts/public.blade.php)
Pastikan layout menggunakan struktur ini:
- Top Bar: background hijau tua, tampilkan hari/tanggal (real-time via JS), 
  dan icon sosmed dari Settings
- Navbar: gunakan class glass-navbar, logo desa di kiri, menu navigasi di kanan
  dengan dropdown hover. Gunakan Lucide icons di setiap menu item.
- Import Lucide via CDN: <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
- Setelah body tutup: <script>lucide.createIcons();</script>
- Semua nav-link menggunakan class nav-link-custom
- Active state otomatis berdasarkan route current

TODO 3.3 — UPDATE HALAMAN BERANDA (resources/views/public/beranda.blade.php)
Pastikan beranda memiliki struktur LENGKAP:
  A) HERO SECTION:
     - Full-width hero dengan class section-hero-gradient
     - Teks overlay: "Selamat Datang di Desa Wisata Petik Jeruk Selorejo"
     - Sub-teks: "Kecamatan Dau, Kabupaten Malang, Jawa Timur"
     - 2 tombol CTA: "Jelajahi Wisata" (btn-accent-custom) + "Profil Desa" (btn-outline-custom)
     - Gambar jeruk/kebun di sisi kanan (Unsplash URL)
     - Background floating shapes/blob dengan CSS
  B) STATS BAR (4 angka dari Settings):
     - Total Penduduk, Jumlah KK, Luas Wilayah, Jumlah Dusun
     - Gunakan class glass-stat dengan icon Lucide yang relevan:
       users (penduduk), home (KK), map (luas), layout (dusun)
  C) SAMBUTAN KEPALA DESA:
     - Foto Kades + nama + sambutan dari WidgetAparat
     - Layout 2 kolom: foto kiri, teks kanan
     - Gunakan glass-card
  D) SHORTCUT LAYANAN CEPAT (4 card icon):
     - Lokasi Wisata (MapPin icon)
     - Hubungi Desa (Phone icon)
     - Produk Desa (ShoppingBag icon)
     - Galeri Foto (Image icon)
     - Setiap card gunakan card-hover + icon Lucide besar + label
  E) POTENSI WISATA (Section dengan background hijau):
     - Heading: "Wisata Petik Jeruk Keprok"
     - Deskripsi singkat dari tabel wisata
     - Foto Unsplash relevan + button "Selengkapnya"
  F) PRODUK UNGGULAN (Grid 3 kolom):
     - Ambil 3 produk terbaru dari DB
     - Card dengan gambar, nama, harga, tombol beli
     - Gunakan card-hover
  G) BERITA TERBARU (Grid 3 kolom):
     - Ambil 3 berita publish terbaru dari DB
     - Card dengan gambar, badge kategori, judul, tanggal, excerpt
     - Gunakan card-hover
  H) WIDGET POLLING (Sidebar-style di dalam section):
     - Tampilkan polling aktif
     - Tombol Ya/Tidak dengan form POST + CSRF
     - Progress bar persentase hasil
  I) GALERI PREVIEW:
     - Grid 6 foto dari tabel galeri
     - Hover effect + lightbox sederhana
  J) PETA GOOGLE MAPS:
     - Embed dari tabel profiles.peta_embed
  K) TAUTAN TERKAIT:
     - Daftar link dari tabel tautan_terkait

TODO 3.4 — UPDATE SEMUA HALAMAN PUBLIK LAINNYA
Pastikan setiap halaman berikut tidak ada area yang kosong/melompong:

  /profil/sejarah      → Teks sejarah dari DB + timeline visual + foto desa
  /profil/visi-misi    → Card visi, list misi dengan icon check Lucide
  /profil/geografis    → Stats box 4 item + tabel batas wilayah + peta embed
  /pemerintahan/struktur → Bagan hierarki dengan card foto+nama+jabatan
  /pemerintahan/bpd    → Grid card anggota BPD dengan foto placeholder
  /pemerintahan/lembaga → Card per lembaga (LPMD, Karang Taruna, PKK, Linmas)
  /wisata              → Hero wisata, detail lengkap, harga, jadwal, aturan, galeri wisata
  /produk              → Grid 3 kolom produk dengan foto, harga, stok badge
  /galeri              → Grid masonry/3 kolom foto dengan filter kategori (JS)
  /statistik           → 5 chart Chart.js (gender pie, usia bar, pendidikan doughnut, 
                          pekerjaan bar, agama pie) — data dari DB
  /transparansi        → APBDes: summary cards (total pendapatan vs belanja), 
                          chart belanja per bidang (Chart.js bar), link download PDF
  /berita              → Grid kartu berita dengan filter kategori
  /berita/{slug}       → Detail berita dengan gambar header, konten HTML, breadcrumb
  /kontak              → Info kontak (icon Lucide), embed maps, form pesan

TODO 3.5 — IMPLEMENTASI CHART.JS DI HALAMAN STATISTIK
Pastikan halaman /statistik menampilkan 5 chart yang benar-benar berfungsi:
  Data diambil dari controller: StatistikPenduduk::where('tahun',2024)->get()
  Di-pass ke view sebagai JSON untuk Chart.js.
  
  Chart 1 (Pie): Gender — label: ['Laki-laki','Perempuan'], warna: ['#2d6a4f','#74c69d']
  Chart 2 (Bar): Kelompok Usia — gradient hijau
  Chart 3 (Doughnut): Tingkat Pendidikan — warna spectrum hijau-oranye
  Chart 4 (Horizontal Bar): Pekerjaan — sorted descending
  Chart 5 (Pie): Agama — warna netral elegan
  
  Setiap chart gunakan:
  - responsive: true
  - maintainAspectRatio: false (container height: 300px)
  - plugin legend di bawah chart
  - tooltip yang informatif
  - animasi fade-in

TODO 3.6 — IMPLEMENTASI CHART.JS DI TRANSPARANSI APBDes
  Chart belanja per bidang (horizontal bar atau doughnut)
  Data: Apbdes::where('tahun',2024)->where('jenis','belanja')->get()
  Summary card: Total Pendapatan vs Total Belanja vs Sisa Anggaran
  Format angka rupiah: Rp 1.713.450.000 → format dengan number_format()

TODO 3.7 — PASTIKAN SEMUA BUTTON DI SELURUH HALAMAN PUNYA HOVER EFFECT
Scan SELURUH view publik dan operator/admin. Setiap <a>, <button>, <input[type=submit]>:
  - Harus punya class yang mengandung CSS transition
  - Harus punya efek :hover (warna berubah ATAU translate ATAU shadow)
  - Harus ada cursor: pointer
Tambahkan class yang sesuai jika belum ada.
```

---

### ▶ BLOK 4 — LUCIDE ICONS — AUDIT & PERBAIKAN MENYELURUH

```
TODO 4.1 — PASTIKAN LUCIDE DIMUAT VIA CDN DI SEMUA LAYOUT
Di layouts/public.blade.php dan layouts/operator.blade.php dan layouts/admin.blade.php:
  Tambahkan sebelum </body>:
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
  <script>lucide.createIcons();</script>

TODO 4.2 — GANTI SEMUA ICON YANG TIDAK ADA / TIDAK RELEVAN
Scan seluruh view. Dimana ada placeholder icon atau tidak ada icon sama sekali,
tambahkan icon Lucide yang relevan dengan format:
  <i data-lucide="nama-icon" class="icon-md"></i>

Mapping wajib untuk NAVBAR:
  Beranda      → <i data-lucide="home">
  Profil Desa  → <i data-lucide="info">
  Pemerintahan → <i data-lucide="users">
  Wisata       → <i data-lucide="map-pin">
  Produk       → <i data-lucide="shopping-bag">
  Galeri       → <i data-lucide="image">
  Statistik    → <i data-lucide="bar-chart-2">
  Transparansi → <i data-lucide="file-text">
  Berita       → <i data-lucide="newspaper">
  Kontak       → <i data-lucide="mail">

Mapping untuk DASHBOARD OPERATOR sidebar:
  Dashboard    → <i data-lucide="layout-dashboard">
  Profil Desa  → <i data-lucide="globe">
  Pemerintahan → <i data-lucide="landmark">
  Wisata       → <i data-lucide="tent">
  Produk       → <i data-lucide="package">
  Galeri       → <i data-lucide="camera">
  Statistik    → <i data-lucide="trending-up">
  APBDes       → <i data-lucide="coins">
  Berita       → <i data-lucide="pen-square">
  Polling      → <i data-lucide="check-square">
  Widget       → <i data-lucide="layout">
  Pesan        → <i data-lucide="message-square">
  Password     → <i data-lucide="key">
  Logout       → <i data-lucide="log-out">

Mapping untuk DASHBOARD ADMIN sidebar:
  Dashboard    → <i data-lucide="shield">
  Operator     → <i data-lucide="user-cog">
  Backup       → <i data-lucide="database">
  Log          → <i data-lucide="clipboard-list">
  Pengaturan   → <i data-lucide="settings">

Mapping untuk HALAMAN KONTAK:
  Alamat       → <i data-lucide="map-pin">
  Telepon      → <i data-lucide="phone">
  WhatsApp     → <i data-lucide="message-circle">
  Email        → <i data-lucide="mail">
  Jam Kerja    → <i data-lucide="clock">

Mapping untuk CARDS PRODUK:
  Stok Tersedia → <i data-lucide="check-circle" style="color:green">
  Stok Habis    → <i data-lucide="x-circle" style="color:red">
  Harga         → <i data-lucide="tag">

TODO 4.3 — WARNA ICON HARUS KONTRAS DAN VISIBLE
Pastikan semua icon memiliki warna yang jelas:
  - Icon di navbar: color: rgba(255,255,255,0.9)
  - Icon di dashboard sidebar: color: rgba(255,255,255,0.8)
  - Icon di card publik: color: var(--primary)
  - Icon di tombol: inherit dari warna tombol
  - Jangan biarkan icon berwarna default (hitam) di atas background gelap
```

---

### ▶ BLOK 5 — ALUR OPERATOR & ADMIN (VERIFIKASI FUNGSIONAL PENUH)

```
TODO 5.1 — VERIFIKASI ALUR LOGIN
File: resources/views/auth/login.blade.php
Pastikan form login memiliki:
  - Logo desa di atas form
  - Field email + icon mail Lucide
  - Field password + icon lock Lucide + tombol toggle show/hide password
  - Tombol "Masuk" dengan btn-primary-custom + hover effect
  - Validasi error ditampilkan dengan alert merah
  - Redirect: admin → /admin/dashboard, operator → /operator/dashboard
  - CSRF @csrf wajib ada
  - Link "Lupa Password" (opsional, bisa disabled)

TODO 5.2 — VERIFIKASI DASHBOARD OPERATOR
File: resources/views/operator/dashboard.blade.php
Harus menampilkan:
  A) 4 KARTU STATISTIK (dengan icon Lucide + angka dari DB):
     - Total Berita (Publish): Berita::where('status_publish','publish')->count()
     - Total Produk: Produk::count()
     - Total Foto Galeri: Galeri::where('tipe','foto')->count()
     - Pesan Belum Dibaca: KontakMessage::where('status_baca','belum')->count()
  B) AKTIVITAS TERBARU:
     - 5 berita terbaru dengan status badge (publish/draft)
     - 5 pesan masuk terbaru dengan status badge (belum/sudah dibaca)
  C) GRAFIK MINI: Bar chart 6 bulan terakhir jumlah berita publish (Chart.js sederhana)
  D) Tombol shortcut: "Tulis Berita Baru", "Upload Foto Galeri", "Lihat Pesan"

TODO 5.3 — VERIFIKASI SEMUA FORM CRUD OPERATOR
Untuk setiap modul (Berita, Produk, Galeri, Statistik, APBDes, Polling, dll):
  - Form create: semua field ada, validasi ada, upload gambar/PDF ada
  - Form edit: data ter-populate dari DB, UPDATE berfungsi
  - Delete: ada konfirmasi modal sebelum hapus, icon trash Lucide
  - List/index: tabel responsif, ada pagination jika >10 item, ada tombol edit+hapus
  - Flash message sukses/error tampil setelah operasi
  - Semua button submit ada hover effect

TODO 5.4 — VERIFIKASI DASHBOARD ADMIN
File: resources/views/admin/dashboard.blade.php
Harus menampilkan:
  A) 4 KARTU: Total Operator, Total Berita, Total Pesan, Last Backup Date
  B) TABEL OPERATOR: daftar operator dengan tombol edit+hapus+reset password
  C) LOG AKTIVITAS TERBARU: 10 log terakhir

TODO 5.5 — VERIFIKASI MANAJEMEN OPERATOR (Admin)
Halaman /admin/operator:
  - Tabel semua operator (nama, email, dibuat kapan, aksi)
  - Tombol "Tambah Operator Baru" → form create
  - Tombol edit → form edit (nama, email, password opsional)
  - Tombol hapus → konfirmasi modal → hard delete
  - Validasi: email unique, password min 8 karakter

TODO 5.6 — VERIFIKASI FITUR BACKUP (Admin)
Halaman /admin/backup:
  - Tombol "Ekspor Database SQLite" yang mendownload file database.sqlite
  - Karena SQLite = satu file, backup cukup dengan:
    return response()->download(database_path('database.sqlite'), 
      'backup-selorejo-'.date('Y-m-d').'.sqlite');
  - Tampilkan riwayat backup jika tersimpan di Settings

TODO 5.7 — VERIFIKASI LOG AKTIVITAS
Halaman /admin/log:
  - Tabel log dari ActivityLog::with('user')->latest()->paginate(20)
  - Kolom: No, Nama User, Aksi, Waktu
  - Filter berdasarkan user (dropdown) opsional
  - Pastikan ActivityLog::create() dipanggil di setiap action operator penting:
    store, update, destroy di semua controller operator

TODO 5.8 — VERIFIKASI PENGATURAN SISTEM (Admin)
Halaman /admin/pengaturan:
  - Form dengan semua key dari SettingSeeder
  - Grouped: Identitas Desa, Kontak, Media Sosial
  - Setelah save, redirect back with success message
  - Data tersimpan ke tabel settings (updateOrCreate per key)
  - Footer dan header publik otomatis menggunakan data terbaru dari settings
```

---

### ▶ BLOK 6 — FOTO & MEDIA (OPEN SOURCE PHOTOS)

```
TODO 6.1 — BUAT HELPER UNTUK FOTO PLACEHOLDER YANG RELEVAN
Di seluruh view, jika foto dari DB null/kosong, gunakan foto dari Unsplash 
dengan parameter yang relevan (BUKAN via.placeholder.com yang jelek):

Buat fungsi helper getPlaceholderPhoto($context):
  'wisata'      → 'https://images.unsplash.com/photo-1611080626919-7cf5a9dbab12?w=600&q=80'
  'produk'      → 'https://images.unsplash.com/photo-1560472355-536de3962603?w=400&q=80'
  'berita'      → 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=800&q=80'
  'kades'       → 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&q=80'
  'aparatur'    → 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=300&q=80'
  'aparatur_f'  → 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=300&q=80'
  'galeri'      → 'https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=600&q=80'
  'desa'        → 'https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?w=800&q=80'

TODO 6.2 — BERANDA HERO — BACKGROUND VISUAL YANG MENARIK
Di hero section beranda, tambahkan gambar overlay menggunakan Unsplash:
  background-image: url('https://images.unsplash.com/photo-1611080626919-7cf5a9dbab12?w=1400&q=80');
  background-size: cover; background-position: center;
  + overlay gradient hijau gelap di atas gambar

TODO 6.3 — WISATA PAGE — GALERI MINI FOTO WISATA
Di halaman /wisata, tambahkan grid 3 foto mini dari Unsplash (tema kebun jeruk/petik buah):
  - photo-1582979512210-99b6a53386f9 (petik jeruk)
  - photo-1628868800-4a58db39f4f7 (kebun buah)
  - photo-1627483297886-49710ae1fc22 (panen)

TODO 6.4 — FOTO PROFIL APARATUR — GENDER-AWARE PLACEHOLDER
Untuk StrukturOrganisasi dan BPD yang tidak punya foto:
  Gunakan DiceBear avatars (open source, no copyright):
  'https://api.dicebear.com/7.x/initials/svg?seed=[nama_pejabat]&backgroundColor=2d6a4f&color=ffffff'
  Ini menghasilkan avatar dengan inisial nama, hijau sesuai tema, professional.
```

---

### ▶ BLOK 7 — BUG HUNTING & ERROR PREVENTION

```
TODO 7.1 — VALIDASI SEMUA QUERY ELOQUENT — NULL SAFE
Scan semua controller. Pastikan setiap query yang hasilnya bisa null
menggunakan null coalescing atau conditional:
  - Profile::first() → bisa null jika belum ada seeder → $profile = Profile::first(); 
    Jika null di view: {{ $profile?->sejarah ?? 'Informasi sedang disiapkan.' }}
  - WidgetAparat::first() → $widget = WidgetAparat::first();
  - Polling::where('is_active',true)->first() → bisa null
  - Setting: buat helper function: setting('key','default')
    function setting($key, $default = '') {
      return Setting::where('key',$key)->value('value') ?? $default;
    }
    Daftarkan di Helpers file.

TODO 7.2 — CEGAH N+1 QUERY
Gunakan eager loading di semua query yang ada relasi:
  - ActivityLog::with('user')->latest()->paginate(20) ✓
  - Jangan foreach $logs as $log → $log->user->name (N+1 problem)

TODO 7.3 — VALIDASI SEMUA FORM INPUT
Setiap controller store/update WAJIB menggunakan $request->validate([]):
  Pastikan:
  - String field: 'required|string|max:N'
  - Email: 'required|email'
  - File gambar: 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
  - File PDF: 'nullable|mimes:pdf|max:5120'
  - Enum field: 'required|in:nilai1,nilai2'
  - Integer/Decimal: 'nullable|numeric|min:0'
  - Date: 'nullable|date'
  - Slug: di BeritaController, auto-generate dari judul menggunakan Str::slug()

TODO 7.4 — CSRF PROTECTION
Scan SEMUA form POST/PUT/PATCH/DELETE:
  Setiap form WAJIB ada @csrf dan jika edit: @method('PUT') atau @method('DELETE')
  Setiap tombol hapus: gunakan form POST dengan @method('DELETE'), bukan link GET biasa.

TODO 7.5 — STORAGE SYMLINK & UPLOAD
Pastikan php artisan storage:link sudah dijalankan.
Di .env: FILESYSTEM_DISK=public
Di config/filesystems.php: default disk = 'public'
Pastikan folder storage/app/public/ dan subfolder-nya sudah ada.
Buat file .gitkeep di setiap subfolder agar tidak hilang saat push.

TODO 7.6 — ROUTE MODEL BINDING — BERITA BY SLUG
Pastikan BeritaController@show mengambil berita by slug:
  public function show($slug) {
    $berita = Berita::where('slug',$slug)->where('status_publish','publish')->firstOrFail();
    return view('public.berita.show', compact('berita'));
  }
  Route: Route::get('/berita/{slug}', [BeritaController::class,'show']);

TODO 7.7 — PAGINATION
Semua halaman yang menampilkan list data menggunakan ->paginate(N):
  - /berita: paginate(9)
  - /produk: paginate(12)
  - /galeri: paginate(12)
  - /operator/berita: paginate(15)
  - /admin/log: paginate(20)
  Tambahkan {{ $items->links() }} di bawah setiap tabel/grid.

TODO 7.8 — 404 DAN ERROR HANDLING
Buat custom 404 page: resources/views/errors/404.blade.php
Tampilkan pesan "Halaman tidak ditemukan" dengan link kembali ke beranda.
Gunakan extends layout publik.

TODO 7.9 — FORM KONTAK — VALIDASI & RATE LIMITING
KontakController@kirim:
  - Validate: nama required|string|max:100, email required|email, pesan required|string|max:1000
  - Save ke DB: KontakMessage::create([...])
  - Redirect back with success: return redirect('/kontak')->with('success','Pesan berhasil terkirim!')
  - Route: ->middleware('throttle:5,1') untuk cegah spam
  - Tampilkan @if(session('success')) alert sukses di view /kontak

TODO 7.10 — MIDDLEWARE AUTH CEK
Pastikan middleware auth menggunakan session-based Auth Laravel:
  - Login: Auth::attempt(['email'=>$req->email,'password'=>$req->password])
  - Logout: Auth::logout(); Session::invalidate(); Session::regenerateToken();
  - Redirect setelah login: berdasarkan role (admin/operator)
  - Jika belum login akses /operator/* → redirect ke /login
  - Jika operator akses /admin/* → redirect ke /operator/dashboard (403 atau redirect)

TODO 7.11 — KONSISTENSI WARNA TEKS DI SELURUH HALAMAN
Scan seluruh view. Pastikan tidak ada teks yang warnanya:
  - Terlalu terang di background terang (tidak keliatan)
  - Terlalu gelap di background gelap (tidak keliatan)
  Gunakan color contrast checker mental: minimal ratio 4.5:1.
  Gunakan CSS variable: color: var(--text-dark) untuk teks utama,
  color: var(--text-muted) untuk teks sekunder.

TODO 7.12 — RESPONSIVENESS CEK
Test di tiga breakpoint Bootstrap:
  - Mobile (< 576px): navbar collapse berfungsi, grid 1 kolom, font ukuran tepat
  - Tablet (768px): grid 2 kolom, hero masih bagus
  - Desktop (1200px): layout penuh
Pastikan tidak ada overflow horizontal di mana pun.
Gunakan: .img-fluid, col-12 col-md-6 col-lg-4 secara konsisten.
```

---

### ▶ BLOK 8 — OPTIMASI FINAL

```
TODO 8.1 — META TAG SEO
Di layouts/public.blade.php, tambahkan di <head>:
  <meta name="description" content="@yield('meta_description', 'Website resmi Desa Wisata Petik Jeruk Selorejo, Kecamatan Dau, Kabupaten Malang. Informasi wisata, profil desa, transparansi, dan berita terbaru.')">
  <meta name="keywords" content="@yield('meta_keywords', 'wisata petik jeruk, Selorejo, Kecamatan Dau, Kabupaten Malang, agrowisata, jeruk keprok')">
  <meta property="og:title" content="@yield('title', 'Desa Wisata Selorejo') — Website Resmi">
  <meta property="og:description" content="@yield('meta_description')">
  <meta name="author" content="Pemerintah Desa Selorejo">

TODO 8.2 — TITLE DINAMIS
Setiap halaman menggunakan: @section('title', 'Nama Halaman')
Layout: <title>@yield('title', 'Beranda') | Desa Wisata Selorejo</title>

TODO 8.3 — FAVICON
Buat favicon menggunakan emoji jeruk atau ikon daun.
Buat file public/favicon.ico dengan SVG sederhana atau gunakan favicon generator.
Tambahkan di layout: <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

TODO 8.4 — JALANKAN OPTIMASI
Setelah semua selesai, jalankan secara berurutan:
  php artisan config:clear
  php artisan cache:clear
  php artisan view:clear
  php artisan route:clear
  php artisan migrate:fresh --seed
  php artisan storage:link
  npm run build

TODO 8.5 — FINAL SELF-TEST CHECKLIST
Buka browser dan test SATU PER SATU:
  [ ] GET / — beranda tampil lengkap, hero OK, stats OK, berita OK
  [ ] GET /profil/sejarah — teks dari DB muncul
  [ ] GET /pemerintahan/struktur — card aparatur muncul dengan avatar
  [ ] GET /wisata — info wisata lengkap
  [ ] GET /produk — 6 produk tampil dengan harga
  [ ] GET /galeri — 12 foto galeri tampil dalam grid
  [ ] GET /statistik — 5 chart Chart.js tampil dan berisi data
  [ ] GET /transparansi — total APBDes tampil + chart belanja
  [ ] GET /berita — 8 berita tampil dalam grid
  [ ] GET /berita/kunjungan-wisatawan-meningkat-40-persen-musim-panen-2025 — detail OK
  [ ] GET /kontak — form + info kontak + peta tampil
  [ ] POST /kontak/kirim — pesan tersimpan, sukses message tampil
  [ ] POST /polling/vote — vote tersimpan, hasil update
  [ ] GET /login — form login tampil bersih
  [ ] POST /login (admin) — redirect ke /admin/dashboard
  [ ] POST /login (operator) — redirect ke /operator/dashboard
  [ ] GET /operator/dashboard — 4 kartu stat tampil
  [ ] GET /operator/berita — list 8 berita tampil
  [ ] GET /operator/berita/create — form tampil lengkap
  [ ] POST /operator/berita — berita baru tersimpan
  [ ] GET /operator/berita/{id}/edit — data ter-populate
  [ ] DELETE /operator/berita/{id} — berita terhapus
  [ ] GET /admin/dashboard — tampil
  [ ] GET /admin/operator — list 1 operator tampil
  [ ] POST /admin/operator — tambah operator baru
  [ ] GET /admin/log — log aktivitas tampil
  [ ] GET /admin/backup — tombol download backup ada
  [ ] GET /admin/pengaturan — form setting tampil
  [ ] POST /admin/pengaturan — setting tersimpan
  [ ] POST /logout — redirect ke /login
Jika ada yang gagal, perbaiki hingga semua 200 OK.

TODO 8.6 — LAPORAN AKHIR
Setelah semua TODO selesai, buat laporan ringkas berformat:
  ✅ SELESAI: [daftar yang berhasil]
  ⚠️  CATATAN: [jika ada limitasi atau yang perlu follow-up manual]
  🔐 KREDENSIAL:
     Admin    → admin@selorejo.desa.id / admin123
     Operator → operator@selorejo.desa.id / operator123
  🌐 URL LOKAL: http://desa-selorejo-v2.test (Herd) atau http://localhost:8000
  📦 DATABASE: SQLite @ database/database.sqlite
```

---

## ═══════════════════════════════════════════════════
## PENUTUP — INSTRUKSI EKSEKUSI COPILOT
## ═══════════════════════════════════════════════════

```
PENTING — BACA SEBELUM MULAI:

1. Kerjakan BLOK 0 hingga BLOK 8 secara BERURUTAN. Jangan skip.
2. Setiap TODO dalam satu BLOK boleh dikerjakan secara paralel.
3. Jika suatu file sudah ada dan sudah benar, PERTAHANKAN. Jangan dihapus/diganti kecuali 
   ada instruksi spesifik untuk menggantinya.
4. Jika menemukan kode yang sudah ada namun perlu diperbaiki, PERBAIKI, jangan tulis ulang 
   dari nol kecuali benar-benar perlu.
5. Setelah BLOK 2 selesai (Seeder), LANGSUNG jalankan: php artisan migrate:fresh --seed
6. Setelah BLOK 3-4 selesai (CSS/UI), jalankan: npm run build
7. Setelah BLOK 7 selesai, jalankan: php artisan config:clear && php artisan view:clear
8. Database FINAL = SQLite. Jangan ada referensi MySQL tersisa di kode.

TUJUAN AKHIR:
Website Desa Wisata Petik Jeruk Selorejo harus bisa didemonstrasikan kepada perangkat 
Pemerintah Desa Selorejo sebagai website professional yang:
  ✓ Terisi data real dan lengkap (bukan lorem ipsum / kosong)
  ✓ Tampilan modern glassmorphism yang elegan dan tidak alay
  ✓ Semua button responsif dengan hover effect
  ✓ Semua chart Chart.js berfungsi menampilkan statistik
  ✓ Alur admin dan operator berjalan sempurna
  ✓ Tidak ada error, tidak ada halaman kosong
  ✓ Mobile friendly dan responsif di semua ukuran layar

MULAI SEKARANG. KERJAKAN SAMPAI SELESAI.
```

---
*Prompt Pamungkas v1.0 — Website Desa Wisata Petik Jeruk Selorejo*
*Ridwan Hakim Mashadi (K3523066) — KKN Tematik UNS 2026 — Desa Selorejo, Kec. Dau, Kab. Malang*
*Generated for GitHub Copilot Agent Mode (Bypass Approvals)*
