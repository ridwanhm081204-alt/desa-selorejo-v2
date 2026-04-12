-- SQL Dump Export (SQLite to MySQL Compatible)
-- Generated at: 2026-04-12 19:39:03

SET FOREIGN_KEY_CHECKS=0;

-- Table: migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `migration` VARCHAR(255) NOT NULL  ,
  `batch` INT NOT NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('1', '0001_01_01_000000_create_users_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('2', '0001_01_01_000001_create_cache_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('3', '0001_01_01_000002_create_jobs_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('4', '2026_04_10_114354_create_profiles_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('5', '2026_04_10_114354_create_struktur_organisasi_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('6', '2026_04_10_114355_create_bpd_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('7', '2026_04_10_114355_create_lembaga_desa_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('8', '2026_04_10_114355_create_wisata_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('9', '2026_04_10_114356_create_galeri_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('10', '2026_04_10_114356_create_produk_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('11', '2026_04_10_114356_create_statistik_penduduk_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('12', '2026_04_10_114357_create_apbdes_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('13', '2026_04_10_114357_create_berita_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('14', '2026_04_10_114357_create_polling_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('15', '2026_04_10_114358_create_kontak_messages_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('16', '2026_04_10_114358_create_tautan_terkait_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('17', '2026_04_10_114358_create_widget_aparat_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('18', '2026_04_10_114359_create_activity_logs_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('19', '2026_04_10_114359_create_settings_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('20', '2026_04_12_114551_add_tracking_columns_to_berita_table', '2');

-- Table: users
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL  ,
  `email` VARCHAR(255) NOT NULL  ,
  `role` VARCHAR(255) NOT NULL  ,
  `password` VARCHAR(255) NOT NULL  ,
  `remember_token` VARCHAR(255) NULL  ,
  `created_at` DATETIME NULL  ,
  `updated_at` DATETIME NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES ('1', 'Administrator', 'admin@selorejo.desa.id', 'admin', '$2y$12$X0BdEqmqw96O4E7lfq9dwOCuvXKr15LtmeQ88lLvl1krs9.FJps76', '28rDYdxPPVKdcjswpFIE9sZ5Kg8qphxjeJMbfi8fZwNXSmceCDP2dl6iZhrH', '2026-04-12 11:21:54', '2026-04-12 11:21:54');
INSERT INTO `users` (`id`, `name`, `email`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES ('2', 'Operator Desa', 'operator@selorejo.desa.id', 'operator', '$2y$12$ZA2RYW1glZf38ToBYVW7bOerpRdjLTgFIgweSFywESNUe/mW98Niu', NULL, '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `users` (`id`, `name`, `email`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES ('3', 'Test Operator', 'testop@selorejo.desa.id', 'operator', '$2y$12$TTb73nxONi7aBB6R3qrW.O1hi4Ap9rx7DFwXca19gdsyHWqEC0UrC', NULL, '2026-04-12 18:49:22', '2026-04-12 18:49:22');

-- Table: password_reset_tokens
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` VARCHAR(255) NOT NULL PRIMARY KEY ,
  `token` VARCHAR(255) NOT NULL  ,
  `created_at` DATETIME NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Table: sessions
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` VARCHAR(255) NOT NULL PRIMARY KEY ,
  `user_id` INT NULL  ,
  `ip_address` VARCHAR(255) NULL  ,
  `user_agent` TEXT NULL  ,
  `payload` TEXT NOT NULL  ,
  `last_activity` INT NOT NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('KzqQJJMx3Znf2g52wCHpy8Mi0IOWKmHpc7JDngHp', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSzV2cjNzanBzWVhjR3FRRjdvWnluWXdNclhaNEJHSjBRRzhLajg2eiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9kZXNhLXNlbG9yZWpvLXYyLnRlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjE2OiJyZWFjdGVkX2Jlcml0YV84IjtzOjQ6Imxpa2UiO30=', '1775972467');
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('AfGAF4p0Qn09clJ5Q0OtP2swi3YnMrD9KWZ1NmXW', '2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZmxKQk50SUp3T2lCWVU4Ym1mSVhPMVJwb0s4MU1lSGFpRUFiN1lodSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly9kZXNhLXNlbG9yZWpvLXYyLnRlc3Qvb3BlcmF0b3IvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', '1775972361');
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('rg3i0VwWUXG7SGosaBXZZqYPvwpO396NVkgoLhsr', '2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTmZPbW83VzZJMm12am1HQXZ4TmI5SmJ1bU9DelBYTFkxT3Rhb1Q4RyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ3OiJodHRwOi8vZGVzYS1zZWxvcmVqby12Mi50ZXN0L29wZXJhdG9yL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', '1775981947');
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('03NFna31Hf1o8MLzpK6x88P3cwB67OJmjsncR6R7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoianZteXY3YTJ0dkhBT0h0WDFzcW14bFFMZVlRR0JHUWlINXhWSmFDTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9kZXNhLXNlbG9yZWpvLXYyLnRlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', '1775981471');
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('q75aFWTsYciL4cEE9DNy0S8zQ6L9zW78flricdja', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.22.1 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM1VTQUxMaFpVRUFzWVhmM0F1a1dsOFlIV0JqcmRFR0hLS21sd0x6USI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9kZXNhLXNlbG9yZWpvLXYyLnRlc3QvP2hlcmQ9cHJldmlldyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', '1775991337');
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('7GbNLxbqJU5mN7ObV9FrEbLISdYLZazTPRQbHx2O', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibTdjeHhwY0VTaDVJc2k2VGE4cllLM2V4Rnd1MWM3cU5vb1NITGZ2bSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9kZXNhLXNlbG9yZWpvLXYyLnRlc3QvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', '1775995404');
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('bQnY3xeCIWwNImjmZQJ2wTwPKxi0MteRBUH5rh6Z', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVWhCajZKeVB4YkFZZEwzeDdJZFJscExkOE5OY0ZMeUJkZFpPaHN6TiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9kZXNhLXNlbG9yZWpvLXYyLnRlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', '1775997297');

-- Table: cache
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` VARCHAR(255) NOT NULL PRIMARY KEY ,
  `value` TEXT NOT NULL  ,
  `expiration` INT NOT NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Table: cache_locks
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` VARCHAR(255) NOT NULL PRIMARY KEY ,
  `owner` VARCHAR(255) NOT NULL  ,
  `expiration` INT NOT NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Table: jobs
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `queue` VARCHAR(255) NOT NULL  ,
  `payload` TEXT NOT NULL  ,
  `attempts` INT NOT NULL  ,
  `reserved_at` INT NULL  ,
  `available_at` INT NOT NULL  ,
  `created_at` INT NOT NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Table: job_batches
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` VARCHAR(255) NOT NULL PRIMARY KEY ,
  `name` VARCHAR(255) NOT NULL  ,
  `total_jobs` INT NOT NULL  ,
  `pending_jobs` INT NOT NULL  ,
  `failed_jobs` INT NOT NULL  ,
  `failed_job_ids` TEXT NOT NULL  ,
  `options` TEXT NULL  ,
  `cancelled_at` INT NULL  ,
  `created_at` INT NOT NULL  ,
  `finished_at` INT NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Table: failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `uuid` VARCHAR(255) NOT NULL  ,
  `connection` TEXT NOT NULL  ,
  `queue` TEXT NOT NULL  ,
  `payload` TEXT NOT NULL  ,
  `exception` TEXT NOT NULL  ,
  `failed_at` DATETIME NOT NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Table: profiles
DROP TABLE IF EXISTS `profiles`;
CREATE TABLE `profiles` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `sejarah` TEXT NULL  ,
  `visi_misi` TEXT NULL  ,
  `geografi` TEXT NULL  ,
  `batas_wilayah` TEXT NULL  ,
  `peta_embed` TEXT NULL  ,
  `created_at` DATETIME NULL  ,
  `updated_at` DATETIME NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `profiles` (`id`, `sejarah`, `visi_misi`, `geografi`, `batas_wilayah`, `peta_embed`, `created_at`, `updated_at`) VALUES ('1', 'Desa Selorejo, yang berakar dari nama kuno ''Watugedhe'', adalah entitas yang kaya akan sejarah dan mitologi batu peninggalan pendiri abad ke-18, Mbah H. Turejo dan Mbah Sayang. Berkembang dari sentra sayur murni, desa ini bermesraan dengan agrikultur buah sejak 1990an hingga diresmikan sebagai Desa Wisata Jeruk yang makmur (Selo-Rejo).', 'VISI: "Terwujudnya Tatanan Kehidupan Masyarakat Desa Selorejo yang Agamis, Demokratis, Mandiri, Bersih, Indah dan Aman" (SATATA GAMA KARTA RAHARJA).

MISI:
1. Membumikan nilai agama dan budaya.
2. Pemerintahan yang bersih dan siap melayani.
3. Roso rumongso handarbeni / saiyek saeko proyo.
4. Kualitas SDM unggul.
5. Kesejahteraan berbasis ekonomi sirkular jerukan.
6. Pelestarian lingungan.
7. Sinergitas instansi.', 'Desa Selorejo memiliki luas wilayah sekitar 623 hektare dengan ketinggian ekstrem antara 800-1.200 meter di atas permukaan laut. Kondisi topografi berbukit penuh perhutanan (2.068 Ha). Suhu sejuk rata-rata berkisar 18-26°C dengan curah hujan stabil sangat menopang kultur agrikultur 100%.', 'Utara: Desa Gading Kulon, Kec. Dau
Selatan: Desa Petung Sewu, Kec. Dau
Timur: Desa Tegalweru, Kec. Dau
Barat: Kawasan Hutan', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.590213330273!2d112.54406589999999!3d-7.937794299999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7883e8e3f8e01f%3A0x99971f240006ad50!2sKantor%20Desa%20Selorejo!5e0!3m2!1sid!2sid!4v1775964843637!5m2!1sid!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', '2026-04-12 11:21:55', '2026-04-12 11:21:55');

-- Table: struktur_organisasi
DROP TABLE IF EXISTS `struktur_organisasi`;
CREATE TABLE `struktur_organisasi` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `jabatan` VARCHAR(255) NOT NULL  ,
  `nama_pejabat` VARCHAR(255) NOT NULL  ,
  `foto` VARCHAR(255) NULL  ,
  `urutan` INT NOT NULL  ,
  `created_at` DATETIME NULL  ,
  `updated_at` DATETIME NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `struktur_organisasi` (`id`, `jabatan`, `nama_pejabat`, `foto`, `urutan`, `created_at`, `updated_at`) VALUES ('1', 'Kepala Desa', 'Bambang Soponyono', NULL, '1', NULL, NULL);
INSERT INTO `struktur_organisasi` (`id`, `jabatan`, `nama_pejabat`, `foto`, `urutan`, `created_at`, `updated_at`) VALUES ('2', 'Sekretaris Desa', '-', NULL, '2', NULL, NULL);
INSERT INTO `struktur_organisasi` (`id`, `jabatan`, `nama_pejabat`, `foto`, `urutan`, `created_at`, `updated_at`) VALUES ('3', 'Kaur Umum', 'Retno Kustiah', NULL, '3', NULL, NULL);
INSERT INTO `struktur_organisasi` (`id`, `jabatan`, `nama_pejabat`, `foto`, `urutan`, `created_at`, `updated_at`) VALUES ('4', 'Kaur Keuangan', 'Yusak Dadang S', NULL, '4', NULL, NULL);
INSERT INTO `struktur_organisasi` (`id`, `jabatan`, `nama_pejabat`, `foto`, `urutan`, `created_at`, `updated_at`) VALUES ('5', 'Kaur Perencanaan', '-', NULL, '5', NULL, NULL);
INSERT INTO `struktur_organisasi` (`id`, `jabatan`, `nama_pejabat`, `foto`, `urutan`, `created_at`, `updated_at`) VALUES ('6', 'Kasi Pemerintahan', 'Wiyono', NULL, '6', NULL, NULL);
INSERT INTO `struktur_organisasi` (`id`, `jabatan`, `nama_pejabat`, `foto`, `urutan`, `created_at`, `updated_at`) VALUES ('7', 'Kasi Kesejahteraan', 'Saleh', NULL, '7', NULL, NULL);
INSERT INTO `struktur_organisasi` (`id`, `jabatan`, `nama_pejabat`, `foto`, `urutan`, `created_at`, `updated_at`) VALUES ('8', 'Kasi Kamtib', 'Suiswanto', NULL, '8', NULL, NULL);
INSERT INTO `struktur_organisasi` (`id`, `jabatan`, `nama_pejabat`, `foto`, `urutan`, `created_at`, `updated_at`) VALUES ('9', 'Kasi Pemberdayaan', 'Solikin Wibowo', NULL, '9', NULL, NULL);
INSERT INTO `struktur_organisasi` (`id`, `jabatan`, `nama_pejabat`, `foto`, `urutan`, `created_at`, `updated_at`) VALUES ('10', 'Kamituwo Dusun Selorejo (Krajan)', 'Yasnadi', NULL, '10', NULL, NULL);
INSERT INTO `struktur_organisasi` (`id`, `jabatan`, `nama_pejabat`, `foto`, `urutan`, `created_at`, `updated_at`) VALUES ('11', 'Kamituwo Dusun Selokerto', 'Prayitno', NULL, '11', NULL, NULL);
INSERT INTO `struktur_organisasi` (`id`, `jabatan`, `nama_pejabat`, `foto`, `urutan`, `created_at`, `updated_at`) VALUES ('12', 'Kamituwo Dusun Gumuk', '-', NULL, '12', NULL, NULL);

-- Table: bpd
DROP TABLE IF EXISTS `bpd`;
CREATE TABLE `bpd` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nama` VARCHAR(255) NOT NULL  ,
  `jabatan` VARCHAR(255) NOT NULL  ,
  `foto` VARCHAR(255) NULL  ,
  `created_at` DATETIME NULL  ,
  `updated_at` DATETIME NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `bpd` (`id`, `nama`, `jabatan`, `foto`, `created_at`, `updated_at`) VALUES ('1', 'Moch. Zainul Arifin', 'Ketua BPD', NULL, NULL, NULL);
INSERT INTO `bpd` (`id`, `nama`, `jabatan`, `foto`, `created_at`, `updated_at`) VALUES ('2', 'Slamet Riyadi', 'Wakil Ketua BPD', NULL, NULL, NULL);
INSERT INTO `bpd` (`id`, `nama`, `jabatan`, `foto`, `created_at`, `updated_at`) VALUES ('3', 'Nurul Hidayah', 'Sekretaris BPD', NULL, NULL, NULL);
INSERT INTO `bpd` (`id`, `nama`, `jabatan`, `foto`, `created_at`, `updated_at`) VALUES ('4', 'Agus Supriyanto', 'Anggota BPD', NULL, NULL, NULL);
INSERT INTO `bpd` (`id`, `nama`, `jabatan`, `foto`, `created_at`, `updated_at`) VALUES ('5', 'Eni Kusumawati', 'Anggota BPD', NULL, NULL, NULL);
INSERT INTO `bpd` (`id`, `nama`, `jabatan`, `foto`, `created_at`, `updated_at`) VALUES ('6', 'Fandi Ahmad', 'Anggota BPD', NULL, NULL, NULL);
INSERT INTO `bpd` (`id`, `nama`, `jabatan`, `foto`, `created_at`, `updated_at`) VALUES ('7', 'Ratna Dewi', 'Anggota BPD', NULL, NULL, NULL);

-- Table: lembaga_desa
DROP TABLE IF EXISTS `lembaga_desa`;
CREATE TABLE `lembaga_desa` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nama_lembaga` VARCHAR(255) NOT NULL  ,
  `jenis` VARCHAR(255) NOT NULL  ,
  `ketua` VARCHAR(255) NOT NULL  ,
  `deskripsi` TEXT NULL  ,
  `foto` VARCHAR(255) NULL  ,
  `created_at` DATETIME NULL  ,
  `updated_at` DATETIME NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `lembaga_desa` (`id`, `nama_lembaga`, `jenis`, `ketua`, `deskripsi`, `foto`, `created_at`, `updated_at`) VALUES ('1', 'LPMD', 'LPMD', 'Pardi Susanto', 'Lembaga Pemberdayaan Masyarakat Desa Selorejo bertugas merencanakan dan menggerakkan swadaya gotong royong masyarakat dalam pelaksanaan pembangunan.', NULL, NULL, NULL);
INSERT INTO `lembaga_desa` (`id`, `nama_lembaga`, `jenis`, `ketua`, `deskripsi`, `foto`, `created_at`, `updated_at`) VALUES ('2', 'Karang Taruna Selorejo Muda', 'Karang Taruna', 'Rizky Pratama', 'Karang Taruna Desa Selorejo aktif dalam kegiatan kepemudaan, sosial, dan pengembangan potensi wisata desa bagi generasi muda.', NULL, NULL, NULL);
INSERT INTO `lembaga_desa` (`id`, `nama_lembaga`, `jenis`, `ketua`, `deskripsi`, `foto`, `created_at`, `updated_at`) VALUES ('3', 'PKK Desa Selorejo', 'PKK', 'Ny. Hj. Sutrisno', 'PKK Desa Selorejo aktif dalam pemberdayaan perempuan, posyandu, ketahanan pangan keluarga, dan kegiatan sosial kemasyarakatan.', NULL, NULL, NULL);
INSERT INTO `lembaga_desa` (`id`, `nama_lembaga`, `jenis`, `ketua`, `deskripsi`, `foto`, `created_at`, `updated_at`) VALUES ('4', 'Linmas Desa Selorejo', 'Linmas', 'Suharto', 'Satuan Perlindungan Masyarakat (Linmas) Desa Selorejo bertugas menjaga ketentraman, ketertiban, dan keamanan lingkungan desa.', NULL, NULL, NULL);

-- Table: wisata
DROP TABLE IF EXISTS `wisata`;
CREATE TABLE `wisata` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `judul` VARCHAR(255) NOT NULL  ,
  `deskripsi` TEXT NOT NULL  ,
  `harga_tiket` NUMERIC NULL  ,
  `jadwal` TEXT NULL  ,
  `aturan` TEXT NULL  ,
  `gambar` VARCHAR(255) NULL  ,
  `created_at` DATETIME NULL  ,
  `updated_at` DATETIME NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `wisata` (`id`, `judul`, `deskripsi`, `harga_tiket`, `jadwal`, `aturan`, `gambar`, `created_at`, `updated_at`) VALUES ('1', 'Agrowisata Petik Jeruk Selorejo', 'Menjadi ikon utama Desa Selorejo, Agrowisata Petik Jeruk menawarkan pengalaman autentik berada di tengah hamparan kebun jeruk seluas puluhan hektare. Desa ini dikenal sebagai penghasil jeruk berkualitas tinggi dengan varietas unggulan seperti Jeruk Keprok Batu 55 yang manis segar, Jeruk Baby Java, hingga varietas Valencia.

Wisatawan tidak hanya sekadar berkunjung, namun dapat merasakan sensasi memetik buah jeruk langsung dari dahan pohonnya di bawah bimbingan petani lokal. Keunikan dari wisata ini adalah konsep ''All You Can Eat'' di dalam kebun, di mana pengunjung diperbolehkan menikmati buah jeruk sepuasnya selama berada di lokasi. 

Lokasi kebun yang berada di lereng bukit memberikan panorama visual yang menakjubkan dengan latar belakang pegunungan dan udara yang sangat bersih. Wisata ini sangat direkomendasikan untuk edukasi anak-anak mengenai dunia pertanian buah-buahan.', '20000', 'Senin - Minggu: 08.00 - 16.00 WIB (Musim Panen: Juni - Desember)', '1. Tiket masuk sudah termasuk makan jeruk sepuasnya di dalam kebun.
2. Jeruk yang dibawa pulang akan ditimbang dengan harga pasar petani yang terjangkau.
3. Harap menjaga kelestarian pohon dengan tidak mematahkan ranting secara kasar.', 'https://images.unsplash.com/photo-1557800636-894a64c1696f?w=1200&q=80', NULL, NULL);
INSERT INTO `wisata` (`id`, `judul`, `deskripsi`, `harga_tiket`, `jadwal`, `aturan`, `gambar`, `created_at`, `updated_at`) VALUES ('2', 'Bumi Perkemahan Bedengan', 'Terletak di kaki Gunung Panderman, Bumi Perkemahan Bedengan adalah oasis ketenangan di tengah hutan pinus yang rimbun. Keistimewaan utama tempat ini adalah aliran Sungai Metro yang jernih dan dangkal, memungkinkan pengunjung untuk bermain air atau sekadar bersantai mendengarkan gemericik air yang menenangkan.

Dengan udara yang sangat sejuk pada ketinggian sekitar 1.100 mdpl, Bedengan menjadi destinasi favorit untuk berkemah (camping), piknik keluarga, hingga kegiatan outbound. Area ini memiliki 17 titik camping ground yang telah tertata rapi, lengkap dengan fasilitas pendukung yang memadai untuk kenyamanan pengunjung.

Tempat ini juga menjadi spot fotografi favorit berkat barisan pohon pinus yang menjulang tinggi, menciptakan suasana ''Vibe Hutan'' yang sangat estetik untuk keperluan media sosial maupun pre-wedding.', '10000', 'Kunjungan Biasa: 07.00 - 17.00 WIB
Camping Ground: Buka 24 Jam', '1. Dilarang membuang sampah di area hutan maupun aliran sungai.
2. Biaya camping menginap adalah Rp 25.000 per tenda/malam.
3. Harap menjaga ketenangan dan tidak merusak vegetasi sekitar.', 'https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7?w=1200&q=80', NULL, NULL);
INSERT INTO `wisata` (`id`, `judul`, `deskripsi`, `harga_tiket`, `jadwal`, `aturan`, `gambar`, `created_at`, `updated_at`) VALUES ('3', 'Air Terjun Brues', 'Misteri keindahan alam yang tersembunyi di rimbunnya hutan Selorejo. Air Terjun Brues menawarkan keheningan dan kesejukan air pegunungan asli yang belum banyak tersentuh tangan manusia.

Akses menuju air terjun berupa jalur penjelajahan ringan (trekking) yang akan memanjakan mata dengan keanekaragaman hayati hutan tropis. Lokasi ini sangat cocok untuk pelarian dari kepenatan kota (healing) dan bagi mereka yang menyukai petualangan alam liar yang asri.', '5000', 'Senin - Minggu: 07.00 - 15.00 WIB (Tutup jika cuaca buruk)', '1. Wajib lapor ke pos pendataan sebelum masuk.
2. Dilarang keras merusak flora dan fauna.
3. Tidak dianjurkan berkunjung saat hujan deras.', 'https://images.unsplash.com/photo-1433086966358-54859d0ed716?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80', NULL, NULL);
INSERT INTO `wisata` (`id`, `judul`, `deskripsi`, `harga_tiket`, `jadwal`, `aturan`, `gambar`, `created_at`, `updated_at`) VALUES ('4', 'Adventure Trail & Sirkuit ATV', 'Bagi para pecinta adrenalin dan olahraga otomotif, Selorejo menyediakan lintasan menantang untuk Motor Trail dan ATV. Dengan kontur tanah perbukitan yang memiliki tingkat kesulitan bervariasi, arena ini menguji ketangkasan sekaligus menyuguhkan pemandangan lereng gunung yang spektakuler.

Pengunjung dapat memilih bermain di arena sirkuit cross tertutup yang aman bagi pemula, maupun mengambil paket ''Adventure Trip'' membelah jalur perhutanan didampingi oleh instruktur profesional. Fasilitas penyewaan unit ATV dan motor trail juga tersedia lengkap dengan perlengkapan keselamatan standar.', '150000', 'Sabtu & Minggu: 08.00 - 16.00 WIB (Hari kerja dengan reservasi)', '1. Wajib menggunakan helm dan safety gear.
2. Usia minimal 15 tahun (untuk menyetir sendiri).
3. Ikuti rute yang telah ditentukan pengelola.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/Motocross_en_C%C3%B3rdoba_-_Spain.jpg/1200px-Motocross_en_C%C3%B3rdoba_-_Spain.jpg', NULL, NULL);
INSERT INTO `wisata` (`id`, `judul`, `deskripsi`, `harga_tiket`, `jadwal`, `aturan`, `gambar`, `created_at`, `updated_at`) VALUES ('5', 'Wisata Kesenian & Budaya Jawi', 'Desa Selorejo bukan hanya tentang alam, namun juga menjaga nyala api peradaban leluhur. Kami memiliki komunitas kebudayaan akar rumput yang sangat aktif melestarikan kesenian tari hingga musik tradisional Jawa.

Wisatawan dapat memesan pertunjukan khusus atau berinteraksi langsung dalam latihan rutin kesenian seperti Jaranan, Bantengan, Pencak Silat Tradisional, Campur Sari, hingga Ludruk dan Wayang Kulit. Ini adalah sarana edukasi budaya yang interaktif dan sangat berkesan bagi pelajar, mahasiswa, maupun ekspatriat.', '0', 'Latihan Rutin: Malam Minggu Pukul 19.00 WIB (Balai Dukuh)', '1. Terbuka untuk umum tanpa dipungut biaya.
2. Boleh mendokumentasikan selama tidak mengganggu acara.
3. Khusus untuk rombongan yang ingin pentas privat, berlaku tarif donasi sanggar.', 'https://upload.wikimedia.org/wikipedia/commons/e/ea/Kesenian_Jaranan.jpg', NULL, NULL);
INSERT INTO `wisata` (`id`, `judul`, `deskripsi`, `harga_tiket`, `jadwal`, `aturan`, `gambar`, `created_at`, `updated_at`) VALUES ('6', 'Karnaval Tumpeng Jeruk Ageng', 'Ini adalah Puncak Kemeriahan Desa Selorejo yang dinanti-nanti setiap tahunnya. Arakan Tumpeng Jeruk Ageng merupakan perwujudan syukur warga atas melimpahnya panen bumi, di mana ribuan buah jeruk disusun menjulang tinggi menyerupai gunung (tumpeng).

Acara ini melibatkan seluruh warga dari Dusun Krajan hingga Selokerto dalam balutan pawai karnaval yang meriah, diwarnai dengan selamatan (Barikan), pentas kesenian jalanan, dan diakhiri dengan prosesi ''Grebeg'' di mana warga dan wisatawan boleh berebut mengambil buah dari gunungan tumpeng tersebut sebagai simbol keberkahan.', '0', 'Event Tahunan (Agustus / Puncak Musim Panen Raya)', '1. Tontonan gratis untuk publik.
2. Dilarang mengambil jeruk tumpeng sebelum didoakan dan diinstruksikan panitia.
3. Harap tertib saat mengikuti arak-arakan.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/cd/Gunungan_Grebeg_Maulud.jpg/1200px-Gunungan_Grebeg_Maulud.jpg', NULL, NULL);

-- Table: galeri
DROP TABLE IF EXISTS `galeri`;
CREATE TABLE `galeri` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `tipe` VARCHAR(255) NOT NULL  ,
  `url` VARCHAR(255) NOT NULL  ,
  `caption` VARCHAR(255) NULL  ,
  `kategori` VARCHAR(255) NULL  ,
  `tanggal` DATE NULL  ,
  `created_at` DATETIME NULL  ,
  `updated_at` DATETIME NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `galeri` (`id`, `tipe`, `url`, `caption`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES ('1', 'foto', 'https://images.unsplash.com/photo-1542442828-287217bfb218?w=800', 'Camping Ground Bumi Perkemahan Bedengan', 'Wisata', '2026-03-01 00:00:00', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `galeri` (`id`, `tipe`, `url`, `caption`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES ('2', 'foto', 'https://images.unsplash.com/photo-1596489312224-87f5e8daadd1?w=800', 'Atmosfer Berkemah di Hutan Pinus Selorejo', 'Wisata', '2026-03-05 00:00:00', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `galeri` (`id`, `tipe`, `url`, `caption`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES ('3', 'foto', 'https://images.unsplash.com/photo-1559525839-b184a4d698c7?w=800', 'Area Campground Outdoor Ramai Wisatawan', 'Wisata', '2026-03-10 00:00:00', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `galeri` (`id`, `tipe`, `url`, `caption`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES ('4', 'foto', 'https://images.unsplash.com/photo-1627435601357-3f6c76feb185?w=800', 'Hamparan Kebun Jeruk Keprok Batu 55', 'Agrobisnis', '2026-03-12 00:00:00', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `galeri` (`id`, `tipe`, `url`, `caption`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES ('5', 'foto', 'https://images.unsplash.com/photo-1590779033100-9f60af05a013?w=800', 'Proses Panen Jeruk oleh Petani Lokal', 'Agrobisnis', '2026-03-14 00:00:00', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `galeri` (`id`, `tipe`, `url`, `caption`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES ('6', 'foto', 'https://images.unsplash.com/photo-1601614742718-4721c0ad52f7?w=800', 'Pohon Jeruk Rimbun dengan Buah Siap Petik', 'Agrobisnis', '2026-03-15 00:00:00', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `galeri` (`id`, `tipe`, `url`, `caption`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES ('7', 'foto', 'https://images.unsplash.com/photo-1518495122543-bc87e5606d54?w=800', 'Terasering Sawah Hijau Selorejo', 'Alam', '2026-03-16 00:00:00', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `galeri` (`id`, `tipe`, `url`, `caption`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES ('8', 'foto', 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=800', 'Panorama Alam Lereng Kawi yang Menyejukkan', 'Alam', '2026-03-18 00:00:00', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `galeri` (`id`, `tipe`, `url`, `caption`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES ('9', 'foto', 'https://images.unsplash.com/photo-1596489312224-87f5e8daadd1?w=800', 'Pemandangan Desa di Kaki Gunung', 'Alam', '2026-03-20 00:00:00', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `galeri` (`id`, `tipe`, `url`, `caption`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES ('10', 'foto', 'https://images.unsplash.com/photo-1558905623-bc97b76778f5?w=800', 'Kegiatan Gotong Royong Warga Desa', 'Sosial', '2026-03-22 00:00:00', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `galeri` (`id`, `tipe`, `url`, `caption`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES ('11', 'foto', 'https://images.unsplash.com/photo-1592982537447-6f296cb3adea?w=800', 'Suasana Kehidupan Sehari-hari Warga', 'Sosial', '2026-03-24 00:00:00', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `galeri` (`id`, `tipe`, `url`, `caption`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES ('12', 'foto', 'https://images.unsplash.com/photo-1588612143093-41bb33659223?w=800', 'Pesta Rakyat Bersih Desa Selorejo', 'Budaya', '2026-03-26 00:00:00', '2026-04-12 11:21:55', '2026-04-12 11:21:55');

-- Table: produk
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nama` VARCHAR(255) NOT NULL  ,
  `deskripsi` TEXT NOT NULL  ,
  `harga` NUMERIC NULL  ,
  `gambar` VARCHAR(255) NULL  ,
  `stok` VARCHAR(255) NULL  ,
  `created_at` DATETIME NULL  ,
  `updated_at` DATETIME NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `harga`, `gambar`, `stok`, `created_at`, `updated_at`) VALUES ('1', 'Kopi Arabika Lereng Kawi (200gr)', 'Biji kopi Arabika Selorejo dipanen dari ketinggian 1.200 mdpl di lereng Gunung Kawi, menghasilkan profil rasa yang kompleks dengan dominasi fruity notes seperti apel hijau dan blackberry. Diproses secara natural untuk menjaga karakteristik keasaman yang segar dan tubuh (body) yang sedang, kopi ini menjadi pilihan utama bagi para pecinta kopi specialty yang mencari citarasa autentik pegunungan Malang.', '35000', 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?w=800&q=80', 'Tersedia', NULL, NULL);
INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `harga`, `gambar`, `stok`, `created_at`, `updated_at`) VALUES ('2', 'Jeruk Keprok Batu 55 (1 Kg)', 'Sebagai ikon agrowisata Selorejo, Jeruk Keprok Batu 55 menawarkan perpaduan sempurna antara rasa manis yang kuat dengan sentuhan sensasi asam segar. Buahnya memiliki kulit yang cukup tebal berwarna kuning jingga yang menarik dan mudah dikupas, serta daging buah yang kenyal dan kaya sari buah. Jeruk ini ditanam dengan praktik pertanian ramah lingkungan untuk memastikan setiap gigitannya aman dan menyehatkan bagi keluarga.', '25000', 'https://images.unsplash.com/photo-1557844352-761f2565b576?w=800&q=80', 'Tersedia', NULL, NULL);
INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `harga`, `gambar`, `stok`, `created_at`, `updated_at`) VALUES ('3', 'Jeruk Baby Java (1 Kg)', 'Jeruk Baby Java Selorejo dikenal sebagai jeruk paling bersahabat bagi pencernaan si kecil berkat kadar asamnya yang sangat rendah namun memiliki tingkat kemanisan alami yang tinggi. Kaya akan Vitamin C dan antioksidan, jeruk ini menjadi favorit untuk dijadikan air perasan bagi bayi (MPASI) maupun sebagai sumber hidrasi harian yang menyegarkan. Tekstur kulitnya yang halus dan daging buahnya yang lembut memberikan kualitas sari buah maksimal di setiap perasannya.', '20000', 'https://images.unsplash.com/photo-1544145945-f904253d0c71?w=800&q=80', 'Tersedia', NULL, NULL);
INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `harga`, `gambar`, `stok`, `created_at`, `updated_at`) VALUES ('4', 'Keripik Mbote/Talas BUMDes', 'Keripik Mbote adalah camilan warisan leluhur Desa Selorejo yang dibuat dari Umbi Talas (Mbote) pilihan hasil bumi lereng Kawi. Diolah secara higienis oleh kelompok ibu-ibu PKK desa, umbi talas diiris tipis secara presisi dan direndam dalam bumbu rempah rahasia sebelum digoreng hingga mencapai tingkat kerenyahan maksimal. Tanpa bahan pengawet dan MSG, keripik ini menawarkan rasa gurih autentik yang sulit dilupakan.', '15000', 'https://images.unsplash.com/photo-1599599810769-bcde5a160d32?w=800&q=80', 'Tersedia', NULL, NULL);
INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `harga`, `gambar`, `stok`, `created_at`, `updated_at`) VALUES ('5', 'Jamu Instan Temulawak & Jahe', 'Produk unggulan dari Kelompok Wanita Tani (KWT) Selorejo ini menghadirkan kepraktisan minuman kesehatan tradisional dalam bentuk serbuk instan yang mudah diseduh. Campuran Temulawak, Jahe Merah, dan Gula Aren pilihan diolah secara tradisional namun tetap menjaga standar kebersihan untuk memberikan manfaat maksimal bagi daya tahan tubuh dan kehangatan sistem pencernaan. Cocok dinikmati setiap pagi sebagai pendamping gaya hidup sehat Anda.', '20000', 'https://images.unsplash.com/photo-1599321427976-5d63f034ee51?w=800&q=80', 'Tersedia', NULL, NULL);
INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `harga`, `gambar`, `stok`, `created_at`, `updated_at`) VALUES ('6', 'Jeruk Keprok Keranjang Gift', 'Hadirkan kehangatan khas Desa Selorejo melalui paket hadiah eksklusif Jeruk Keprok Keranjang. Berisi 5kg jeruk pilihan kualitas super yang dikemas dalam keranjang bambu tradisional (besek) yang ramah lingkungan dan estetik. Pilihan tepat sebagai oleh-oleh premium atau hantaran spesial bagi kerabat dan kolega, mencerminkan ketulusan hasil bumi langsung dari tangan petani lokal kami.', '135000', 'https://images.unsplash.com/photo-1543328225-b4ee54e173bd?w=800&q=80', 'Tersedia', NULL, NULL);
INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `harga`, `gambar`, `stok`, `created_at`, `updated_at`) VALUES ('7', 'Madu Murni Bunga Jeruk', 'Madu Bunga Jeruk Selorejo merupakan jenis madu monofloral langka yang dihasilkan oleh lebah penghisap nektar bunga pohon jeruk yang mekar secara serempak. Memiliki aroma flora yang harum dengan sentuhan rasa yang ringan dan sedikit citrusy, madu ini kaya akan flavonoid dan enzim aktif yang baik untuk kesehatan lambung dan imunitas. Teksturnya yang jernih dan kemampuannya mengkristal dengan halus menjadi segel keaslian madu murni tanpa campuran.', '85000', 'https://images.unsplash.com/photo-1587049352846-4a222e784d38?w=800&q=80', 'Tersedia', NULL, NULL);
INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `harga`, `gambar`, `stok`, `created_at`, `updated_at`) VALUES ('8', 'Sari Jeruk Selorejo Botolan', 'Nikmati kesegaran murni 100% buah jeruk Selorejo dalam setiap botolnya tanpa tambahan pemanis buatan maupun pengawet. Menggunakan teknologi pengolahan suhu rendah untuk menjaga kandungan vitamin dan nutrisi alami tetap utuh, sari jeruk ini menawarkan rasa manis-segar yang konsisten. Praktis untuk dibawa beraktivitas dan menjadi solusi harian bagi Anda yang membutuhkan asupan Vitamin C instan di tengah kesibukan.', '12000', 'https://images.unsplash.com/photo-1613478223719-2ab802602423?w=800&q=80', 'Tersedia', NULL, NULL);
INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `harga`, `gambar`, `stok`, `created_at`, `updated_at`) VALUES ('9', 'Pupuk Organik Cair Desa', 'Rahasia kesuburan agrowisata kami kini tersedia untuk kebun Anda sendiri. Pupuk Organik Cair (POC) Desa Selorejo diolah dari limbah pertanian dan mikroorganisme lokal (MOL) yang terbukti ampuh meningkatkan kualitas pembungaan dan pembuahan tanaman jeruk. Selain ramah lingkungan, pupuk ini membantu memperbaiki pori-pori tanah dan menyediakan nutrisi esensial bagi tanaman agar tumbuh lebih kuat, tahan penyakit, dan berbuah lebat secara alami.', '45000', 'https://images.unsplash.com/photo-1585314062340-f1a5a7c9328d?w=800&q=80', 'Tersedia', NULL, NULL);

-- Table: statistik_penduduk
DROP TABLE IF EXISTS `statistik_penduduk`;
CREATE TABLE `statistik_penduduk` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `tahun` INT NOT NULL  ,
  `jenis_data` VARCHAR(255) NOT NULL  ,
  `label` VARCHAR(255) NOT NULL  ,
  `nilai` INT NOT NULL  ,
  `created_at` DATETIME NULL  ,
  `updated_at` DATETIME NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `statistik_penduduk` (`id`, `tahun`, `jenis_data`, `label`, `nilai`, `created_at`, `updated_at`) VALUES ('1', '2024', 'gender', 'Laki-laki', '1870', NULL, NULL);
INSERT INTO `statistik_penduduk` (`id`, `tahun`, `jenis_data`, `label`, `nilai`, `created_at`, `updated_at`) VALUES ('2', '2024', 'gender', 'Perempuan', '1804', NULL, NULL);
INSERT INTO `statistik_penduduk` (`id`, `tahun`, `jenis_data`, `label`, `nilai`, `created_at`, `updated_at`) VALUES ('3', '2024', 'usia', '0-14 Tahun', '735', NULL, NULL);
INSERT INTO `statistik_penduduk` (`id`, `tahun`, `jenis_data`, `label`, `nilai`, `created_at`, `updated_at`) VALUES ('4', '2024', 'usia', '15-29 Tahun', '918', NULL, NULL);
INSERT INTO `statistik_penduduk` (`id`, `tahun`, `jenis_data`, `label`, `nilai`, `created_at`, `updated_at`) VALUES ('5', '2024', 'usia', '30-44 Tahun', '882', NULL, NULL);
INSERT INTO `statistik_penduduk` (`id`, `tahun`, `jenis_data`, `label`, `nilai`, `created_at`, `updated_at`) VALUES ('6', '2024', 'usia', '45-59 Tahun', '735', NULL, NULL);
INSERT INTO `statistik_penduduk` (`id`, `tahun`, `jenis_data`, `label`, `nilai`, `created_at`, `updated_at`) VALUES ('7', '2024', 'usia', '60+ Tahun', '404', NULL, NULL);
INSERT INTO `statistik_penduduk` (`id`, `tahun`, `jenis_data`, `label`, `nilai`, `created_at`, `updated_at`) VALUES ('8', '2024', 'pendidikan', 'SD/Sederajat', '808', NULL, NULL);
INSERT INTO `statistik_penduduk` (`id`, `tahun`, `jenis_data`, `label`, `nilai`, `created_at`, `updated_at`) VALUES ('9', '2024', 'pendidikan', 'SMP/Sederajat', '735', NULL, NULL);
INSERT INTO `statistik_penduduk` (`id`, `tahun`, `jenis_data`, `label`, `nilai`, `created_at`, `updated_at`) VALUES ('10', '2024', 'pendidikan', 'SMA/Sederajat', '1470', NULL, NULL);
INSERT INTO `statistik_penduduk` (`id`, `tahun`, `jenis_data`, `label`, `nilai`, `created_at`, `updated_at`) VALUES ('11', '2024', 'pendidikan', 'Diploma/Sarjana+', '661', NULL, NULL);
INSERT INTO `statistik_penduduk` (`id`, `tahun`, `jenis_data`, `label`, `nilai`, `created_at`, `updated_at`) VALUES ('12', '2024', 'pekerjaan', 'Petani/Berkebun', '1470', NULL, NULL);
INSERT INTO `statistik_penduduk` (`id`, `tahun`, `jenis_data`, `label`, `nilai`, `created_at`, `updated_at`) VALUES ('13', '2024', 'pekerjaan', 'Pedagang/Jasa', '735', NULL, NULL);
INSERT INTO `statistik_penduduk` (`id`, `tahun`, `jenis_data`, `label`, `nilai`, `created_at`, `updated_at`) VALUES ('14', '2024', 'pekerjaan', 'Karyawan Swasta', '735', NULL, NULL);
INSERT INTO `statistik_penduduk` (`id`, `tahun`, `jenis_data`, `label`, `nilai`, `created_at`, `updated_at`) VALUES ('15', '2024', 'pekerjaan', 'Belum/Tidak Bekerja', '734', NULL, NULL);
INSERT INTO `statistik_penduduk` (`id`, `tahun`, `jenis_data`, `label`, `nilai`, `created_at`, `updated_at`) VALUES ('16', '2024', 'agama', 'Islam', '3612', NULL, NULL);
INSERT INTO `statistik_penduduk` (`id`, `tahun`, `jenis_data`, `label`, `nilai`, `created_at`, `updated_at`) VALUES ('17', '2024', 'agama', 'Kristen', '48', NULL, NULL);
INSERT INTO `statistik_penduduk` (`id`, `tahun`, `jenis_data`, `label`, `nilai`, `created_at`, `updated_at`) VALUES ('18', '2024', 'agama', 'Hindu/Lainnya', '14', NULL, NULL);

-- Table: apbdes
DROP TABLE IF EXISTS `apbdes`;
CREATE TABLE `apbdes` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `tahun` INT NOT NULL  ,
  `jenis` VARCHAR(255) NOT NULL  ,
  `bidang` VARCHAR(255) NOT NULL  ,
  `nominal` INT NOT NULL  ,
  `dokumen_pdf` VARCHAR(255) NULL  ,
  `created_at` DATETIME NULL  ,
  `updated_at` DATETIME NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `apbdes` (`id`, `tahun`, `jenis`, `bidang`, `nominal`, `dokumen_pdf`, `created_at`, `updated_at`) VALUES ('1', '2024', 'pendapatan', 'Dana Desa (DD)', '1020000000', NULL, NULL, NULL);
INSERT INTO `apbdes` (`id`, `tahun`, `jenis`, `bidang`, `nominal`, `dokumen_pdf`, `created_at`, `updated_at`) VALUES ('2', '2024', 'pendapatan', 'Alokasi Dana Desa (ADD)', '510000000', NULL, NULL, NULL);
INSERT INTO `apbdes` (`id`, `tahun`, `jenis`, `bidang`, `nominal`, `dokumen_pdf`, `created_at`, `updated_at`) VALUES ('3', '2024', 'pendapatan', 'Pendapatan Asli Desa (PADes)', '160000000', NULL, NULL, NULL);
INSERT INTO `apbdes` (`id`, `tahun`, `jenis`, `bidang`, `nominal`, `dokumen_pdf`, `created_at`, `updated_at`) VALUES ('4', '2024', 'pendapatan', 'Bagi Hasil Pajak (BHP)', '520000000', NULL, NULL, NULL);
INSERT INTO `apbdes` (`id`, `tahun`, `jenis`, `bidang`, `nominal`, `dokumen_pdf`, `created_at`, `updated_at`) VALUES ('5', '2024', 'pendapatan', 'Bantuan Keuangan Provinsi', '100000000', NULL, NULL, NULL);
INSERT INTO `apbdes` (`id`, `tahun`, `jenis`, `bidang`, `nominal`, `dokumen_pdf`, `created_at`, `updated_at`) VALUES ('6', '2024', 'belanja', 'Penyelenggaraan Pemerintahan', '550000000', NULL, NULL, NULL);
INSERT INTO `apbdes` (`id`, `tahun`, `jenis`, `bidang`, `nominal`, `dokumen_pdf`, `created_at`, `updated_at`) VALUES ('7', '2024', 'belanja', 'Pelaksanaan Pembangunan Desa', '740000000', NULL, NULL, NULL);
INSERT INTO `apbdes` (`id`, `tahun`, `jenis`, `bidang`, `nominal`, `dokumen_pdf`, `created_at`, `updated_at`) VALUES ('8', '2024', 'belanja', 'Pembinaan Kemasyarakatan', '185000000', NULL, NULL, NULL);
INSERT INTO `apbdes` (`id`, `tahun`, `jenis`, `bidang`, `nominal`, `dokumen_pdf`, `created_at`, `updated_at`) VALUES ('9', '2024', 'belanja', 'Pemberdayaan Masyarakat', '270000000', NULL, NULL, NULL);
INSERT INTO `apbdes` (`id`, `tahun`, `jenis`, `bidang`, `nominal`, `dokumen_pdf`, `created_at`, `updated_at`) VALUES ('10', '2024', 'belanja', 'Penanggulangan Bencana & Darurat', '97000000', NULL, NULL, NULL);

-- Table: berita
DROP TABLE IF EXISTS `berita`;
CREATE TABLE `berita` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `judul` VARCHAR(255) NOT NULL  ,
  `slug` VARCHAR(255) NOT NULL  ,
  `konten` TEXT NOT NULL  ,
  `gambar` VARCHAR(255) NULL  ,
  `kategori` VARCHAR(255) NOT NULL  ,
  `tanggal` DATE NOT NULL  ,
  `penulis` VARCHAR(255) NULL  ,
  `status_publish` VARCHAR(255) NOT NULL  ,
  `created_at` DATETIME NULL  ,
  `updated_at` DATETIME NULL  ,
  `views` INT NOT NULL  ,
  `likes` INT NOT NULL  ,
  `dislikes` INT NOT NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `berita` (`id`, `judul`, `slug`, `konten`, `gambar`, `kategori`, `tanggal`, `penulis`, `status_publish`, `created_at`, `updated_at`, `views`, `likes`, `dislikes`) VALUES ('1', 'Koperasi "Merah Putih" Desa Selorejo Suplai Jeruk Bantu Program Makan Bergizi Gratis Nasional', 'koperasi-selorejo-suplai-jeruk-makan-bergizi-gratis', '<p>Koperasi Desa Merah Putih Selorejo secara resmi menginisiasi kerja sama strategis sebagai penyuplai utama komoditas jeruk untuk Program Makan Bergizi Gratis (MBG) Nasional. Langkah ini diambil guna memastikan rantai pasok distribusi jeruk lokal langsung menjangkau pusat-pusat gizi di wilayah Malang Raya tanpa melalui perantara panjang.</p><p>Ketua Koperasi menyatakan bahwa sistem "direct-to-nutrition-center" ini tidak hanya menjamin kesegaran buah bagi masyarakat, tetapi juga memberikan harga beli yang jauh lebih adil bagi petani Selorejo. Proses penyortiran dan grading dilakukan secara ketat di gudang koperasi untuk memenuhi standar nutrisi dan kualitas yang ditetapkan pemerintah.</p>', 'https://images.unsplash.com/photo-1595246140625-573b715d11dc?w=800&q=80', 'Kabar Desa', '2026-02-15', 'Admin Desa', 'publish', NULL, '2026-04-12 11:47:52', '1', '0', '0');
INSERT INTO `berita` (`id`, `judul`, `slug`, `konten`, `gambar`, `kategori`, `tanggal`, `penulis`, `status_publish`, `created_at`, `updated_at`, `views`, `likes`, `dislikes`) VALUES ('2', 'Masterplan Destinasi Wisata 2024: Membangun Lahan Parkir Khusus Bus Pariwisata untuk Bedengan & Petik Jeruk', 'masterplan-lahan-parkir-bus-pariwisata-2024', '<p>Pemerintah Desa Selorejo mengesahkan masterplan destinasi wisata 2024 yang menitikberatkan pada pembangunan infrastruktur lahan parkir khusus bus pariwisata. Proyek ini bertujuan untuk mengatasi kemacetan di jalur menuju Bumi Perkemahan Bedengan dan lokasi Agrowisata Petik Jeruk yang sering kali padat pada akhir pekan.</p><p>Lahan parkir baru ini akan dilengkapi dengan fasilitas modern, termasuk paving blok berkualitas tinggi, sistem drainase yang baik, serta area istirahat bagi para kru bus. Dengan adanya fasilitas ini, diharapkan arus wisatawan masal dapat terkelola dengan lebih rapi, aman, dan memberikan kenyamanan ekstra bagi para pengunjung desa.</p>', 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=800&q=80', 'Kabar Desa', '2024-11-20', 'Humas Pemdes', 'publish', NULL, NULL, '0', '0', '0');
INSERT INTO `berita` (`id`, `judul`, `slug`, `konten`, `gambar`, `kategori`, `tanggal`, `penulis`, `status_publish`, `created_at`, `updated_at`, `views`, `likes`, `dislikes`) VALUES ('3', 'Kampanye Beralih ke Pertanian Organik: Ciptakan Jeruk Bebas Residu Pestisida', 'kampanye-beralih-pertanian-organik-jeruk', '<p>Gerakan beralih ke pertanian organik semakin gencar dilakukan oleh kelompok tani di wilayah Desa Selorejo. Melalui pendampingan dari pakar agrikultur, para petani kini mulai meninggalkan pestisida kimia dan beralih menggunakan pupuk kompos serta pestisida nabati buatan sendiri untuk menjaga ekosistem lahan jeruk.</p><p>Hasilnya, buah Jeruk Keprok Batu 55 yang dihasilkan kini memiliki kualitas bebas residu kimia, membuatnya jauh lebih aman dikonsumsi langsung dari pohonnya. Kampanye ini juga bertujuan untuk menjaga kesuburan tanah Selorejo dalam jangka panjang agar dapat terus dinikmati oleh generasi mendatang sebagai warisan agrikultur yang berkelanjutan.</p>', 'https://images.unsplash.com/photo-1592982537447-6f296cb3adea?w=800&q=80', 'Kabar Desa', '2024-05-10', 'BUMDes Selorejo', 'publish', NULL, NULL, '0', '0', '0');
INSERT INTO `berita` (`id`, `judul`, `slug`, `konten`, `gambar`, `kategori`, `tanggal`, `penulis`, `status_publish`, `created_at`, `updated_at`, `views`, `likes`, `dislikes`) VALUES ('4', 'Musyawarah Perencanaan Desa: Menentukan Prioritas Pembangunan Tahun 2027', 'musyawarah-perencanaan-desa-selorejo-2027', '<p>Balai Desa Selorejo dipadati oleh perwakilan warga dari berbagai RW dalam agenda Musyawarah Perencanaan Pembangunan (Musrenbang) Desa untuk tahun anggaran 2027. Pertemuan ini menjadi wadah bagi masyarakat untuk menyampaikan aspirasi mengenai prioritas pembangunan fisik dan pemberdayaan ekonomi desa.</p><p>Beberapa usulan utama yang mengemuka antara lain perbaikan jalan usaha tani untuk mempermudah distribusi panen, serta optimalisasi sistem drainase di area permukiman guna mencegah genangan saat musim hujan. Keterlibatan aktif warga dalam musyawarah ini menjadi kunci transparansi dan efektivitas penggunaan Dana Desa ke depan.</p>', 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=800&q=80', 'Kabar Desa', '2025-03-01', 'Sekretaris Desa', 'publish', NULL, '2026-04-12 19:16:50', '1', '0', '0');
INSERT INTO `berita` (`id`, `judul`, `slug`, `konten`, `gambar`, `kategori`, `tanggal`, `penulis`, `status_publish`, `created_at`, `updated_at`, `views`, `likes`, `dislikes`) VALUES ('5', 'Festival Jeruk Selorejo: Semarak Panen Raya di Lereng Kawi', 'festival-jeruk-selorejo-semarak-panen-raya', '<p>Kemeriahan menyelimuti Desa Selorejo dalam gelaran Festival Jeruk tahunan yang menjadi puncak acara "Bersih Desa". Ribuan warga dan wisatawan memenuhi jalanan untuk menyaksikan parade budaya yang menampilkan Gunungan Jeruk setinggi tiga meter sebagai simbol kemakmuran dan rasa syukur atas hasil panen yang melimpah.</p><p>Selain gunungan jeruk, festival ini juga menghadirkan Gunungan Opak dan beragam pertunjukan seni tradisional seperti Reog dan tari-tarian lokal. Tradisi berebut isi gunungan di akhir acara menjadi momen yang paling dinantikan, melambangkan kebersamaan dan berkah yang dibagikan secara merata kepada seluruh lapisan masyarakat desa.</p>', 'https://images.unsplash.com/photo-1558905623-bc97b76778f5?w=800&q=80', 'Kabar Desa', '2024-08-15', 'Admin Desa', 'publish', NULL, NULL, '0', '0', '0');
INSERT INTO `berita` (`id`, `judul`, `slug`, `konten`, `gambar`, `kategori`, `tanggal`, `penulis`, `status_publish`, `created_at`, `updated_at`, `views`, `likes`, `dislikes`) VALUES ('6', 'Peningkatan Digitalisasi Desa: Akses Wi-Fi Gratis di Area Publik', 'peningkatan-digitalisasi-desa-selorejo-wifi-gratis', '<p>Dalam upaya mewujudkan visi "Smart Village", Pemerintah Desa Selorejo telah merampungkan pemasangan infrastruktur Wi-Fi gratis di titik-titik publik strategis. Fasilitas internet kecepatan tinggi ini kini dapat dinikmati warga di area Alun-alun, Balai Desa, dan pusat oleh-oleh guna mendukung produktivitas digital masyarakat desa.</p><p>Kehadiran internet gratis ini diharapkan dapat membantu para pelajar dalam mengakses materi pendidikan daring serta memudahkan pelaku UMKM desa dalam mempromosikan produk unggulannya melalui pasar digital. Digitalisasi ini merupakan langkah nyata desa untuk tetap relevan dan kompetitif di era informasi modern.</p>', 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?w=800&q=80', 'Kabar Desa', '2025-01-10', 'Operator Desa', 'publish', NULL, NULL, '0', '0', '0');
INSERT INTO `berita` (`id`, `judul`, `slug`, `konten`, `gambar`, `kategori`, `tanggal`, `penulis`, `status_publish`, `created_at`, `updated_at`, `views`, `likes`, `dislikes`) VALUES ('7', 'Pelatihan UMKM Desa: Inovasi Pengemasan Produk Jeruk', 'pelatihan-umkm-desa-inovasi-pengemasan', '<p>Sejumlah pelaku UMKM lokal Selorejo mengikuti lokakarya intensif mengenai inovasi pengemasan dan branding produk turunan jeruk. Pelatihan yang diprakarsai oleh BUMDes ini bertujuan untuk meningkatkan nilai jual produk olahan seperti dari sirup, dodol, hingga keripik jeruk agar layak menembus pasar ritel modern di perkotaan.</p><p>Para peserta diajarkan teknik pengemasan fungsional yang dapat memperpanjang masa simpan produk tanpa bahan pengawet kimia, serta desain label yang lebih menarik secara visual. Dengan kemasan yang lebih profesional, produk-produk khas Selorejo diharapkan dapat bersaing dengan merek nasional dan meningkatkan pendapatan ekonomi keluarga petani.</p>', 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=800&q=80', 'Kabar Desa', '2024-12-05', 'BUMDes Selorejo', 'publish', NULL, NULL, '0', '0', '0');
INSERT INTO `berita` (`id`, `judul`, `slug`, `konten`, `gambar`, `kategori`, `tanggal`, `penulis`, `status_publish`, `created_at`, `updated_at`, `views`, `likes`, `dislikes`) VALUES ('8', 'Posyandu Terintegrasi: Menjamin Kesehatan Ibu dan Anak', 'posyandu-terintegrasi-kesehatan-ibu-anak', '<p>Layanan kesehatan di Desa Selorejo memasuki babak baru dengan pengoperasian Posyandu Integrasi Layanan Primer (ILP). Berbeda dengan posyandu konvensional, model ILP ini menawarkan pelayanan kesehatan yang mencakup seluruh siklus hidup, mulai dari balita, remaja, usia produktif, hingga lansia di satu lokasi terpadu.</p><p>Transformasi ini melibatkan penyediaan alat kesehatan antropometri standar serta tenaga kader yang telah terlatih untuk melakukan skrining kesehatan awal terhadap penyakit tidak menular. Dengan layanan yang lebih dekat dan terpadu, pemerintah desa berkomitmen untuk terus meningkatkan indeks kesehatan warga dan mendeteksi dini risiko gangguan kesehatan sejak tingkat akar rumput.</p>', 'https://images.unsplash.com/photo-1584362946045-12448ca55d91?w=800&q=80', 'Kabar Desa', '2025-04-05', 'Admin Desa', 'publish', NULL, '2026-04-12 19:16:41', '3', '1', '0');

-- Table: polling
DROP TABLE IF EXISTS `polling`;
CREATE TABLE `polling` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `pertanyaan` VARCHAR(255) NOT NULL  ,
  `jumlah_ya` INT NOT NULL  ,
  `jumlah_tidak` INT NOT NULL  ,
  `tanggal_mulai` DATE NOT NULL  ,
  `tanggal_selesai` DATE NOT NULL  ,
  `is_active` TINYINT(1) NOT NULL  ,
  `created_at` DATETIME NULL  ,
  `updated_at` DATETIME NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `polling` (`id`, `pertanyaan`, `jumlah_ya`, `jumlah_tidak`, `tanggal_mulai`, `tanggal_selesai`, `is_active`, `created_at`, `updated_at`) VALUES ('1', 'Apakah Anda puas dengan pelayanan Pemerintah Desa Selorejo bulan ini?', '47', '8', '2026-04-01', '2026-04-30', '1', '2026-04-12 11:21:55', '2026-04-12 11:21:55');

-- Table: kontak_messages
DROP TABLE IF EXISTS `kontak_messages`;
CREATE TABLE `kontak_messages` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nama` VARCHAR(255) NOT NULL  ,
  `email` VARCHAR(255) NOT NULL  ,
  `pesan` TEXT NOT NULL  ,
  `status_baca` VARCHAR(255) NOT NULL  ,
  `created_at` DATETIME NULL  ,
  `updated_at` DATETIME NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Table: tautan_terkait
DROP TABLE IF EXISTS `tautan_terkait`;
CREATE TABLE `tautan_terkait` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nama` VARCHAR(255) NOT NULL  ,
  `url` VARCHAR(255) NOT NULL  ,
  `created_at` DATETIME NULL  ,
  `updated_at` DATETIME NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tautan_terkait` (`id`, `nama`, `url`, `created_at`, `updated_at`) VALUES ('1', 'Pemerintah Kabupaten Malang', 'https://malangkab.go.id', NULL, NULL);
INSERT INTO `tautan_terkait` (`id`, `nama`, `url`, `created_at`, `updated_at`) VALUES ('2', 'Kementerian Desa PDTT', 'https://kemendesa.go.id', NULL, NULL);
INSERT INTO `tautan_terkait` (`id`, `nama`, `url`, `created_at`, `updated_at`) VALUES ('3', 'Sistem Informasi Desa', 'https://sid.kemendesa.go.id', NULL, NULL);
INSERT INTO `tautan_terkait` (`id`, `nama`, `url`, `created_at`, `updated_at`) VALUES ('4', 'Puskesmas Kec. Dau', 'https://puskesmasdau.malangkab.go.id', NULL, NULL);
INSERT INTO `tautan_terkait` (`id`, `nama`, `url`, `created_at`, `updated_at`) VALUES ('5', 'Kecamatan Dau', 'https://dau.malangkab.go.id', NULL, NULL);
INSERT INTO `tautan_terkait` (`id`, `nama`, `url`, `created_at`, `updated_at`) VALUES ('6', 'LAPOR! Kabupaten Malang', 'https://lapor.go.id', NULL, NULL);

-- Table: widget_aparat
DROP TABLE IF EXISTS `widget_aparat`;
CREATE TABLE `widget_aparat` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `foto_kades` VARCHAR(255) NULL  ,
  `nama_kades` VARCHAR(255) NULL  ,
  `sambutan` TEXT NULL  ,
  `created_at` DATETIME NULL  ,
  `updated_at` DATETIME NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `widget_aparat` (`id`, `foto_kades`, `nama_kades`, `sambutan`, `created_at`, `updated_at`) VALUES ('1', NULL, 'Bambang Soponyono', 'Selamat datang di website resmi Desa Selorejo. Kami berkomitmen untuk mewujudkan desa yang mandiri, transparan, dan berdaya saing melalui pemanfaatan teknologi digital. Kunjungi kebun jeruk keprok kami dan rasakan pengalaman agrowisata yang tak terlupakan.', '2026-04-12 11:21:55', '2026-04-12 11:21:55');

-- Table: activity_logs
DROP TABLE IF EXISTS `activity_logs`;
CREATE TABLE `activity_logs` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` INT NOT NULL  ,
  `action` VARCHAR(255) NOT NULL  ,
  `created_at` DATETIME NOT NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `created_at`) VALUES ('1', '1', 'Menambahkan Akun Operator: Test Operator', '2026-04-12 11:49:22');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `created_at`) VALUES ('2', '1', 'Melakukan Backup Database', '2026-04-12 11:49:37');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `created_at`) VALUES ('3', '1', 'Update Pengaturan Web', '2026-04-12 11:50:44');

-- Table: settings
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `key` VARCHAR(255) NOT NULL  ,
  `value` TEXT NULL  ,
  `created_at` DATETIME NULL  ,
  `updated_at` DATETIME NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('1', 'nama_desa', 'Desa Selorejo', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('2', 'nama_pemerintah', 'Pemerintah Desa Selorejo', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('3', 'kecamatan', 'Kecamatan Dau', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('4', 'kabupaten', 'Kabupaten Malang', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('5', 'provinsi', 'Jawa Timur', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('6', 'alamat', 'Jl. Raya Selorejo No. 1, Desa Selorejo, Kec. Dau, Kab. Malang 65151', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('7', 'telepon', '0813.3163.5678', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('8', 'whatsapp', '0813.3163.5678', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('9', 'email', 'desawisataselorejo@gmail.com', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('10', 'jam_kerja', 'Senin-Jumat: 08.00-15.00 WIB', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('11', 'facebook', 'https://facebook.com/desaselorejo', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('12', 'instagram', 'https://instagram.com/desaselorejo', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('13', 'youtube', '', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('14', 'kode_pos', '65151', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('15', 'jumlah_penduduk', '3.640', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('16', 'jumlah_kk', '1.024', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('17', 'luas_wilayah', '623', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('18', 'jumlah_dusun', '3', '2026-04-12 11:21:55', '2026-04-12 11:21:55');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('19', 'last_backup', '2026-04-12 18:49:36', '2026-04-12 18:49:36', '2026-04-12 18:49:36');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('20', 'slogan', 'Desa Wisata Petik Jeruk Selorejo - Updated', '2026-04-12 18:50:43', '2026-04-12 18:50:43');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('21', 'telepon_desa', NULL, '2026-04-12 18:50:44', '2026-04-12 18:50:44');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('22', 'email_desa', NULL, '2026-04-12 18:50:44', '2026-04-12 18:50:44');

SET FOREIGN_KEY_CHECKS=1;
