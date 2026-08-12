# Spesifikasi Fitur: Import Data Penduduk via Excel & Grafik Statistik Usia Otomatis
**Modul:** Operator Panel — Statistik Data Penduduk
**Proyek:** desa-selorejo-v2
**Target Route:** `/operator/statistik/data-penduduk`
**Role:** Operator (akses eksklusif, tidak boleh diakses publik maupun role lain)

---

## 1. Ringkasan Fitur

Operator dapat mengunggah file Excel berisi data kependudukan mentah dari sumber administrasi desa (misalnya rekap dari Dukcapil/RT-RW). Sistem akan otomatis:

1. Membaca dan memvalidasi struktur file Excel sesuai template yang ditentukan.
2. Melakukan import data ke database dengan mapping kolom otomatis.
3. Menghitung dan mengelompokkan penduduk ke dalam kategori usia.
4. Menghasilkan grafik statistik usia secara otomatis (auto-refresh setiap ada perubahan data).
5. Menyediakan antarmuka CRUD penuh (Create, Read, Update, Delete, Search) atas data yang sudah ter-import.

Fitur ini **hanya boleh diakses oleh role Operator**. Halaman publik/statistik-penduduk yang sudah ada di frontend tetap menampilkan hasil agregat (grafik), tapi tanpa data mentah/PII.

---

## 2. Format Template Excel

Kolom yang diterima sistem (urutan wajib sama persis dengan header berikut):

| No | Nama Kolom | Tipe Data | Wajib | Keterangan |
|----|------------|-----------|-------|------------|
| 1 | NKK | String (16 digit) | Ya | Nomor Kartu Keluarga |
| 2 | NIK | String (16 digit) | Ya | Nomor Induk Kependudukan, unik per baris |
| 3 | NAMA | String | Ya | Nama lengkap |
| 4 | TEMPAT LAHIR | String | Tidak | Isi `-` jika kosong |
| 5 | TANGGAL LAHIR | Date (format `DD/MM/YYYY`) | Tidak | Dipakai untuk hitung usia otomatis |
| 6 | STS KAWIN | Enum: `Kawin`, `Belum Kawin`, `Cerai Hidup`, `Cerai Mati` | Tidak | Isi `-` jika kosong |
| 7 | KELAMIN | Enum: `L`, `P` | Ya | |
| 8 | ALAMAT | String | Tidak | Isi `-` jika kosong |
| 9 | RT | String (2 digit) | Tidak | |
| 10 | RW | String (2 digit) | Tidak | |
| 11 | USIA | Integer | Tidak | Dipakai sebagai fallback jika TANGGAL LAHIR kosong/invalid |
| 12 | PEKERJAAN | String | Tidak | Isi `-` jika kosong |

**Aturan pengisian sel kosong:**
- Semua kolom teks yang kosong disimpan dan ditampilkan sebagai `-` (bukan `NULL` kosong di UI, walau di database boleh `NULL`).
- Kolom yang wajib (NKK, NIK, NAMA, KELAMIN) tidak boleh kosong — baris dengan kolom wajib kosong ditolak saat validasi dan dilaporkan ke operator sebagai baris gagal, bukan menghentikan seluruh proses import.

---

## 3. Struktur Database

Tabel: `data_penduduk`

```
id                  BIGINT UNSIGNED, PK, auto_increment
nkk                 VARCHAR(16), index
nik                 VARCHAR(16), unique, index
nama                VARCHAR(255)
tempat_lahir        VARCHAR(255), nullable
tanggal_lahir       DATE, nullable
status_kawin        VARCHAR(20), nullable
jenis_kelamin       ENUM('L','P')
alamat              TEXT, nullable
rt                  VARCHAR(2), nullable
rw                  VARCHAR(2), nullable
usia_input          SMALLINT UNSIGNED, nullable   -- usia asli dari Excel, dipakai sbg fallback
pekerjaan           VARCHAR(255), nullable
kelompok_usia       VARCHAR(30)                    -- hasil kalkulasi, di-cache agar query grafik cepat
sumber_import_id    BIGINT UNSIGNED, FK -> import_batches.id, nullable
created_by          BIGINT UNSIGNED, FK -> users.id
updated_by          BIGINT UNSIGNED, FK -> users.id
created_at / updated_at / deleted_at (soft delete)
```

Tabel pendukung: `import_batches` (mencatat setiap sesi upload — nama file, jumlah baris sukses, jumlah baris gagal, waktu, operator yang melakukan) agar setiap import bisa ditelusuri dan **di-rollback per batch** jika ternyata salah unggah.

---

## 4. Kalkulasi & Klasifikasi Usia

