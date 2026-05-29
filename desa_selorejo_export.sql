-- Desa Selorejo Full MySQL Export (Schema + Data)
SET FOREIGN_KEY_CHECKS = 0;

-- Structure for table: users
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` TEXT,
  `email` TEXT,
  `role` TEXT,
  `password` TEXT,
  `remember_token` TEXT,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table: users
INSERT INTO `users` (`id`, `name`, `email`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES ('1', 'Administrator', 'admin@selorejo.desa.id', 'admin', '$2y$12$yFUKk4GgnpGN19NS5mO4EebWFAuraepa/qEeoQDSQw3UZcAGqEB7.', NULL, '2026-04-13 15:50:03', '2026-04-13 15:50:03');
INSERT INTO `users` (`id`, `name`, `email`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES ('2', 'Operator Desa', 'operator@selorejo.desa.id', 'operator', '$2y$12$4eRDnzCL5i2JGiXTXNh.VOgUIJq4JTV4xFG.c3oGDS3zAWIRmvXoO', 'hL3oT7IRnqtMwhUEYIQ2KH0i9hzkC5zbuKUN3Cw58Pea6INGUxtfFlqiOmdC', '2026-04-13 15:50:03', '2026-04-13 15:50:03');


-- Structure for table: profiles
DROP TABLE IF EXISTS `profiles`;
CREATE TABLE `profiles` (
  `id` BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `sejarah` LONGTEXT,
  `visi_misi` LONGTEXT,
  `geografi` LONGTEXT,
  `batas_wilayah` LONGTEXT,
  `peta_embed` LONGTEXT,
  `stats_suhu` TEXT,
  `stats_ketinggian` TEXT,
  `stats_hujan` TEXT,
  `stats_luas` TEXT,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `sejarah_timeline` LONGTEXT,
  `visi` LONGTEXT,
  `misi` LONGTEXT,
  `geografi_stats` LONGTEXT,
  `batas_wilayah_json` LONGTEXT,
  `peta_deskripsi` LONGTEXT,
  `peta_rute_pribadi` LONGTEXT,
  `peta_rute_umum` LONGTEXT,
  `hero_sejarah` LONGTEXT,
  `hero_visimisi` LONGTEXT,
  `hero_geografi` LONGTEXT,
  `hero_peta` LONGTEXT,
  `motto` TEXT,
  `dusun_info` LONGTEXT,
  `peta_image` TEXT,
  `peta_narasi_utama` LONGTEXT,
  `peta_narasi_legenda` LONGTEXT,
  `peta_fasilitas` LONGTEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table: profiles
INSERT INTO `profiles` (`id`, `sejarah`, `visi_misi`, `geografi`, `batas_wilayah`, `peta_embed`, `stats_suhu`, `stats_ketinggian`, `stats_hujan`, `stats_luas`, `created_at`, `updated_at`, `sejarah_timeline`, `visi`, `misi`, `geografi_stats`, `batas_wilayah_json`, `peta_deskripsi`, `peta_rute_pribadi`, `peta_rute_umum`, `hero_sejarah`, `hero_visimisi`, `hero_geografi`, `hero_peta`, `motto`, `dusun_info`, `peta_image`, `peta_narasi_utama`, `peta_narasi_legenda`, `peta_fasilitas`) VALUES ('1', 'Desa Selorejo yang dikenal saat ini awalnya memiliki akar sejarah yang kuat dengan nama "Watugedhe". Nama ini merujuk pada keberadaan dua batu raksasa tak lazim yang dipercaya memiliki daya mistis (hingga kini batu tersebut masih berada di lokasi aslinya). Perjalanan desa ini dimulai sekitar pertengahan abad ke-18 pasca Perang Diponegoro. Para pionir, yakni Mbah H. Turejo dan Mbah Sayang, bersama rombongan pelarian dari Mataram Islam yang melawan kolonial Belanda, melakukan "Babat Alas" atau pembukaan lahan di tengah hutan lebat lereng gunung sebagai hunian baru.

Seiring waktu, nama Watugedhe bertransformasi menjadi Selorejo, yang diambil dari kombinasi kata "Selo" (batu) dan "Rejo" (diambil dari nama Mbah H. Turejo), melambangkan wilayah berbatu yang dibangun dan dimakmurkan oleh sang pendiri.

Sebelum dikenal sebagai penghasil jeruk, wilayah Selorejo merupakan lahan subur yang didominasi oleh tanaman sayur-mayur. Transformasi besar terjadi pada awal dekade 1990-an ketika muncul inisiatif dari dua tokoh masyarakat visioner, Abah Sulaiman dan Abah Dulawi. Mereka mulai merintis penanaman bibit jeruk keprok setelah melihat potensi topografi desa yang berada di ketinggian 650-1000 mdpl dengan suhu udara sejuk yang sangat ideal bagi pertumbuhan jeruk.

Memasuki era modern, potensi agrikultur ini dikembangkan lebih jauh menjadi sektor pariwisata yang terintegrasi. Pada tahun 2011, Pemerintah Kabupaten Malang secara resmi mencanangkan Selorejo sebagai "Desa Wisata Jeruk". Kini, Selorejo telah mengukuhkan posisinya sebagai salah satu destinasi wisata unggulan di Jawa Timur yang mandiri dan berkelanjutan.', '<h5>SATATA GAMA KARTA RAHARJA</h5>
                           <p>"Terwujudnya Tatanan Kehidupan Masyarakat Desa Selorejo yang Agamis, Demokratis, Mandiri, Bersih, Indah dan Aman"</p>
                           <ul>
                               <li>Mewujudkan pemahaman dan pengamalan nilai-nilai agama, adat istiadat, dan budaya lokal.</li>
                               <li>Mewujudkan tata kelola pemerintahan yang baik, bersih, siap melayani, dan melindungi.</li>
                               <li>Menyatukan visi dalam membangun desa dengan asas kebersamaan (roso rumongso handarbeni / saiyek saeko proyo).</li>
                               <li>Mewujudkan usaha peningkatan kualitas sumber daya manusia (SDM) masyarakat desa.</li>
                               <li>Mewujudkan kesejahteraan berbasis pertanian dengan menggalakkan UMKM dan pemberdayaan masyarakat.</li>
                               <li>Meningkatkan kualitas lingkungan hidup melalui sistem pengelolaan sumber daya alam yang berkelanjutan.</li>
                               <li>Membangun komunikasi dan kerja sama yang baik antara pemerintah desa, masyarakat, dan instansi lainnya.</li>
                           </ul>', 'Desa Selorejo secara strategis berada di Kecamatan Dau, Kabupaten Malang, dengan koordinat kisaran 7°56''16.50" LS dan 112°32''38.93" BT. Desa ini berada pada wilayah tinggi bersuhu sejuk yang ekstrem, yakni antara 800 hingga 1.200 meter di atas permukaan laut (mdpl). Kawasan desa dikelilingi oleh bentang alam yang luas, termasuk lebih dari 2.068 hektare area hutan (lindung dan produksi) dan lebih dari 238 hektare lahan perkebunan, menjadikannya paru-paru hijau dan kawasan tangkapan air vital bagi Kabupaten Malang.

Kondisi topografi Desa Selorejo didominasi oleh perbukitan. Struktur tanah pertanian murni yang mencapai tingkat kesuburan 100% dan suhu rata-rata sejuk menciptakan ekosistem yang sangat ideal bagi sektor agrikultur murni. Curah hujan yang stabil mendukung produktivitas lahan, terutama untuk budidaya komoditas unggulan Jeruk yang ditopang oleh subsektor peternakan (sapi, kambing, ayam, lele).

Dari aspek sosial-kewilayahan, Selorejo memiliki karakteristik khas yang menjadi kebanggaan tersendiri. Masyarakat desa dikenal sangat tangguh dan memiliki sifat bawaan "Sumeh" (ramah senyum). Karakteristik ramah tamah yang tulus ini pada akhirnya berpadu harmonis dengan lanskap alam yang asri.', 'Utara: Desa Gadingkulon, Kec. Dau
Selatan: Desa Petungsewu, Kec. Dau
Timur: Desa Tegalweru, Kec. Dau
Barat: Kawasan Hutan Lindung', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15806.384864810932!2d112.53843605!3d-7.937170050000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7883ef912d9999%3A0xf8ff8468809efd9c!2sSelorejo%2C%20Kec.%20Dau%2C%20Kabupaten%20Malang%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1775912011055!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', '18-26°C', '1.200 mdpl', '2.000 mm', '623 Ha', '2026-04-13 15:50:03', '2026-04-13 16:38:29', '[{"year":"Pertengahan Abad ke-18","title":"Era Watugedhe (Babat Alas)","desc":"Pembukaan lahan di masa akhir Perang Diponegoro oleh rombongan pelarian dari Mataram Islam yang dipimpin Mbah H. Turejo dan Mbah Sayang.","icon":"tag"},{"year":"Awal Abad ke-20","title":"Formalisasi Nama Selorejo","desc":"Perubahan nama resmi dari Watugedhe menjadi Selorejo sebagai bentuk penghormatan kepada perintis desa.","icon":"tag"},{"year":"Tahun 1990","title":"Era Revolusi Jeruk","desc":"Abah Sulaiman dan Abah Dulawi merintis penanaman jeruk keprok secara masif menggantikan tanaman sayur.","icon":"sun"},{"year":"Tahun 2011","title":"Peresmian Desa Wisata","desc":"Pemerintah Kabupaten Malang secara resmi mencanangkan Desa Selorejo sebagai destinasi \\"Agrowisata Petik Jeruk\\".","icon":"map-pin"},{"year":"Masa Kini","title":"Pusat Agrowisata Nasional","desc":"Selorejo memantapkan diri sebagai pusat edukasi agrowisata dan pemasok utama jeruk premium nasional.","icon":"check-circle"}]', '"Terwujudnya Tatanan Kehidupan Masyarakat Desa Selorejo yang Agamis, Demokratis, Mandiri, Bersih, Indah dan Aman"', '[{"icon":"book-open","text":"Mewujudkan pemahaman dan pengamalan nilai-nilai agama, adat istiadat, dan budaya lokal."},{"icon":"shield-check","text":"Mewujudkan tata kelola pemerintahan yang baik, bersih, siap melayani, dan melindungi."},{"icon":"users","text":"Menyatukan visi dalam membangun desa dengan asas kebersamaan (roso rumongso handarbeni \\/ saiyek saeko proyo)."},{"icon":"graduation-cap","text":"Mewujudkan usaha peningkatan kualitas sumber daya manusia (SDM) masyarakat desa."},{"icon":"sprout","text":"Mewujudkan kesejahteraan berbasis pertanian dengan menggalakkan UMKM dan pemberdayaan masyarakat."},{"icon":"leaf","text":"Meningkatkan kualitas lingkungan hidup melalui sistem pengelolaan sumber daya alam yang berkelanjutan."},{"icon":"network","text":"Membangun komunikasi dan kerja sama yang baik antara pemerintah desa, masyarakat, dan instansi lainnya."}]', '[{"icon":"cloud-sun","value":"18-26\\u00b0C","label":"Suhu Rata-rata"},{"icon":"mountain","value":"1.200 mdpl","label":"Ketinggian Maks."},{"icon":"cloud-rain","value":"2.000 mm","label":"Curah Hujan \\/ Thn"},{"icon":"map","value":"623 Ha","label":"Luas Wilayah"}]', '[{"dir":"Utara","text":"Desa Gadingkulon, Kec. Dau","icon":"compass","rotate":"0"},{"dir":"Selatan","text":"Desa Petungsewu, Kec. Dau","icon":"compass","rotate":"180"},{"dir":"Timur","text":"Desa Tegalweru, Kec. Dau","icon":"compass","rotate":"90"},{"dir":"Barat","text":"Kawasan Hutan Lindung","icon":"compass","rotate":"-90"}]', 'Dapat diakses 30 menit dari Kota Malang ke arah Barat (Batu). Tersedia angkutan pedesaan jalur stasiun ke wilayah Terminal Landungsari.', 'Dapat diakses 30 menit dari Kota Malang ke arah Barat (Batu).', 'Tersedia angkutan pedesaan jalur stasiun ke wilayah Terminal Landungsari.', '{"title":"Sejarah Desa","subtitle":"Menelusuri jejak peradaban dan perkembangan Desa Selorejo dari masa ke masa.","icon":"history"}', '{"title":"Visi & Misi","subtitle":"Arah dan tujuan pembangunan Desa Selorejo ke depan.","icon":"target"}', '{"title":"Kondisi Geografis","subtitle":"Letak, topografi, dan iklim yang mendukung pertanian.","icon":"mountain"}', '{"title":"Peta Wilayah Desa","subtitle":"Penunjuk arah digital menuju Desa Wisata Petik Jeruk Selorejo","icon":"map"}', 'SATATA GAMA KARTA RAHARJA', '[{"nama":"Dusun Krajan","geografi_desc":"Dusun terluas dan terpadat permukimannya, meliputi RW I hingga RW IV (12 RT).","peta_desc":"Berlokasi di bagian tengah hingga timur desa. Merupakan kawasan terluas, terpadat, dan menjadi pusat aktivitas utama penduduk.","admin_rw":"RW I - RW IV","admin_rt":"12 RT (RT.01 - RT.12)","color_theme":"success"},{"nama":"Dusun Selokerto","geografi_desc":"Berlokasi di sisi barat desa yang cukup padat, meliputi sebagian RW V dan RW VI (7 RT).","peta_desc":"Berlokasi di sisi barat\\/kiri dari peta desa. Cukup padat, terutama berkonsentrasi di sektor utara dan tengah wilayah dusun.","admin_rw":"RW V - RW VI (Sebagian)","admin_rt":"7 RT (RT.13 - RT.19)","color_theme":"warning"},{"nama":"Dusun Gumuk","geografi_desc":"Berlokasi di selatan-barat desa, meliputi satu lingkungan spesifik di RW VI (1 RT).","peta_desc":"Berlokasi merapat di bagian barat daya. Relatif memiliki sebaran bangunan pemukiman yang lebih sedikit dibanding dua dusun lainnya.","admin_rw":"RW VI (Sebagian)","admin_rt":"1 RT (RT.20)","color_theme":"primary"}]', 'images/Peta Desa Selorejo.jpg', 'Berdasarkan pemetaan struktural, batas wilayah Utara terhubung ke Desa Gading Kulon, Timur ke Tegal Weru, Selatan ke Petung Sewu, dan Barat berupa hamparan hutan murni.', 'Peta desa ini berfungsi tidak hanya secara administratif, tapi juga sosial-ekonomi. Pemukiman diklasifikasikan menjadi tiga tingkatan: Rumah Miskin, Rumah Sedang, dan Rumah Kaya, guna memfasilitasi perencanaan tata ruang dan program kesejahteraan yang tepat sasaran.', '[{"icon":"check-circle","text":"Balai Desa sebagai pusat administrasi."},{"icon":"check-circle","text":"Balai Dukuh di masing-masing area Dusun."},{"icon":"check-circle","text":"Fasilitas Pendidikan (SD)."},{"icon":"check-circle","text":"Jalur utama penghubung antar Dusun."}]');


-- Structure for table: struktur_organisasi
DROP TABLE IF EXISTS `struktur_organisasi`;
CREATE TABLE `struktur_organisasi` (
  `id` BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `jabatan` TEXT,
  `nama_pejabat` TEXT,
  `foto` TEXT,
  `urutan` INT(11),
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table: struktur_organisasi
INSERT INTO `struktur_organisasi` (`id`, `jabatan`, `nama_pejabat`, `foto`, `urutan`, `created_at`, `updated_at`) VALUES ('1', 'Kepala Desa', 'Bambang Soponyono', NULL, '1', NULL, '2026-04-13 22:08:50');
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


-- Structure for table: bpd
DROP TABLE IF EXISTS `bpd`;
CREATE TABLE `bpd` (
  `id` BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nama` TEXT,
  `jabatan` TEXT,
  `foto` TEXT,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table: bpd