**Prioritas sumber usia:**
1. Jika `TANGGAL LAHIR` valid → hitung usia dari selisih tanggal hari ini dengan tanggal lahir (dihitung ulang otomatis setiap kali grafik ditampilkan, bukan nilai statis, supaya grafik tetap akurat seiring waktu).
2. Jika `TANGGAL LAHIR` kosong/tidak valid → gunakan nilai kolom `USIA` dari Excel sebagai fallback (dicatat sebagai `usia_input`, tidak dihitung ulang).
3. Jika keduanya kosong → baris masuk kategori "Usia Tidak Diketahui" dan **tidak dihitung dalam grafik**, tapi tetap tampil di tabel CRUD dengan usia `-`.

**Kelompok usia (sesuai kebutuhan):**

| Kelompok | Rentang |
|----------|---------|
| Balita | 0–1 Tahun |
| Anak Awal | 2–4 Tahun |
| Anak Pra-Sekolah | 5–6 Tahun |
| Anak Sekolah | 7–12 Tahun |
| Remaja Awal | 13–15 Tahun |
| Remaja Akhir | 16–18 Tahun |
| Dewasa/Produktif | 19–65 Tahun |
| Lansia | Di atas 65 Tahun |

Baris terakhir grafik/tabel menampilkan **JUMLAH TOTAL PENDUDUK** (hasil `COUNT` seluruh data valid, bukan penjumlahan manual antar kelompok, untuk menghindari selisih akibat data "Usia Tidak Diketahui").

---

## 5. Grafik Statistik Usia (Auto-generate)

- Grafik dibangun otomatis dari hasil agregasi tabel `data_penduduk` (query `GROUP BY kelompok_usia`), **bukan file statis** — jadi akan ter-update sendiri setiap ada tambah/edit/hapus/import data.
- Gunakan library chart yang **sudah dipakai di modul statistik penduduk existing** di proyek ini (cek implementasi yang sudah ada di halaman publik statistik agar konsisten style/warna, jangan menambah dependency chart library baru kalau sudah ada).
- Tipe grafik: bar chart per kelompok usia + persentase, ditambah ringkasan total di atas grafik.
- Grafik versi Operator (di halaman ini) dan grafik versi publik (di halaman statistik penduduk frontend) harus mengambil dari **query/endpoint yang sama** agar datanya selalu sinkron — hindari duplikasi logika kalkulasi usia di dua tempat berbeda.

---

## 6. Alur Sistem Import

1. **Upload** — Operator memilih file `.xlsx`/`.xls` di halaman `/operator/statistik/data-penduduk`.
2. **Validasi struktur** — Sistem cek header kolom sesuai template di atas. Jika header tidak cocok, tolak file di awal dengan pesan jelas kolom mana yang bermasalah (jangan proses sebagian).
3. **Parsing & validasi per baris** — Setiap baris divalidasi (NIK 16 digit, KELAMIN harus `L`/`P`, format tanggal, dsb).
4. **Preview sebelum commit** — Tampilkan ringkasan ke operator: berapa baris valid, berapa baris gagal beserta alasan gagalnya (misal "Baris 15: NIK tidak valid"), dan mana yang akan dianggap **data baru** vs **update data existing** (dicocokkan berdasarkan NIK).
5. **Konfirmasi commit** — Operator menekan tombol konfirmasi. Proses import dijalankan dalam **database transaction**: kalau ada error di tengah jalan, seluruh batch di-rollback, tidak ada data setengah-masuk.
6. **Hasil** — Sistem menampilkan ringkasan hasil import dan otomatis me-refresh grafik statistik usia.
7. **Riwayat import** — Setiap batch tercatat di `import_batches` dan bisa dilihat/di-rollback dari halaman riwayat import.

---

## 7. Fitur CRUD Data Penduduk

Setelah data ter-import, halaman ini juga berfungsi sebagai manajemen data penuh:

- **Read**: tabel data dengan pagination, search (nama/NIK/NKK), filter (RT, RW, kelompok usia, jenis kelamin, status kawin).
- **Create**: form tambah data manual satu-per-satu (untuk data susulan tanpa harus re-upload Excel).
- **Update**: edit per baris, termasuk koreksi data yang salah saat import.
- **Delete**: soft delete (data tidak hilang permanen, bisa dipulihkan operator lain jika salah hapus).
- Setiap perubahan (create/update/delete) otomatis memicu recalculation `kelompok_usia` dan refresh grafik.
- Log siapa yang membuat/mengubah data (`created_by`, `updated_by`) untuk akuntabilitas.

---

## 8. Kontrol Akses & Keamanan

Karena data ini berisi **PII (Personally Identifiable Information)** — NIK, NKK, alamat lengkap — perlakukan sebagai data sensitif:

1. **Middleware role**: route `/operator/statistik/data-penduduk*` wajib dibungkus middleware yang memverifikasi role Operator (bukan sekadar "sudah login"). Tolak akses dengan 403 untuk role lain (Kepala Desa, Sekdes, Kaur, dsb tidak otomatis dapat akses kecuali memang didesain begitu — konfirmasikan ke pihak desa role mana saja yang boleh).
2. **Tidak ada endpoint publik** yang mengembalikan data mentah tabel `data_penduduk` (NIK/NKK/alamat). Endpoint publik hanya boleh mengembalikan hasil agregat (jumlah per kelompok usia).
3. **Validasi file upload**: batasi tipe file (`.xlsx`, `.xls` saja), batasi ukuran maksimal, scan mime-type asli file (jangan percaya ekstensi nama file saja) untuk mencegah upload file berbahaya menyamar sebagai Excel.
4. **CSRF protection** aktif di form upload dan seluruh form CRUD.
5. **Rate limiting** pada endpoint upload untuk mencegah abuse.
6. **Enkripsi/masking di tampilan**: pertimbangkan menampilkan NIK/NKK terpotong (misal `35xx-xxxx-xxxx-1234`) di tabel daftar, dan hanya tampilkan lengkap saat detail/edit dibuka, untuk mengurangi risiko data ter-screenshot/terekspos tanpa sengaja.
7. **Audit trail**: catat siapa yang mengunggah file, mengubah, atau menghapus data, beserta timestamp — penting untuk pertanggungjawaban data kependudukan resmi desa.
8. **Backup sebelum import besar**: sistem otomatis membuat snapshot/backup tabel `data_penduduk` sebelum menjalankan import batch baru, supaya ada jalur pemulihan cepat kalau operator salah unggah file.
9. Pastikan file Excel yang sudah diunggah **tidak disimpan permanen di storage publik** — simpan di storage privat (bukan di folder yang bisa diakses via URL langsung).

---

## 9. Struktur Backend yang Disarankan

- **Migration**: `data_penduduk`, `import_batches`.
- **Model**: `DataPenduduk` (dengan accessor `getKelompokUsiaAttribute()` untuk kalkulasi dinamis dari `tanggal_lahir`), `ImportBatch`.
- **Form Request**: validasi terpisah untuk create/update manual dan untuk validasi baris saat import Excel.
- **Import class**: gunakan library import Excel yang sudah dipakai di proyek ini (cek dependency yang sudah ter-install di `composer.json`, jangan tambah library baru kalau sudah ada yang serupa).
- **Controller**: pisahkan concern — controller untuk upload/import, controller untuk CRUD, controller/endpoint terpisah untuk data agregat grafik (dipakai bareng oleh Operator & halaman publik).
- **Route**: semua di-nest di bawah prefix `/operator` dan grup middleware role Operator yang sudah dipakai untuk modul operator lain di proyek ini (ikuti pola middleware yang sudah ada, jangan buat middleware baru yang terpisah).

---

## 10. Checklist Sebelum Dianggap Selesai

- [ ] Header Excel yang tidak sesuai template ditolak dengan pesan error yang jelas, bukan crash/500.
- [ ] Baris dengan kolom wajib kosong ditolak per-baris (tidak menggagalkan seluruh file).
- [ ] Sel kosong yang bukan kolom wajib tampil sebagai `-` di UI.
- [ ] Grafik menghitung ulang otomatis setelah import, create, update, maupun delete.
- [ ] Total di grafik = `COUNT` aktual data valid, bukan penjumlahan manual antar kelompok usia.
- [ ] Halaman hanya bisa diakses role Operator — dicoba akses pakai akun role lain untuk memastikan ditolak (403).
- [ ] NIK duplikat saat import ditangani sebagai update, bukan baris baru duplikat.
- [ ] Import dibungkus transaction — gagal di tengah tidak menyisakan data setengah masuk.
- [ ] File yang diunggah tervalidasi mime-type-nya, bukan hanya ekstensi nama file.
- [ ] Endpoint publik statistik tidak pernah mengembalikan NIK/NKK/alamat mentah.
- [ ] Riwayat import (`import_batches`) tercatat dan bisa dilihat operator.
- [ ] Soft delete berfungsi — data terhapus masih bisa dipulihkan dari sisi database.

---

## 11. Catatan untuk Antigravity

Sebelum eksekusi, cocokkan spesifikasi ini dengan skill/konvensi yang sudah tersimpan di folder skills lokal proyek (`.agents/plugins/ECC/skills` atau `.agents/skills`, sesuaikan path yang berlaku) — khususnya untuk:
- Pola middleware role Operator yang sudah dipakai di modul operator lain (jangan reinvent).
- Library import Excel dan library chart yang sudah dipakai di modul statistik penduduk existing, agar konsisten dan tidak menambah dependency ganda.
- Konvensi penamaan migration/model yang sudah dipakai di proyek desa-selorejo-v2 sejauh ini.

Jika ada konflik antara spesifikasi ini dan konvensi yang sudah ada di proyek, ikuti konvensi proyek yang sudah berjalan dan sesuaikan dokumen ini.