INSERT INTO `bpd` (`id`, `nama`, `jabatan`, `foto`, `created_at`, `updated_at`) VALUES ('1', 'Moch. Zainul Arifin', 'Ketua BPD', NULL, NULL, NULL);
INSERT INTO `bpd` (`id`, `nama`, `jabatan`, `foto`, `created_at`, `updated_at`) VALUES ('2', 'Slamet Riyadi', 'Wakil Ketua BPD', NULL, NULL, NULL);
INSERT INTO `bpd` (`id`, `nama`, `jabatan`, `foto`, `created_at`, `updated_at`) VALUES ('3', 'Nurul Hidayah', 'Sekretaris BPD', NULL, NULL, NULL);
INSERT INTO `bpd` (`id`, `nama`, `jabatan`, `foto`, `created_at`, `updated_at`) VALUES ('4', 'Agus Supriyanto', 'Anggota BPD', NULL, NULL, NULL);
INSERT INTO `bpd` (`id`, `nama`, `jabatan`, `foto`, `created_at`, `updated_at`) VALUES ('5', 'Eni Kusumawati', 'Anggota BPD', NULL, NULL, NULL);
INSERT INTO `bpd` (`id`, `nama`, `jabatan`, `foto`, `created_at`, `updated_at`) VALUES ('6', 'Fandi Ahmad', 'Anggota BPD', NULL, NULL, NULL);
INSERT INTO `bpd` (`id`, `nama`, `jabatan`, `foto`, `created_at`, `updated_at`) VALUES ('7', 'Ratna Dewi', 'Anggota BPD', NULL, NULL, NULL);


-- Structure for table: lembaga_desa
DROP TABLE IF EXISTS `lembaga_desa`;
CREATE TABLE `lembaga_desa` (
  `id` BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nama_lembaga` TEXT,
  `jenis` TEXT,
  `ketua` TEXT,
  `deskripsi` LONGTEXT,
  `foto` TEXT,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table: lembaga_desa
INSERT INTO `lembaga_desa` (`id`, `nama_lembaga`, `jenis`, `ketua`, `deskripsi`, `foto`, `created_at`, `updated_at`) VALUES ('1', 'LPMD', 'LPMD', 'Pardi Susanto', 'Lembaga Pemberdayaan Masyarakat Desa Selorejo bertugas merencanakan dan menggerakkan swadaya gotong royong masyarakat dalam pelaksanaan pembangunan.', NULL, NULL, NULL);
INSERT INTO `lembaga_desa` (`id`, `nama_lembaga`, `jenis`, `ketua`, `deskripsi`, `foto`, `created_at`, `updated_at`) VALUES ('2', 'Karang Taruna Selorejo Muda', 'Karang Taruna', 'Rizky Pratama', 'Karang Taruna Desa Selorejo aktif dalam kegiatan kepemudaan, sosial, dan pengembangan potensi wisata desa bagi generasi muda.', NULL, NULL, NULL);
INSERT INTO `lembaga_desa` (`id`, `nama_lembaga`, `jenis`, `ketua`, `deskripsi`, `foto`, `created_at`, `updated_at`) VALUES ('3', 'PKK Desa Selorejo', 'PKK', 'Ny. Hj. Sutrisno', 'PKK Desa Selorejo aktif dalam pemberdayaan perempuan, posyandu, ketahanan pangan keluarga, dan kegiatan sosial kemasyarakatan.', NULL, NULL, NULL);
INSERT INTO `lembaga_desa` (`id`, `nama_lembaga`, `jenis`, `ketua`, `deskripsi`, `foto`, `created_at`, `updated_at`) VALUES ('4', 'Linmas Desa Selorejo', 'Linmas', 'Suharto', 'Satuan Perlindungan Masyarakat (Linmas) Desa Selorejo bertugas menjaga ketentraman, ketertiban, dan keamanan lingkungan desa.', NULL, NULL, NULL);


-- Structure for table: wisata
DROP TABLE IF EXISTS `wisata`;
CREATE TABLE `wisata` (
  `id` BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `judul` TEXT,
  `deskripsi` LONGTEXT,
  `harga_tiket` TEXT,
  `jadwal` LONGTEXT,
  `aturan` LONGTEXT,
  `gambar` TEXT,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `kategori` TEXT,
  `likes` INT(11),
  `dislikes` INT(11),
  `views` INT(11),
  `shares` INT(11),
  `whatsapp` TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table: wisata
INSERT INTO `wisata` (`id`, `judul`, `deskripsi`, `harga_tiket`, `jadwal`, `aturan`, `gambar`, `created_at`, `updated_at`, `kategori`, `likes`, `dislikes`, `views`, `shares`, `whatsapp`) VALUES ('1', 'Agrowisata Petik Jeruk Selorejo', 'Menjadi ikon utama Wisata Desa Selorejo, Agrowisata Petik Jeruk menawarkan pengalaman autentik berada di tengah hamparan kebun jeruk seluas puluhan hektare di lereng pegunungan yang sangat sejuk. Varietas unggulan yang dibudidayakan di sini adalah Jeruk Keprok Batu 55 dan Jeruk Babal, yang terkenal akan perpaduan rasa manis segar dan bulir yang melimpah. Udara pegunungan yang mencapai 18-22 derajat celcius menjadikan wisata ini sangat cocok untuk melepaskan penat dari hiruk pikuk perkotaan.

Pengunjung tidak hanya sekadar berjalan-jalan, melainkan diizinkan secara leluasa untuk mencicipi langsung dan memetik jeruk dari pohonnya. Tersedia pula edukasi pertanian singkat dari para petani lokal mengenai cara pembibitan, perawatan, hingga membedakan buah jeruk yang matang sempurna. Lokasi ini seringkali menjadi tujuan wisata keluarga terbaik karena aman untuk anak-anak dan sarat akan nilai edukasi lingkungan.', '20000', 'Senin - Minggu: 08.00 - 16.00 WIB (Musim Panen Raya: Juni - Desember)', '1. Tiket masuk sudah termasuk makan jeruk sepuasnya secara gratis di dalam kebun.
2. Jeruk yang dipetik dan dibawa pulang akan ditimbang dan dikenakan tarif perkilo (harga petani).
3. Pengunjung dilarang keras mematahkan ranting atau merusak bunga bakal buah saat memetik.
4. Harap membuang kulit jeruk pada tong sampah organik yang telah disediakan di tiap sudut kebun.', 'https://images.unsplash.com/photo-1557800636-894a64c1696f?w=1200', '2026-04-19 06:37:53', '2026-04-19 21:13:51', 'Agrowisata', '172', '1', '355', '86', NULL);
INSERT INTO `wisata` (`id`, `judul`, `deskripsi`, `harga_tiket`, `jadwal`, `aturan`, `gambar`, `created_at`, `updated_at`, `kategori`, `likes`, `dislikes`, `views`, `shares`, `whatsapp`) VALUES ('2', 'Bumi Perkemahan Bedengan', 'Terletak strategis di kaki Gunung Panderman dan Gunung Kawi, Bumi Perkemahan Bedengan adalah oasis ketenangan di tengah hutan pinus yang berusia puluhan tahun. Aroma khas getah pinus berpadu dengan gemericik aliran sungai berbatu bening yang melintasi area perkemahan menciptakan suasana relaksasi alam yang tidak ada duanya. Kawasan Bedengan mempertahankan kontur aslinya tanpa banyak sentuhan beton buatan, sehingga kelestariannya masih terjaga murni.

Fasilitas di area camping ground ini telah ditata sedemikian rupa untuk memfasilitasi kegiatan Jambore, Outbound Perusahaan, hingga keluarga yang ingin membangun tenda akhir pekan. Pengelola menyediakan persewaan tenda, matras, hingga kayu bakar bagi wisatawan yang datang tanpa persiapan. Saat malam tiba, hamparan bintang di langit dapat terlihat sangat jelas karena minimnya polusi cahaya di kawasan hutan perhutani ini.', '15000', 'Kunjungan Reguler: 07.00 - 17.00 WIB
Camping & Menginap: Buka 24 Jam Non-Stop', '1. Dilarang keras membawa benda tajam berbahaya dan minuman keras ke area perkemahan.
2. Biaya camping/menginap adalah Rp 35.000,- per tenda per malam (di luar tiket masuk awal).
3. Dilarang menyalakan api unggun sembarangan selain di tungku batu/area yang sudah dikonstruksi.
4. Jam malam diberlakukan pukul 22.00 WIB; harap mengecilkan suara musik demi ketenangan bersama.', 'https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7?w=1200', '2026-04-19 06:37:53', '2026-04-19 07:35:18', 'Wisata Alam', '110', '2', '816', '66', NULL);
INSERT INTO `wisata` (`id`, `judul`, `deskripsi`, `harga_tiket`, `jadwal`, `aturan`, `gambar`, `created_at`, `updated_at`, `kategori`, `likes`, `dislikes`, `views`, `shares`, `whatsapp`) VALUES ('3', 'Air Terjun Brues', 'Misteri keindahan alam yang tersembunyi di kedalaman vegetasi rimbun Desa Selorejo. Air Terjun Brues menawarkan keheningan eksotis dengan sumber mata air pegunungan yang sangat jernih dan menyegarkan. Berbeda dengan air terjun populer lainnya yang riuh, Brues membawakan kesan ''private resort'' alami. Akses menuju lokasi memerlukan tracking ringan menyusuri jalan setapak pinggir sungai sejauh kurang lebih 1,5 kilometer yang dipenuhi oleh rimbunan paku-pakuan dan spesies burung endemik.

Curahan air terjun setinggi 12 meter ini bermuara pada cekungan kolam alami yang tidak terlalu dalam, sehingga relatif aman bagi pengunjung yang ingin sekadar berendam atau bermain air. Keberadaan tebing batuan purba di sekeliling air terjun menjadikannya spot fotografi alam liar yang sangat dramatis dan memukau.', '5000', 'Senin - Minggu: 07.00 - 15.00 WIB (Sangat disarankan kunjungan pagi hari)', '1. Pengunjung wajib melaporkan diri ke Pos Pemuda Perhutani di desa sebelum melakukan tracking.
2. Tidak dianjurkan berkunjung atau tracking pada saat cuaca mendung gelap atau hujan lebat guna menghindari volume air mendadak.
3. Jangan membuang sampah plastik; bawalah turun kembali sampah Anda ke desa.
4. Patuhi marka jalan pita yang diikatkan di pohon sepanjang jalur tracking.', 'https://images.unsplash.com/photo-1433086966358-54859d0ed716?w=1200', '2026-04-19 06:37:53', '2026-04-19 07:23:31', 'Wisata Alam', '41', '0', '236', '13', NULL);
INSERT INTO `wisata` (`id`, `judul`, `deskripsi`, `harga_tiket`, `jadwal`, `aturan`, `gambar`, `created_at`, `updated_at`, `kategori`, `likes`, `dislikes`, `views`, `shares`, `whatsapp`) VALUES ('4', 'Adventure Trail & Sirkuit ATV', 'Bagi para pencinta adrenalin dan olahraga otomotif, kontur perbukitan Desa Selorejo menyediakan lintasan menantang melalui wahana Adventure Trail dan Sirkuit ATV. Melintasi berbagai macam medan seperti jalan tanah merah berlumpur, sungai dangkal, hingga tanjakan menukik tebing di sela-sela perkebunan apel dan jeruk. Sirkuit ini dirancang oleh komunitas off-road lokal untuk memastikan keamanan sekaligus memberikan sensasi guncangan alam liar yang memompa jantung.

Pengelola menyediakan penyewaan lengkap unit motor Trail 150cc dan kendaraan ATV penggerak ganda (4x4) beserta pelindung keselamatan standar penuh (Helm, Goggle, Body Protector). Tak perlu khawatir tersesat, karena rute trail ini sudah dipandu oleh marshall berpengalaman yang akan menemani perjalanan Anda menembus pesona alam Selorejo dengan cara yang jauh berbeda dan maskulin.', '150000', 'Sabtu, Minggu & Hari Libur Nasional: 08.00 - 16.00 WIB (Menyesuaikan kondisi sirkuit/cuaca)', '1. Peserta wahana diwajibkan menggunakan seluruh perlengkapan instrumen keamanan dasar (Helm, Sepatu safety, padding).
2. Batasan usia minimal bagi penyewa ATV solo adalah 15 tahun.
3. Dilarang memutar rute keluar dari jalur yang sudah diberi bendera marka karena berisiko berpapasan tajam.
4. Jika kendaraan mengalami kendala teknis (mogok di jalur), dilarang membongkar sendiri; tunggu marshall tiba.', 'https://images.unsplash.com/photo-1531641022831-291772186846?w=1200', '2026-04-19 06:37:53', '2026-04-19 07:23:31', 'Agrowisata', '86', '9', '335', '18', NULL);
INSERT INTO `wisata` (`id`, `judul`, `deskripsi`, `harga_tiket`, `jadwal`, `aturan`, `gambar`, `created_at`, `updated_at`, `kategori`, `likes`, `dislikes`, `views`, `shares`, `whatsapp`) VALUES ('5', 'Wisata Kesenian & Budaya Jawi', 'Desa Selorejo bukan melulu soal keindahan panoramanya, namun roh pariwisata mereka juga sangat kental berkat lestarinya api kesenian peradaban leluhur Nusantara. Kelompok Karawitan dan komunitas Tari Bantengan lokal membawakan atraksi seni yang memukau sebagai wujud komitmen regenerasi kebudayaan pada generasi muda. Di sanggar wisata budaya, suara tabuhan kendang, saron, dan gong akan menyambut kedatangan Anda dengan aura mistis sekaligus megah.

Wisatawan yang datang dalam bentuk rombongan (sekolah atau studi tour) biasanya akan diajak berlatih dasar-dasar memukul bilah gamelan, belajar mengikat udeng, serta mengenal filosofi tarian Jaran Kepang dan Bantengan asli Malang. Tempat ini merupakan ruang pelestarian nyata yang interaktif; menghubungkan pesona pariwisata dengan keakraban nilai etnik pedesaan peninggalan Mataraman kuno.', '0', 'Latihan Sanggar Terbuka: Setiap Malam Minggu Pukul 19.30 WIB. 
(Reservasi grup edukasi buka setiap hari kerja)', '1. Sanggar terbuka secara gratis dan bebas untuk disaksikan masyarakat umum dengan tertib.
2. Harap berpakaian wajar dan menjaga kesopanan tutur kata saat berada di sekitar instrumen sakral gamelan.
3. Dilarang menaiki atau memukul instrumen gamelan tanpa didampingi oleh instruktur seniman setempat.
4. Pendokumentasian foto/video sangat dipersilakan demi membantu memajukan promosi kesenian desa.', 'https://images.unsplash.com/photo-1598001859187-b2478f7e2c9e?w=1200', '2026-04-19 06:37:53', '2026-04-19 07:23:31', 'Budaya & Event', '63', '8', '743', '83', NULL);
INSERT INTO `wisata` (`id`, `judul`, `deskripsi`, `harga_tiket`, `jadwal`, `aturan`, `gambar`, `created_at`, `updated_at`, `kategori`, `likes`, `dislikes`, `views`, `shares`, `whatsapp`) VALUES ('6', 'Karnaval Tumpeng Jeruk Ageng', 'Karnaval Tumpeng Jeruk Ageng adalah Puncak Kemeriahan dan hari paling sibuk di Desa Selorejo yang dinanti-nanti secara antusias setiap setahun sekali. Acara ini merupakan karnaval budaya sekaligus perwujudan syukur warga (sedekah bumi) atas panen raya raya buah jeruk dan melimpahnya sumber mata air untuk pertanian. Ribuan buah jeruk keprok segar disusun menjulang tinggi mencapai 3 hingga 5 meter menyerupai gunungan tumpeng raksasa, diarak beramai-ramai melintasi poros balai desa menuju batas akhir perkemahan.

Tak hanya arak-arakan tumpeng, event ini dimeriahkan juga oleh pasukan drumband pemuda, defile kebaya lokal, pameran hasil bumi hias, dan pesta kembang api di penghujung hari. Puncaknya adalah ketika sesepuh desa selesai merapalkan doa keselamatan, dan warga serta wisatan bersama-sama bergotong-royong merebut tumpeng jeruk tersebut (*Grebeg Jeruk*). Acara ini merepresentasikan nilai kerukunan serta magnet masif yang menarik turis asing maupun domestik tumpah ruah di Selorejo.', '0', 'Event Pariwisata Tahunan (Diselenggarakan setiap akhir bulan Agustus / Puncak Panen Raya)', '1. Acara berskala besar ini terbuka secara umum dan 100% gratis sebagai pelestarian Sedekah Bumi desa.
2. Saat prosesi Grebeg (perebutan) Jeruk, dilarang saling mendorong kasar atau mencederai; utamakan keselamatan wanita dan anak.
3. Hindari memarkir kendaraan sembarangan di bahu jalan poros utama desa agar tidak memblokir mobilisasi warga yang mengarak.
4. Jaga barang bawaan berharga Anda di tengah lautan manusia.', 'https://images.unsplash.com/photo-1620608639207-657743905e94?w=1200', '2026-04-19 06:37:53', '2026-04-19 07:23:31', 'Budaya & Event', '139', '5', '417', '47', NULL);


-- Structure for table: galeri
DROP TABLE IF EXISTS `galeri`;
CREATE TABLE `galeri` (
  `id` BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `tipe` TEXT,
  `url` TEXT,
  `caption` TEXT,
  `kategori` TEXT,
  `tanggal` TEXT,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table: galeri
INSERT INTO `galeri` (`id`, `tipe`, `url`, `caption`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES ('1', 'foto', 'https://images.unsplash.com/photo-1542442828-287217bfb218?w=800', 'Camping Ground Bumi Perkemahan Bedengan', 'Wisata Alam', '2026-03-01 00:00:00', '2026-04-13 19:01:48', '2026-04-13 19:01:48');
INSERT INTO `galeri` (`id`, `tipe`, `url`, `caption`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES ('2', 'foto', 'https://images.unsplash.com/photo-1596489312224-87f5e8daadd1?w=800', 'Atmosfer Berkemah di Hutan Pinus Selorejo', 'Wisata Alam', '2026-03-05 00:00:00', '2026-04-13 19:01:48', '2026-04-13 19:01:48');
INSERT INTO `galeri` (`id`, `tipe`, `url`, `caption`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES ('3', 'foto', 'https://images.unsplash.com/photo-1559525839-b184a4d698c7?w=800', 'Area Campground Outdoor Ramai Wisatawan', 'Event', '2026-03-10 00:00:00', '2026-04-13 19:01:48', '2026-04-13 19:01:48');
INSERT INTO `galeri` (`id`, `tipe`, `url`, `caption`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES ('4', 'foto', 'https://images.unsplash.com/photo-1627435601357-3f6c76feb185?w=800', 'Hamparan Kebun Jeruk Keprok Batu 55', 'Potensi Desa', '2026-03-12 00:00:00', '2026-04-13 19:01:48', '2026-04-13 19:01:48');
INSERT INTO `galeri` (`id`, `tipe`, `url`, `caption`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES ('5', 'foto', 'https://images.unsplash.com/photo-1590779033100-9f60af05a013?w=800', 'Proses Panen Jeruk oleh Petani Lokal', 'Kegiatan Warga', '2026-03-14 00:00:00', '2026-04-13 19:01:48', '2026-04-13 19:01:48');
INSERT INTO `galeri` (`id`, `tipe`, `url`, `caption`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES ('6', 'foto', 'https://images.unsplash.com/photo-1601614742718-4721c0ad52f7?w=800', 'Pohon Jeruk Rimbun dengan Buah Siap Petik', 'Potensi Desa', '2026-03-15 00:00:00', '2026-04-13 19:01:48', '2026-04-13 19:01:48');
INSERT INTO `galeri` (`id`, `tipe`, `url`, `caption`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES ('7', 'foto', 'https://images.unsplash.com/photo-1518495122543-bc87e5606d54?w=800', 'Terasering Sawah Hijau Selorejo', 'Wisata Alam', '2026-03-16 00:00:00', '2026-04-13 19:01:48', '2026-04-13 19:01:48');
INSERT INTO `galeri` (`id`, `tipe`, `url`, `caption`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES ('8', 'foto', 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=800', 'Panorama Alam Lereng Kawi yang Menyejukkan', 'Wisata Alam', '2026-03-18 00:00:00', '2026-04-13 19:01:48', '2026-04-13 19:01:48');
INSERT INTO `galeri` (`id`, `tipe`, `url`, `caption`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES ('9', 'foto', 'https://images.unsplash.com/photo-1596489312224-87f5e8daadd1?w=800', 'Infrastruktur Jalan Desa yang Rapih Menuju Wisata', 'Infrastruktur', '2026-03-20 00:00:00', '2026-04-13 19:01:48', '2026-04-13 19:01:48');
INSERT INTO `galeri` (`id`, `tipe`, `url`, `caption`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES ('10', 'foto', 'https://images.unsplash.com/photo-1558905623-bc97b76778f5?w=800', 'Kegiatan Gotong Royong Warga Desa', 'Kegiatan Warga', '2026-03-22 00:00:00', '2026-04-13 19:01:48', '2026-04-13 19:01:48');
INSERT INTO `galeri` (`id`, `tipe`, `url`, `caption`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES ('11', 'foto', 'https://images.unsplash.com/photo-1592982537447-6f296cb3adea?w=800', 'Pembangunan Jembatan Desa Selorejo', 'Infrastruktur', '2026-03-24 00:00:00', '2026-04-13 19:01:48', '2026-04-13 19:01:48');
INSERT INTO `galeri` (`id`, `tipe`, `url`, `caption`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES ('12', 'foto', 'https://images.unsplash.com/photo-1588612143093-41bb33659223?w=800', 'Pesta Rakyat Bersih Desa Selorejo', 'Event', '2026-03-26 00:00:00', '2026-04-13 19:01:48', '2026-04-13 19:01:48');


-- Structure for table: produk
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk` (
  `id` BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nama` TEXT,
  `deskripsi` LONGTEXT,
  `harga` TEXT,
  `gambar` TEXT,
  `stok` INT(11),
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `kategori` TEXT,
  `shares` INT(11),
  `whatsapp` TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table: produk
INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `harga`, `gambar`, `stok`, `created_at`, `updated_at`, `kategori`, `shares`, `whatsapp`) VALUES ('1', 'Kopi Arabika Lereng Kawi (200gr)', 'Biji kopi Arabika Selorejo dipanen dari ketinggian 1.200 mdpl di lereng Gunung Kawi, menghasilkan profil rasa yang kompleks dengan dominasi fruity notes seperti apel hijau dan blackberry. Diproses secara natural untuk menjaga karakteristik keasaman yang segar dan tubuh (body) yang sedang, kopi ini menjadi pilihan utama bagi para pecinta kopi specialty yang mencari citarasa autentik pegunungan Malang.', '35000', 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?w=800&q=80', '100', '2026-04-13 19:08:30', '2026-04-19 07:23:31', 'Minuman', '30', NULL);
INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `harga`, `gambar`, `stok`, `created_at`, `updated_at`, `kategori`, `shares`, `whatsapp`) VALUES ('2', 'Jeruk Keprok Batu 55 (1 Kg)', 'Sebagai ikon agrowisata Selorejo, Jeruk Keprok Batu 55 menawarkan perpaduan sempurna antara rasa manis yang kuat dengan sentuhan sensasi asam segar. Buahnya memiliki kulit yang cukup tebal berwarna kuning jingga yang menarik dan mudah dikupas, serta daging buah yang kenyal dan kaya sari buah. Jeruk ini ditanam dengan praktik pertanian ramah lingkungan untuk memastikan setiap gigitannya aman dan menyehatkan bagi keluarga.', '25000', 'https://images.unsplash.com/photo-1557844352-761f2565b576?w=800&q=80', '150', '2026-04-13 19:08:30', '2026-04-19 07:23:31', 'Jeruk Segar', '6', NULL);
INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `harga`, `gambar`, `stok`, `created_at`, `updated_at`, `kategori`, `shares`, `whatsapp`) VALUES ('3', 'Jeruk Baby Java (1 Kg)', 'Jeruk Baby Java Selorejo dikenal sebagai jeruk paling bersahabat bagi pencernaan si kecil berkat kadar asamnya yang sangat rendah namun memiliki tingkat kemanisan alami yang tinggi. Kaya akan Vitamin C dan antioksidan, jeruk ini menjadi favorit untuk dijadikan air perasan bagi bayi (MPASI) maupun sebagai sumber hidrasi harian yang menyegarkan. Tekstur kulitnya yang halus dan daging buahnya yang lembut memberikan kualitas sari buah maksimal di setiap perasannya.', '20000', 'https://images.unsplash.com/photo-1544145945-f904253d0c71?w=800&q=80', '120', '2026-04-13 19:08:30', '2026-04-19 07:23:31', 'Jeruk Segar', '34', NULL);
INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `harga`, `gambar`, `stok`, `created_at`, `updated_at`, `kategori`, `shares`, `whatsapp`) VALUES ('4', 'Keripik Mbote/Talas BUMDes', 'Keripik Mbote adalah camilan warisan leluhur Desa Selorejo yang dibuat dari Umbi Talas (Mbote) pilihan hasil bumi lereng Kawi. Diolah secara higienis oleh kelompok ibu-ibu PKK desa, umbi talas diiris tipis secara presisi dan direndam dalam bumbu rempah rahasia sebelum digoreng hingga mencapai tingkat kerenyahan maksimal. Tanpa bahan pengawet dan MSG, keripik ini menawarkan rasa gurih autentik yang sulit dilupakan.', '15000', 'https://images.unsplash.com/photo-1599599810769-bcde5a160d32?w=800&q=80', '80', '2026-04-13 19:08:30', '2026-04-19 07:23:31', 'Makanan', '5', NULL);
INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `harga`, `gambar`, `stok`, `created_at`, `updated_at`, `kategori`, `shares`, `whatsapp`) VALUES ('5', 'Jamu Instan Temulawak & Jahe', 'Produk unggulan dari Kelompok Wanita Tani (KWT) Selorejo ini menghadirkan kepraktisan minuman kesehatan tradisional dalam bentuk serbuk instan yang mudah diseduh. Campuran Temulawak, Jahe Merah, dan Gula Aren pilihan diolah secara tradisional namun tetap menjaga standar kebersihan untuk memberikan manfaat maksimal bagi daya tahan tubuh dan kehangatan sistem pencernaan. Cocok dinikmati setiap pagi sebagai pendamping gaya hidup sehat Anda.', '20000', 'https://images.unsplash.com/photo-1599321427976-5d63f034ee51?w=800&q=80', '90', '2026-04-13 19:08:30', '2026-04-19 07:23:31', 'Minuman', '16', NULL);
INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `harga`, `gambar`, `stok`, `created_at`, `updated_at`, `kategori`, `shares`, `whatsapp`) VALUES ('6', 'Jeruk Keprok Keranjang Gift', 'Hadirkan kehangatan khas Desa Selorejo melalui paket hadiah eksklusif Jeruk Keprok Keranjang. Berisi 5kg jeruk pilihan kualitas super yang dikemas dalam keranjang bambu tradisional (besek) yang ramah lingkungan dan estetik. Pilihan tepat sebagai oleh-oleh premium atau hantaran spesial bagi kerabat dan kolega, mencerminkan ketulusan hasil bumi langsung dari tangan petani lokal kami.', '135000', 'https://images.unsplash.com/photo-1543328225-b4ee54e173bd?w=800&q=80', '40', '2026-04-13 19:08:30', '2026-04-19 07:23:31', 'Olahan Buah', '22', NULL);
INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `harga`, `gambar`, `stok`, `created_at`, `updated_at`, `kategori`, `shares`, `whatsapp`) VALUES ('7', 'Madu Murni Bunga Jeruk', 'Madu Bunga Jeruk Selorejo merupakan jenis madu monofloral langka yang dihasilkan oleh lebah penghisap nektar bunga pohon jeruk yang mekar secara serempak. Memiliki aroma flora yang harum dengan sentuhan rasa yang ringan dan sedikit citrusy, madu ini kaya akan flavonoid dan enzim aktif yang baik untuk kesehatan lambung dan imunitas. Teksturnya yang jernih dan kemampuannya mengkristal dengan halus menjadi segel keaslian madu murni tanpa campuran.', '85000', 'https://images.unsplash.com/photo-1587049352846-4a222e784d38?w=800&q=80', '50', '2026-04-13 19:08:30', '2026-04-19 07:23:31', 'Makanan', '37', NULL);
INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `harga`, `gambar`, `stok`, `created_at`, `updated_at`, `kategori`, `shares`, `whatsapp`) VALUES ('8', 'Sari Jeruk Selorejo Botolan', 'Nikmati kesegaran murni 100% buah jeruk Selorejo dalam setiap botolnya tanpa tambahan pemanis buatan maupun pengawet. Menggunakan teknologi pengolahan suhu rendah untuk menjaga kandungan vitamin dan nutrisi alami tetap utuh, sari jeruk ini menawarkan rasa manis-segar yang konsisten. Praktis untuk dibawa beraktivitas dan menjadi solusi harian bagi Anda yang membutuhkan asupan Vitamin C instan di tengah kesibukan.', '12000', 'https://images.unsplash.com/photo-1613478223719-2ab802602423?w=800&q=80', '200', '2026-04-13 19:08:30', '2026-04-19 07:23:31', 'Minuman', '20', NULL);
INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `harga`, `gambar`, `stok`, `created_at`, `updated_at`, `kategori`, `shares`, `whatsapp`) VALUES ('9', 'Pupuk Organik Cair Desa', 'Rahasia kesuburan agrowisata kami kini tersedia untuk kebun Anda sendiri. Pupuk Organik Cair (POC) Desa Selorejo diolah dari limbah pertanian dan mikroorganisme lokal (MOL) yang terbukti ampuh meningkatkan kualitas pembungaan dan pembuahan tanaman jeruk. Selain ramah lingkungan, pupuk ini membantu memperbaiki pori-pori tanah dan menyediakan nutrisi esensial bagi tanaman agar tumbuh lebih kuat, tahan penyakit, dan berbuah lebat secara alami.', '45000', 'https://images.unsplash.com/photo-1585314062340-f1a5a7c9328d?w=800&q=80', '60', '2026-04-13 19:08:30', '2026-04-19 07:23:31', 'Pertanian', '38', NULL);


-- Structure for table: statistik_penduduk
DROP TABLE IF EXISTS `statistik_penduduk`;
CREATE TABLE `statistik_penduduk` (
  `id` BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `tahun` INT(11),
  `jenis_data` TEXT,
  `label` TEXT,
  `nilai` INT(11),
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table: statistik_penduduk
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


-- Structure for table: apbdes
DROP TABLE IF EXISTS `apbdes`;
CREATE TABLE `apbdes` (
  `id` BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `tahun` INT(11),
  `jenis` TEXT,
  `bidang` TEXT,
  `nominal` INT(11),
  `dokumen_pdf` TEXT,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table: apbdes
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


-- Structure for table: berita
DROP TABLE IF EXISTS `berita`;
CREATE TABLE `berita` (
  `id` BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `judul` TEXT,
  `slug` TEXT,
  `konten` TEXT,
  `gambar` TEXT,
  `kategori` TEXT,
  `tanggal` TEXT,
  `penulis` TEXT,
  `status_publish` TEXT,
  `views` INT(11),
  `likes` INT(11),
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `dislikes` INT(11),
  `shares` INT(11)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table: berita
INSERT INTO `berita` (`id`, `judul`, `slug`, `konten`, `gambar`, `kategori`, `tanggal`, `penulis`, `status_publish`, `views`, `likes`, `created_at`, `updated_at`, `dislikes`, `shares`) VALUES ('1', 'Koperasi "Merah Putih" Desa Selorejo Suplai Jeruk Bantu Program Makan Bergizi Gratis Nasional', 'koperasi-selorejo-suplai-jeruk-makan-bergizi-gratis', '<p>Koperasi Desa Merah Putih Selorejo secara resmi menginisiasi kerja sama strategis sebagai penyuplai utama komoditas jeruk untuk Program Makan Bergizi Gratis (MBG) Nasional. Langkah ini diambil guna memastikan rantai pasok distribusi jeruk lokal langsung menjangkau pusat-pusat gizi di wilayah Malang Raya tanpa melalui perantara panjang.</p><p>Ketua Koperasi menyatakan bahwa sistem "direct-to-nutrition-center" ini tidak hanya menjamin kesegaran buah bagi masyarakat, tetapi juga memberikan harga beli yang jauh lebih adil bagi petani Selorejo. Proses penyortiran dan grading dilakukan secara ketat di gudang koperasi untuk memenuhi standar nutrisi dan kualitas yang ditetapkan pemerintah.</p>', 'https://images.unsplash.com/photo-1595246140625-573b715d11dc?w=800&q=80', 'Ekonomi & UMKM', '2026-02-15', 'Admin Desa', 'publish', '256', '48', NULL, '2026-04-19 07:23:31', '5', '46');
INSERT INTO `berita` (`id`, `judul`, `slug`, `konten`, `gambar`, `kategori`, `tanggal`, `penulis`, `status_publish`, `views`, `likes`, `created_at`, `updated_at`, `dislikes`, `shares`) VALUES ('2', 'Masterplan Destinasi Wisata 2024: Membangun Lahan Parkir Khusus Bus Pariwisata untuk Bedengan & Petik Jeruk', 'masterplan-lahan-parkir-bus-pariwisata-2024', '<p>Pemerintah Desa Selorejo mengesahkan masterplan destinasi wisata 2024 yang menitikberatkan pada pembangunan infrastruktur lahan parkir khusus bus pariwisata. Proyek ini bertujuan untuk mengatasi kemacetan di jalur menuju Bumi Perkemahan Bedengan dan lokasi Agrowisata Petik Jeruk yang sering kali padat pada akhir pekan.</p><p>Lahan parkir baru ini akan dilengkapi dengan fasilitas modern, termasuk paving blok berkualitas tinggi, sistem drainase yang baik, serta area istirahat bagi para kru bus. Dengan adanya fasilitas ini, diharapkan arus wisatawan masal dapat terkelola dengan lebih rapi, aman, dan memberikan kenyamanan ekstra bagi para pengunjung desa.</p>', 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=800&q=80', 'Pembangunan', '2024-11-20', 'Humas Pemdes', 'publish', '286', '25', NULL, '2026-04-19 07:23:31', '0', '16');
INSERT INTO `berita` (`id`, `judul`, `slug`, `konten`, `gambar`, `kategori`, `tanggal`, `penulis`, `status_publish`, `views`, `likes`, `created_at`, `updated_at`, `dislikes`, `shares`) VALUES ('3', 'Kampanye Beralih ke Pertanian Organik: Ciptakan Jeruk Bebas Residu Pestisida', 'kampanye-beralih-pertanian-organik-jeruk', '<p>Gerakan beralih ke pertanian organik semakin gencar dilakukan oleh kelompok tani di wilayah Desa Selorejo. Melalui pendampingan dari pakar agrikultur, para petani kini mulai meninggalkan pestisida kimia dan beralih menggunakan pupuk kompos serta pestisida nabati buatan sendiri untuk menjaga ekosistem lahan jeruk.</p><p>Hasilnya, buah Jeruk Keprok Batu 55 yang dihasilkan kini memiliki kualitas bebas residu kimia, membuatnya jauh lebih aman dikonsumsi langsung dari pohonnya. Kampanye ini juga bertujuan untuk menjaga kesuburan tanah Selorejo dalam jangka panjang agar dapat terus dinikmati oleh generasi mendatang sebagai warisan agrikultur yang berkelanjutan.</p>', 'https://images.unsplash.com/photo-1592982537447-6f296cb3adea?w=800&q=80', 'Kegiatan Desa', '2024-05-10', 'BUMDes Selorejo', 'publish', '397', '86', NULL, '2026-04-19 07:23:31', '3', '14');
INSERT INTO `berita` (`id`, `judul`, `slug`, `konten`, `gambar`, `kategori`, `tanggal`, `penulis`, `status_publish`, `views`, `likes`, `created_at`, `updated_at`, `dislikes`, `shares`) VALUES ('4', 'Musyawarah Perencanaan Desa: Menentukan Prioritas Pembangunan Tahun 2027', 'musyawarah-perencanaan-desa-selorejo-2027', '<p>Balai Desa Selorejo dipadati oleh perwakilan warga dari berbagai RW dalam agenda Musyawarah Perencanaan Pembangunan (Musrenbang) Desa untuk tahun anggaran 2027. Pertemuan ini menjadi wadah bagi masyarakat untuk menyampaikan aspirasi mengenai prioritas pembangunan fisik dan pemberdayaan ekonomi desa.</p><p>Beberapa usulan utama yang mengemuka antara lain perbaikan jalan usaha tani untuk mempermudah distribusi panen, serta optimalisasi sistem drainase di area permukiman guna mencegah genangan saat musim hujan. Keterlibatan aktif warga dalam musyawarah ini menjadi kunci transparansi dan efektivitas penggunaan Dana Desa ke depan.</p>', 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=800&q=80', 'Sosial', '2025-03-01', 'Sekretaris Desa', 'publish', '432', '97', NULL, '2026-04-19 07:23:31', '4', '42');
INSERT INTO `berita` (`id`, `judul`, `slug`, `konten`, `gambar`, `kategori`, `tanggal`, `penulis`, `status_publish`, `views`, `likes`, `created_at`, `updated_at`, `dislikes`, `shares`) VALUES ('5', 'Festival Jeruk Selorejo: Semarak Panen Raya di Lereng Kawi', 'festival-jeruk-selorejo-semarak-panen-raya', '<p>Kemeriahan menyelimuti Desa Selorejo dalam gelaran Festival Jeruk tahunan yang menjadi puncak acara "Bersih Desa". Ribuan warga dan wisatawan memenuhi jalanan untuk menyaksikan parade budaya yang menampilkan Gunungan Jeruk setinggi tiga meter sebagai simbol kemakmuran dan rasa syukur atas hasil panen yang melimpah.</p><p>Selain gunungan jeruk, festival ini juga menghadirkan Gunungan Opak dan beragam pertunjukan seni tradisional seperti Reog dan tari-tarian lokal. Tradisi berebut isi gunungan di akhir acara menjadi momen yang paling dinantikan, melambangkan kebersamaan dan berkah yang dibagikan secara merata kepada seluruh lapisan masyarakat desa.</p>', 'https://images.unsplash.com/photo-1558905623-bc97b76778f5?w=800&q=80', 'Pariwisata', '2024-08-15', 'Admin Desa', 'publish', '204', '90', NULL, '2026-04-19 07:23:31', '2', '33');
INSERT INTO `berita` (`id`, `judul`, `slug`, `konten`, `gambar`, `kategori`, `tanggal`, `penulis`, `status_publish`, `views`, `likes`, `created_at`, `updated_at`, `dislikes`, `shares`) VALUES ('6', 'Peningkatan Digitalisasi Desa: Akses Wi-Fi Gratis di Area Publik', 'peningkatan-digitalisasi-desa-selorejo-wifi-gratis', '<p>Dalam upaya mewujudkan visi "Smart Village", Pemerintah Desa Selorejo telah merampungkan pemasangan infrastruktur Wi-Fi gratis di titik-titik publik strategis. Fasilitas internet kecepatan tinggi ini kini dapat dinikmati warga di area Alun-alun, Balai Desa, dan pusat oleh-oleh guna mendukung produktivitas digital masyarakat desa.</p><p>Kehadiran internet gratis ini diharapkan dapat membantu para pelajar dalam mengakses materi pendidikan daring serta memudahkan pelaku UMKM desa dalam mempromosikan produk unggulannya melalui pasar digital. Digitalisasi ini merupakan langkah nyata desa untuk tetap relevan dan kompetitif di era informasi modern.</p>', 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?w=800&q=80', 'Pembangunan', '2025-01-10', 'Operator Desa', 'publish', '214', '70', NULL, '2026-04-19 07:23:31', '2', '34');
INSERT INTO `berita` (`id`, `judul`, `slug`, `konten`, `gambar`, `kategori`, `tanggal`, `penulis`, `status_publish`, `views`, `likes`, `created_at`, `updated_at`, `dislikes`, `shares`) VALUES ('7', 'Pelatihan UMKM Desa: Inovasi Pengemasan Produk Jeruk', 'pelatihan-umkm-desa-inovasi-pengemasan', '<p>Sejumlah pelaku UMKM lokal Selorejo mengikuti lokakarya intensif mengenai inovasi pengemasan dan branding produk turunan jeruk. Pelatihan yang diprakarsai oleh BUMDes ini bertujuan untuk meningkatkan nilai jual produk olahan seperti dari sirup, dodol, hingga keripik jeruk agar layak menembus pasar ritel modern di perkotaan.</p><p>Para peserta diajarkan teknik pengemasan fungsional yang dapat memperpanjang masa simpan produk tanpa bahan pengawet kimia, serta desain label yang lebih menarik secara visual. Dengan kemasan yang lebih profesional, produk-produk khas Selorejo diharapkan dapat bersaing dengan merek nasional dan meningkatkan pendapatan ekonomi keluarga petani.</p>', 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=800&q=80', 'Ekonomi & UMKM', '2024-12-05', 'BUMDes Selorejo', 'publish', '173', '96', NULL, '2026-04-19 07:23:31', '3', '48');
INSERT INTO `berita` (`id`, `judul`, `slug`, `konten`, `gambar`, `kategori`, `tanggal`, `penulis`, `status_publish`, `views`, `likes`, `created_at`, `updated_at`, `dislikes`, `shares`) VALUES ('8', 'Posyandu Terintegrasi: Menjamin Kesehatan Ibu dan Anak', 'posyandu-terintegrasi-kesehatan-ibu-anak', '<p>Layanan kesehatan di Desa Selorejo memasuki babak baru dengan pengoperasian Posyandu Integrasi Layanan Primer (ILP). Berbeda dengan posyandu konvensional, model ILP ini menawarkan pelayanan kesehatan yang mencakup seluruh siklus hidup, mulai dari balita, remaja, usia produktif, hingga lansia di satu lokasi terpadu.</p><p>Transformasi ini melibatkan penyediaan alat kesehatan antropometri standar serta tenaga kader yang telah terlatih untuk melakukan skrining kesehatan awal terhadap penyakit tidak menular. Dengan layanan yang lebih dekat dan terpadu, pemerintah desa berkomitmen untuk terus meningkatkan indeks kesehatan warga dan mendeteksi dini risiko gangguan kesehatan sejak tingkat akar rumput.</p>', 'https://images.unsplash.com/photo-1584362946045-12448ca55d91?w=800&q=80', 'Sosial', '2025-04-05', 'Admin Desa', 'publish', '71', '31', NULL, '2026-04-19 07:23:31', '0', '15');


-- Structure for table: polling
DROP TABLE IF EXISTS `polling`;
CREATE TABLE `polling` (
  `id` BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `pertanyaan` TEXT,
  `jumlah_ya` INT(11),
  `jumlah_tidak` INT(11),
  `tanggal_mulai` TEXT,
  `tanggal_selesai` TEXT,
  `is_active` TEXT,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table: polling
INSERT INTO `polling` (`id`, `pertanyaan`, `jumlah_ya`, `jumlah_tidak`, `tanggal_mulai`, `tanggal_selesai`, `is_active`, `created_at`, `updated_at`) VALUES ('1', 'Apakah Anda puas dengan pelayanan Pemerintah Desa Selorejo bulan ini?', '48', '8', '2026-04-01', '2026-04-30', '1', '2026-04-13 15:50:03', '2026-04-13 20:34:27');
INSERT INTO `polling` (`id`, `pertanyaan`, `jumlah_ya`, `jumlah_tidak`, `tanggal_mulai`, `tanggal_selesai`, `is_active`, `created_at`, `updated_at`) VALUES ('2', 'Apakah Anda setuju Jalan Desa saat ini sudah dalam kondisi baik?', '1', '0', '2026-04-13', '2026-04-20', '1', '2026-04-13 18:04:17', '2026-04-13 18:06:43');


-- Structure for table: kontak_messages
DROP TABLE IF EXISTS `kontak_messages`;
CREATE TABLE `kontak_messages` (
  `id` BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nama` TEXT,
  `email` TEXT,
  `pesan` LONGTEXT,
  `status_baca` TEXT,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table: kontak_messages
INSERT INTO `kontak_messages` (`id`, `nama`, `email`, `pesan`, `status_baca`, `created_at`, `updated_at`) VALUES ('1', 'Ridwan Hakim Mashadi', 'ridwanhm081204@gmail.com', 'Bagus Banget', 'sudah', '2026-04-13 17:51:41', '2026-04-13 17:51:50');


-- Structure for table: tautan_terkait
DROP TABLE IF EXISTS `tautan_terkait`;
CREATE TABLE `tautan_terkait` (
  `id` BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nama` TEXT,
  `url` TEXT,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table: tautan_terkait
INSERT INTO `tautan_terkait` (`id`, `nama`, `url`, `created_at`, `updated_at`) VALUES ('1', 'Pemerintah Kabupaten Malang', 'https://malangkab.go.id', NULL, NULL);
INSERT INTO `tautan_terkait` (`id`, `nama`, `url`, `created_at`, `updated_at`) VALUES ('2', 'Kementerian Desa PDTT', 'https://kemendesa.go.id', NULL, NULL);
INSERT INTO `tautan_terkait` (`id`, `nama`, `url`, `created_at`, `updated_at`) VALUES ('3', 'Sistem Informasi Desa', 'https://sid.kemendesa.go.id', NULL, NULL);
INSERT INTO `tautan_terkait` (`id`, `nama`, `url`, `created_at`, `updated_at`) VALUES ('4', 'Puskesmas Kec. Dau', 'https://puskesmasdau.malangkab.go.id', NULL, NULL);
INSERT INTO `tautan_terkait` (`id`, `nama`, `url`, `created_at`, `updated_at`) VALUES ('5', 'Kecamatan Dau', 'https://dau.malangkab.go.id', NULL, NULL);
INSERT INTO `tautan_terkait` (`id`, `nama`, `url`, `created_at`, `updated_at`) VALUES ('6', 'LAPOR! Kabupaten Malang', 'https://lapor.go.id', NULL, NULL);


-- Structure for table: widget_aparat
DROP TABLE IF EXISTS `widget_aparat`;
CREATE TABLE `widget_aparat` (
  `id` BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `foto_kades` TEXT,
  `nama_kades` TEXT,
  `sambutan` LONGTEXT,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table: widget_aparat
INSERT INTO `widget_aparat` (`id`, `foto_kades`, `nama_kades`, `sambutan`, `created_at`, `updated_at`) VALUES ('1', NULL, 'Bambang Soponyono', 'Selamat datang di website resmi Desa Selorejo. Kami berkomitmen untuk mewujudkan desa yang mandiri, transparan, dan berdaya saing melalui pemanfaatan teknologi digital. Kunjungi kebun jeruk keprok kami dan rasakan pengalaman agrowisata yang tak terlupakan.', '2026-04-13 15:50:03', '2026-04-13 15:50:03');


-- Structure for table: settings
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `key` TEXT,
  `value` LONGTEXT,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table: settings
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('1', 'nama_desa', 'Desa Selorejo', '2026-04-13 15:50:03', '2026-04-13 15:50:03');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('2', 'nama_pemerintah', 'Pemerintah Desa Selorejo', '2026-04-13 15:50:03', '2026-04-13 15:50:03');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('3', 'kecamatan', 'Kecamatan Dau', '2026-04-13 15:50:03', '2026-04-13 15:50:03');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('4', 'kabupaten', 'Kabupaten Malang', '2026-04-13 15:50:03', '2026-04-13 15:50:03');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('5', 'provinsi', 'Jawa Timur', '2026-04-13 15:50:03', '2026-04-13 15:50:03');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('6', 'alamat', 'Jl. Raya Selorejo No. 1, Desa Selorejo, Kec. Dau, Kab. Malang 65151', '2026-04-13 15:50:03', '2026-04-13 15:50:03');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('7', 'telepon', '0813.3163.5678', '2026-04-13 15:50:03', '2026-04-13 15:50:03');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('8', 'whatsapp', '0813.3163.5678', '2026-04-13 15:50:03', '2026-04-13 15:50:03');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('9', 'email', 'desawisataselorejo@gmail.com', '2026-04-13 15:50:03', '2026-04-13 15:50:03');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('10', 'jam_kerja', 'Senin-Jumat: 08.00-15.00 WIB', '2026-04-13 15:50:03', '2026-04-13 15:50:03');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('11', 'facebook', 'https://facebook.com/desaselorejo', '2026-04-13 15:50:03', '2026-04-13 15:50:03');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('12', 'instagram', 'https://instagram.com/desaselorejo', '2026-04-13 15:50:03', '2026-04-13 15:50:03');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('13', 'youtube', '', '2026-04-13 15:50:03', '2026-04-13 15:50:03');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('14', 'kode_pos', '65151', '2026-04-13 15:50:03', '2026-04-13 15:50:03');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('15', 'jumlah_penduduk', '3.640', '2026-04-13 15:50:03', '2026-04-13 15:50:03');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('16', 'jumlah_kk', '1.024', '2026-04-13 15:50:03', '2026-04-13 15:50:03');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('17', 'luas_wilayah', '623', '2026-04-13 15:50:03', '2026-04-13 15:50:03');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('18', 'jumlah_dusun', '3', '2026-04-13 15:50:03', '2026-04-13 15:50:03');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('19', 'hero_struktur', '{"title":"Struktur Organisasi","subtitle":"Jajaran Perangkat Desa Selorejo Periode Terkini","icon":"network"}', '2026-04-13 17:03:24', '2026-04-13 17:03:24');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('20', 'hero_bpd', '{"title":"Badan Permusyawaratan Desa","subtitle":"Lembaga legislatif desa sebagai mitra Pemerintah Desa.","icon":"users-2"}', '2026-04-13 17:03:24', '2026-04-13 17:03:24');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('21', 'hero_lembaga', '{"title":"Lembaga Desa","subtitle":"Lembaga Kemasyarakatan Pendukung Pembangunan Desa","icon":"building-2"}', '2026-04-13 17:03:24', '2026-04-13 17:03:24');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('22', 'hero_wisata', '{"title":"Destinasi Wisata Selorejo","subtitle":"Jelajahi keajaiban alam dan kearifan agrikultur di lereng pegunungan Malang.","icon":"mountain"}', '2026-04-13 17:26:14', '2026-04-13 17:26:14');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('23', 'hero_produk', '{"title":"Katalog Produk Desa","subtitle":"Mendukung karya lokal dan UMKM Desa Selorejo","icon":"shopping-bag"}', '2026-04-13 17:26:14', '2026-04-13 17:26:14');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('24', 'hero_statistik', '{"title":"Statistik Demografi Desa","subtitle":"Transparansi data penduduk Desa Wisata Selorejo berdasarkan angka riil kependudukan.","icon":"bar-chart-2"}', '2026-04-13 17:36:56', '2026-04-13 17:36:56');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('25', 'hero_apbdes', '{"title":"Transparansi APBDes","subtitle":"Laporan Anggaran Pendapatan dan Belanja Desa Selorejo Tahun Anggaran 2024.","icon":"file-text"}', '2026-04-13 17:36:56', '2026-04-13 17:36:56');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('26', 'hero_berita', '{"title":"Kabar Desa","subtitle":"Informasi, pengumuman, dan liputan terkini dari Desa Selorejo","icon":"newspaper"}', '2026-04-13 17:41:04', '2026-04-13 17:41:04');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('27', 'hero_galeri', '{"title":"Galeri Dokumentasi","subtitle":"Jendela visual potensi dan pesona alami Desa Selorejo","icon":"image"}', '2026-04-13 17:56:17', '2026-04-13 17:56:17');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('28', 'hero_kontak', '{"title":"Hubungi Kami","subtitle":"Kami siap melayani dan mendengarkan aspirasi Anda.","icon":"phone-call"}', '2026-04-13 17:56:17', '2026-04-13 17:56:17');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('29', 'hero_polling', '{"title":"Jejak Pendapat","subtitle":"Suara Anda sangat berarti bagi kemajuan desa kami.","icon":"pie-chart"}', '2026-04-13 18:02:45', '2026-04-13 18:02:45');
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES ('30', 'last_backup', '2026-04-13 18:36:41', '2026-04-13 18:36:41', '2026-04-13 18:36:41');


-- Structure for table: produk_transaksis
DROP TABLE IF EXISTS `produk_transaksis`;
CREATE TABLE `produk_transaksis` (
  `id` BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `produk_id` INT(11),
  `nama_pemesan` TEXT,
  `alamat` LONGTEXT,
  `kelurahan` TEXT,
  `kecamatan` TEXT,
  `kabupaten` TEXT,
  `kode_pos` TEXT,
  `metode_pembayaran` TEXT,
  `jumlah` INT(11),
  `total_harga` TEXT,
  `status` TEXT,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `telepon` TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table: produk_transaksis
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('1', '8', 'Pratama Arhan', 'Jl. Soekarno Hatta No. 12, Lowokwaru', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '5', '60000', 'pending', '2026-04-18 11:21:52', '2026-04-19 07:21:52', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('2', '3', 'Grace Natalie', 'Jl. Raya Dau No. 100, Selorejo', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '4', '80000', 'pending', '2026-04-16 20:21:52', '2026-04-19 07:21:52', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('3', '4', 'Maria Selena', 'Dusun Jetak Ngasri, Mulyoagung', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '4', '60000', 'pending', '2026-04-16 04:21:52', '2026-04-19 07:21:52', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('4', '9', 'Pratama Arhan', 'Perumahan Permata Jingga Blok C-15', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '3', '135000', 'pending', '2026-04-15 09:21:52', '2026-04-19 07:21:52', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('5', '9', 'Andiani Putri', 'Jl. Merdeka No. 45, Klojen', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '2', '90000', 'pending', '2026-04-18 19:21:52', '2026-04-19 07:21:52', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('6', '1', 'Andiani Putri', 'Jl. Soekarno Hatta No. 12, Lowokwaru', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '5', '175000', 'pending', '2026-04-16 21:21:52', '2026-04-19 07:21:52', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('7', '5', 'Kevin Sanjaya', 'Jl. Soekarno Hatta No. 12, Lowokwaru', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '1', '20000', 'pending', '2026-04-17 18:21:52', '2026-04-19 07:21:52', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('8', '8', 'Marselino Ferdinan', 'Dusun Jetak Ngasri, Mulyoagung', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '1', '12000', 'pending', '2026-04-16 15:21:52', '2026-04-19 07:21:52', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('9', '8', 'Kevin Sanjaya', 'Perumahan Permata Jingga Blok C-15', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '1', '12000', 'pending', '2026-04-13 10:21:52', '2026-04-19 07:21:52', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('10', '4', 'Pratama Arhan', 'Jl. Raya Dau No. 100, Selorejo', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '3', '45000', 'pending', '2026-04-15 02:21:52', '2026-04-19 07:21:52', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('11', '7', 'Asnawi Mangkualam', 'Jl. Merdeka No. 45, Klojen', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '5', '425000', 'pending', '2026-04-16 21:21:52', '2026-04-19 07:21:52', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('12', '3', 'Pratama Arhan', 'Perumahan Permata Jingga Blok C-15', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '2', '40000', 'pending', '2026-04-15 09:21:52', '2026-04-19 07:21:52', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('13', '3', 'Asnawi Mangkualam', 'Perumahan Permata Jingga Blok C-15', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '2', '40000', 'pending', '2026-04-16 10:21:52', '2026-04-19 07:21:52', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('14', '8', 'Grace Natalie', 'Dusun Jetak Ngasri, Mulyoagung', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '1', '12000', 'pending', '2026-04-17 21:21:52', '2026-04-19 07:21:52', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('15', '9', 'Maria Selena', 'Jl. Raya Dau No. 100, Selorejo', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '1', '45000', 'pending', '2026-04-13 10:21:52', '2026-04-19 07:21:52', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('16', '2', 'Rizky Ridho', 'Dusun Jetak Ngasri, Mulyoagung', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '4', '100000', 'pending', '2026-04-14 09:21:52', '2026-04-19 07:21:52', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('17', '8', 'Farhan Yudha', 'Perumahan Permata Jingga Blok C-15', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '1', '12000', 'pending', '2026-04-16 03:21:52', '2026-04-19 07:21:52', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('18', '4', 'Asnawi Mangkualam', 'Jl. Ijen No. 10, Gading Kasri', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '1', '15000', 'pending', '2026-04-16 12:21:52', '2026-04-19 07:21:52', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('19', '2', 'Farhan Yudha', 'Dusun Jetak Ngasri, Mulyoagung', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '4', '100000', 'pending', '2026-04-17 23:21:52', '2026-04-19 07:21:52', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('20', '4', 'Farhan Yudha', 'Perumahan Permata Jingga Blok C-15', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '3', '45000', 'pending', '2026-04-17 15:21:52', '2026-04-19 07:21:52', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('21', '7', 'Asnawi Mangkualam', 'Jl. Merdeka No. 45, Klojen', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '1', '85000', 'pending', '2026-04-13 07:22:11', '2026-04-19 07:22:11', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('22', '6', 'Marselino Ferdinan', 'Jl. Merdeka No. 45, Klojen', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '4', '540000', 'pending', '2026-04-13 22:22:11', '2026-04-19 07:22:11', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('23', '1', 'Pratama Arhan', 'Jl. Ijen No. 10, Gading Kasri', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '5', '175000', 'pending', '2026-04-15 15:22:11', '2026-04-19 07:22:11', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('24', '6', 'Rizky Ridho', 'Jl. Raya Dau No. 100, Selorejo', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '2', '270000', 'pending', '2026-04-14 20:22:11', '2026-04-19 07:22:11', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('25', '7', 'Marselino Ferdinan', 'Jl. Veteran No. 8, Penanggungan', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '1', '85000', 'pending', '2026-04-18 09:22:11', '2026-04-19 07:22:11', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('26', '1', 'Asnawi Mangkualam', 'Dusun Jetak Ngasri, Mulyoagung', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '4', '140000', 'pending', '2026-04-18 15:22:11', '2026-04-19 07:22:11', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('27', '1', 'Kevin Sanjaya', 'Perumahan Permata Jingga Blok C-15', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '3', '105000', 'pending', '2026-04-18 15:22:11', '2026-04-19 07:22:11', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('28', '5', 'Asnawi Mangkualam', 'Jl. Veteran No. 8, Penanggungan', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '2', '40000', 'pending', '2026-04-17 13:22:11', '2026-04-19 07:22:11', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('29', '4', 'Maria Selena', 'Dusun Jetak Ngasri, Mulyoagung', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '1', '15000', 'pending', '2026-04-17 04:22:11', '2026-04-19 07:22:11', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('30', '8', 'Marselino Ferdinan', 'Perumahan Permata Jingga Blok C-15', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '5', '60000', 'pending', '2026-04-17 13:22:11', '2026-04-19 07:22:11', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('31', '4', 'Maria Selena', 'Jl. Merdeka No. 45, Klojen', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '3', '45000', 'pending', '2026-04-15 16:22:11', '2026-04-19 07:22:11', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('32', '9', 'Kevin Sanjaya', 'Perumahan Permata Jingga Blok C-15', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '5', '225000', 'pending', '2026-04-14 07:22:11', '2026-04-19 07:22:11', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('33', '4', 'Grace Natalie', 'Jl. Merdeka No. 45, Klojen', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '1', '15000', 'pending', '2026-04-12 13:22:11', '2026-04-19 07:22:11', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('34', '5', 'Farhan Yudha', 'Perumahan Permata Jingga Blok C-15', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '3', '60000', 'pending', '2026-04-15 00:22:11', '2026-04-19 07:22:11', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('35', '3', 'Rizky Ridho', 'Jl. Raya Dau No. 100, Selorejo', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '2', '40000', 'pending', '2026-04-15 11:22:11', '2026-04-19 07:22:11', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('36', '6', 'Kevin Sanjaya', 'Jl. Ijen No. 10, Gading Kasri', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '2', '270000', 'pending', '2026-04-15 01:22:11', '2026-04-19 07:22:11', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('37', '5', 'Asnawi Mangkualam', 'Jl. Raya Dau No. 100, Selorejo', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '3', '60000', 'pending', '2026-04-18 13:22:11', '2026-04-19 07:22:11', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('38', '8', 'Kevin Sanjaya', 'Dusun Jetak Ngasri, Mulyoagung', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '5', '60000', 'pending', '2026-04-18 00:22:11', '2026-04-19 07:22:11', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('39', '7', 'Asnawi Mangkualam', 'Jl. Raya Dau No. 100, Selorejo', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '2', '170000', 'pending', '2026-04-12 10:22:11', '2026-04-19 07:22:11', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('40', '6', 'Farhan Yudha', 'Jl. Raya Dau No. 100, Selorejo', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '3', '405000', 'pending', '2026-04-15 06:22:11', '2026-04-19 07:22:11', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('41', '3', 'Marselino Ferdinan', 'Perumahan Permata Jingga Blok C-15', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '4', '80000', 'pending', '2026-04-15 02:23:32', '2026-04-19 07:23:32', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('42', '4', 'Asnawi Mangkualam', 'Jl. Ijen No. 10, Gading Kasri', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '4', '60000', 'pending', '2026-04-14 04:23:32', '2026-04-19 07:23:32', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('43', '1', 'Marselino Ferdinan', 'Jl. Veteran No. 8, Penanggungan', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '4', '140000', 'pending', '2026-04-14 14:23:32', '2026-04-19 07:23:32', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('44', '3', 'Farhan Yudha', 'Jl. Soekarno Hatta No. 12, Lowokwaru', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '2', '40000', 'pending', '2026-04-13 17:23:32', '2026-04-19 07:23:32', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('45', '5', 'Maria Selena', 'Dusun Jetak Ngasri, Mulyoagung', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '3', '60000', 'pending', '2026-04-17 04:23:32', '2026-04-19 07:23:32', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('46', '2', 'Marselino Ferdinan', 'Jl. Soekarno Hatta No. 12, Lowokwaru', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '2', '50000', 'pending', '2026-04-16 03:23:32', '2026-04-19 07:23:32', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('47', '7', 'Rizky Ridho', 'Dusun Jetak Ngasri, Mulyoagung', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '4', '340000', 'pending', '2026-04-19 04:23:32', '2026-04-19 07:23:32', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('48', '2', 'Rizky Ridho', 'Perumahan Permata Jingga Blok C-15', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '2', '50000', 'pending', '2026-04-18 06:23:32', '2026-04-19 07:23:32', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('49', '2', 'Andiani Putri', 'Perumahan Permata Jingga Blok C-15', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '4', '100000', 'pending', '2026-04-16 23:23:32', '2026-04-19 07:23:32', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('50', '3', 'Farhan Yudha', 'Jl. Veteran No. 8, Penanggungan', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '3', '60000', 'pending', '2026-04-17 09:23:32', '2026-04-19 07:23:32', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('51', '3', 'Andiani Putri', 'Jl. Soekarno Hatta No. 12, Lowokwaru', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '1', '20000', 'pending', '2026-04-18 10:23:32', '2026-04-19 07:23:32', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('52', '8', 'Grace Natalie', 'Dusun Jetak Ngasri, Mulyoagung', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '1', '12000', 'pending', '2026-04-13 08:23:32', '2026-04-19 07:23:32', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('53', '7', 'Marselino Ferdinan', 'Dusun Jetak Ngasri, Mulyoagung', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '2', '170000', 'pending', '2026-04-15 21:23:32', '2026-04-19 07:23:32', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('54', '8', 'Farhan Yudha', 'Jl. Soekarno Hatta No. 12, Lowokwaru', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '1', '12000', 'pending', '2026-04-19 01:23:32', '2026-04-19 07:23:32', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('55', '1', 'Marselino Ferdinan', 'Jl. Veteran No. 8, Penanggungan', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '2', '70000', 'pending', '2026-04-13 16:23:32', '2026-04-19 07:23:32', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('56', '9', 'Farhan Yudha', 'Jl. Soekarno Hatta No. 12, Lowokwaru', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '5', '225000', 'pending', '2026-04-16 00:23:32', '2026-04-19 07:23:32', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('57', '7', 'Maria Selena', 'Perumahan Permata Jingga Blok C-15', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '1', '85000', 'pending', '2026-04-19 05:23:32', '2026-04-19 07:23:32', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('58', '8', 'Grace Natalie', 'Jl. Veteran No. 8, Penanggungan', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '4', '48000', 'pending', '2026-04-13 14:23:32', '2026-04-19 07:23:32', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('59', '5', 'Pratama Arhan', 'Jl. Ijen No. 10, Gading Kasri', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '4', '80000', 'pending', '2026-04-15 09:23:32', '2026-04-19 07:23:32', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('60', '6', 'Andiani Putri', 'Jl. Veteran No. 8, Penanggungan', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '2', '270000', 'pending', '2026-04-19 00:23:32', '2026-04-19 07:23:32', NULL);
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('61', '8', 'Grace Natalie', 'Jl. Veteran No. 8, Penanggungan', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '3', '36000', 'Pesanan Masuk', '2026-04-13 03:32:37', '2026-04-19 07:32:37', '08223300715');
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('62', '4', 'Pratama Arhan', 'Jl. Merdeka No. 45, Klojen', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '2', '30000', 'Sedang Dipacking', '2026-04-13 09:32:37', '2026-04-19 07:32:37', '08637618106');
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('63', '1', 'Maria Selena', 'Jl. Merdeka No. 45, Klojen', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '3', '105000', 'Sudah Sampai Tujuan', '2026-04-14 16:32:37', '2026-04-19 07:32:37', '08261280102');
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('64', '9', 'Rizky Ridho', 'Dusun Jetak Ngasri, Mulyoagung', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '2', '90000', 'Sedang Dipacking', '2026-04-16 15:32:37', '2026-04-19 07:32:37', '08682141764');
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('65', '8', 'Rizky Ridho', 'Perumahan Permata Jingga Blok C-15', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '4', '48000', 'Pesanan Masuk', '2026-04-17 09:32:37', '2026-04-19 07:32:37', '08347840855');
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('66', '4', 'Maria Selena', 'Jl. Raya Dau No. 100, Selorejo', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '2', '30000', 'Sedang Dipacking', '2026-04-19 03:32:37', '2026-04-19 07:32:37', '08982293681');
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('67', '6', 'Asnawi Mangkualam', 'Perumahan Permata Jingga Blok C-15', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '3', '405000', 'Sudah Sampai Tujuan', '2026-04-17 15:32:37', '2026-04-19 07:32:37', '08697866925');
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('68', '7', 'Pratama Arhan', 'Jl. Raya Dau No. 100, Selorejo', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '4', '340000', 'Sudah Sampai Tujuan', '2026-04-18 07:32:37', '2026-04-19 07:32:37', '08122095440');
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('69', '5', 'Marselino Ferdinan', 'Jl. Ijen No. 10, Gading Kasri', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '1', '20000', 'Dalam Perjalanan', '2026-04-15 15:32:37', '2026-04-19 07:32:37', '08109535009');
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('70', '2', 'Grace Natalie', 'Jl. Merdeka No. 45, Klojen', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '4', '100000', 'Sudah Sampai Tujuan', '2026-04-15 07:32:37', '2026-04-19 07:32:37', '08299408207');
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('71', '9', 'Marselino Ferdinan', 'Jl. Soekarno Hatta No. 12, Lowokwaru', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '2', '90000', 'Sedang Dipacking', '2026-04-18 15:32:37', '2026-04-19 07:32:37', '08795149854');
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('72', '8', 'Farhan Yudha', 'Jl. Ijen No. 10, Gading Kasri', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '1', '12000', 'Sudah Sampai Tujuan', '2026-04-12 16:32:37', '2026-04-19 07:32:37', '08956228667');
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('73', '8', 'Maria Selena', 'Dusun Jetak Ngasri, Mulyoagung', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '1', '12000', 'Sedang Dipacking', '2026-04-14 04:32:37', '2026-04-19 07:32:37', '08935820943');
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('74', '1', 'Pratama Arhan', 'Jl. Merdeka No. 45, Klojen', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '2', '70000', 'Dalam Perjalanan', '2026-04-13 07:32:37', '2026-04-19 07:32:37', '08916465742');
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('75', '6', 'Maria Selena', 'Jl. Soekarno Hatta No. 12, Lowokwaru', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '1', '135000', 'Pesanan Masuk', '2026-04-13 05:32:37', '2026-04-19 07:32:37', '08499778977');
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('76', '7', 'Pratama Arhan', 'Perumahan Permata Jingga Blok C-15', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '4', '340000', 'Pesanan Masuk', '2026-04-16 09:32:37', '2026-04-19 07:32:37', '08528405733');
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('77', '5', 'Asnawi Mangkualam', 'Perumahan Permata Jingga Blok C-15', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '3', '60000', 'Dalam Perjalanan', '2026-04-15 13:32:37', '2026-04-19 07:32:37', '08219498273');
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('78', '5', 'Grace Natalie', 'Jl. Veteran No. 8, Penanggungan', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '4', '80000', 'Sudah Sampai Tujuan', '2026-04-15 12:32:37', '2026-04-19 07:32:37', '08565064072');
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('79', '8', 'Maria Selena', 'Jl. Veteran No. 8, Penanggungan', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '5', '60000', 'Sedang Dipacking', '2026-04-18 08:32:37', '2026-04-19 07:32:37', '08379116032');
INSERT INTO `produk_transaksis` (`id`, `produk_id`, `nama_pemesan`, `alamat`, `kelurahan`, `kecamatan`, `kabupaten`, `kode_pos`, `metode_pembayaran`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `telepon`) VALUES ('80', '6', 'Pratama Arhan', 'Dusun Jetak Ngasri, Mulyoagung', 'Selorejo', 'Dau', 'Malang', '65151', 'WhatsApp Checkout', '1', '135000', 'Dalam Perjalanan', '2026-04-12 19:32:37', '2026-04-19 07:32:37', '08823471985');


-- Structure for table: produk_reviews
DROP TABLE IF EXISTS `produk_reviews`;
CREATE TABLE `produk_reviews` (
  `id` BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `produk_id` INT(11),
  `nama_lengkap` TEXT,
  `email` TEXT,
  `rating` INT(11),
  `saran` LONGTEXT,
  `kritik` LONGTEXT,
  `foto_produk` TEXT,
  `is_featured` TEXT,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table: produk_reviews
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('1', '1', 'Dewi Lestari', 'dewi.lestari@example.com', '5', 'Packing sangat rapi, tidak ada jeruk yang busuk.', 'Tingkatkan terus kualitasnya.', NULL, '0', '2026-04-06 07:22:10', '2026-04-19 07:22:10');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('2', '1', 'Linda Wijaya', 'linda.wijaya@example.com', '5', 'Sari jeruknya enak banget buat anak-anak.', 'Botolnya agak susah dibuka.', NULL, '0', '2026-04-16 07:22:10', '2026-04-19 07:22:10');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('3', '1', 'Eko Prasetyo', 'eko.prasetyo@example.com', '3', 'Cukup oke, tapi ukurannya tidak seragam.', 'Ada beberapa yang agak masam.', NULL, '0', '2026-04-09 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('4', '1', 'Dewi Lestari', 'dewi.lestari@example.com', '5', 'Packing sangat rapi, tidak ada jeruk yang busuk.', 'Tingkatkan terus kualitasnya.', NULL, '0', '2026-04-07 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('5', '1', 'Linda Wijaya', 'linda.wijaya@example.com', '5', 'Sari jeruknya enak banget buat anak-anak.', 'Botolnya agak susah dibuka.', NULL, '0', '2026-03-26 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('6', '2', 'Hendra Kusuma', 'hendra.kusuma@example.com', '4', 'Pengiriman cepat sampai ke Surabaya.', 'Warna jeruknya ada yang kusam.', NULL, '0', '2026-04-03 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('7', '2', 'Siti Aminah', 'siti.aminah@example.com', '4', 'Kualitas UMKM yang membanggakan.', 'Ongkir ke Jakarta lumayan mahal.', NULL, '0', '2026-04-03 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('8', '2', 'Rian Hidayat', 'rian.hidayat@example.com', '5', 'Langganan beli di sini buat oleh-oleh.', 'Stok sering habis saat musim liburan.', NULL, '0', '2026-03-22 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('9', '2', 'Dewi Lestari', 'dewi.lestari@example.com', '5', 'Packing sangat rapi, tidak ada jeruk yang busuk.', 'Tingkatkan terus kualitasnya.', NULL, '0', '2026-04-06 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('10', '3', 'Siti Aminah', 'siti.aminah@example.com', '4', 'Kualitas UMKM yang membanggakan.', 'Ongkir ke Jakarta lumayan mahal.', NULL, '0', '2026-03-30 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('11', '3', 'Linda Wijaya', 'linda.wijaya@example.com', '5', 'Sari jeruknya enak banget buat anak-anak.', 'Botolnya agak susah dibuka.', NULL, '0', '2026-03-29 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('12', '4', 'Siti Aminah', 'siti.aminah@example.com', '4', 'Kualitas UMKM yang membanggakan.', 'Ongkir ke Jakarta lumayan mahal.', NULL, '0', '2026-03-20 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('13', '4', 'Hendra Kusuma', 'hendra.kusuma@example.com', '4', 'Pengiriman cepat sampai ke Surabaya.', 'Warna jeruknya ada yang kusam.', NULL, '0', '2026-03-24 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('14', '4', 'Linda Wijaya', 'linda.wijaya@example.com', '5', 'Sari jeruknya enak banget buat anak-anak.', 'Botolnya agak susah dibuka.', NULL, '0', '2026-04-08 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('15', '4', 'Dewi Lestari', 'dewi.lestari@example.com', '5', 'Packing sangat rapi, tidak ada jeruk yang busuk.', 'Tingkatkan terus kualitasnya.', NULL, '0', '2026-03-23 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('16', '5', 'Linda Wijaya', 'linda.wijaya@example.com', '5', 'Sari jeruknya enak banget buat anak-anak.', 'Botolnya agak susah dibuka.', NULL, '0', '2026-04-12 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('17', '5', 'Hendra Kusuma', 'hendra.kusuma@example.com', '4', 'Pengiriman cepat sampai ke Surabaya.', 'Warna jeruknya ada yang kusam.', NULL, '0', '2026-04-10 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('18', '5', 'Budi Santoso', 'budi.santoso@example.com', '5', 'Jeruknya sangat segar dan manis!', 'Pengemasan bisa dipercepat.', NULL, '0', '2026-04-07 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('19', '5', 'Siti Aminah', 'siti.aminah@example.com', '4', 'Kualitas UMKM yang membanggakan.', 'Ongkir ke Jakarta lumayan mahal.', NULL, '0', '2026-03-20 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('20', '6', 'Budi Santoso', 'budi.santoso@example.com', '5', 'Jeruknya sangat segar dan manis!', 'Pengemasan bisa dipercepat.', NULL, '0', '2026-04-06 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('21', '6', 'Siti Aminah', 'siti.aminah@example.com', '4', 'Kualitas UMKM yang membanggakan.', 'Ongkir ke Jakarta lumayan mahal.', NULL, '0', '2026-04-10 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('22', '6', 'Hendra Kusuma', 'hendra.kusuma@example.com', '4', 'Pengiriman cepat sampai ke Surabaya.', 'Warna jeruknya ada yang kusam.', NULL, '0', '2026-03-24 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('23', '7', 'Budi Santoso', 'budi.santoso@example.com', '5', 'Jeruknya sangat segar dan manis!', 'Pengemasan bisa dipercepat.', NULL, '0', '2026-04-06 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('24', '7', 'Linda Wijaya', 'linda.wijaya@example.com', '5', 'Sari jeruknya enak banget buat anak-anak.', 'Botolnya agak susah dibuka.', NULL, '0', '2026-04-12 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('25', '7', 'Siti Aminah', 'siti.aminah@example.com', '4', 'Kualitas UMKM yang membanggakan.', 'Ongkir ke Jakarta lumayan mahal.', NULL, '0', '2026-03-25 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('26', '8', 'Dewi Lestari', 'dewi.lestari@example.com', '5', 'Packing sangat rapi, tidak ada jeruk yang busuk.', 'Tingkatkan terus kualitasnya.', NULL, '0', '2026-04-11 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('27', '8', 'Rian Hidayat', 'rian.hidayat@example.com', '5', 'Langganan beli di sini buat oleh-oleh.', 'Stok sering habis saat musim liburan.', NULL, '0', '2026-04-12 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('28', '9', 'Linda Wijaya', 'linda.wijaya@example.com', '5', 'Sari jeruknya enak banget buat anak-anak.', 'Botolnya agak susah dibuka.', NULL, '0', '2026-03-27 07:23:31', '2026-04-19 07:23:31');
INSERT INTO `produk_reviews` (`id`, `produk_id`, `nama_lengkap`, `email`, `rating`, `saran`, `kritik`, `foto_produk`, `is_featured`, `created_at`, `updated_at`) VALUES ('29', '9', 'Rian Hidayat', 'rian.hidayat@example.com', '5', 'Langganan beli di sini buat oleh-oleh.', 'Stok sering habis saat musim liburan.', NULL, '0', '2026-04-09 07:23:31', '2026-04-19 07:23:31');


SET FOREIGN_KEY_CHECKS = 1;
