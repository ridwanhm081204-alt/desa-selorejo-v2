<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PetaTitik;
use App\Models\Umkm;
use App\Models\Wisata;

class PetaTitikSeeder extends Seeder
{
    public function run(): void
    {
        PetaTitik::truncate();

        // ── 1. 7 Destinasi Wisata Unggulan (Peta B) ──────────────────────────────────
        $destinasiWisata = [
            [
                'nama'              => 'Bumi Perkemahan Bedengan',
                'dusun'             => 'gumuk',
                'kategori'          => 'camping_ground',
                'deskripsi'         => 'Area bumi perkemahan dengan nuansa hutan pinus yang asri. Terletak di bagian barat Desa Selorejo, dekat perbatasan Desa Petungsewu. Cocok untuk kegiatan berkemah, outbound, dan wisata alam.',
                'sumber_data'       => 'Observasi Lapangan 2026',
                'is_wisata_unggulan'=> true,
                'urutan_tampil'     => 1,
                'wisata_keyword'    => 'Bedengan',
                'umkm_keyword'      => null,
            ],
            [
                'nama'              => 'Hovsky 360 View',
                'dusun'             => 'selokerto',
                'kategori'          => 'cafe',
                'deskripsi'         => 'Cafe bertingkat dengan pemandangan 360 derajat Desa Selokerto dan sekitarnya. Buka malam hari dengan pencahayaan yang menarik, menjadi spot foto favorit wisatawan.',
                'sumber_data'       => 'Observasi Lapangan 2026',
                'is_wisata_unggulan'=> true,
                'urutan_tampil'     => 2,
                'wisata_keyword'    => null,
                'umkm_keyword'      => 'Hovsky',
            ],
            [
                'nama'              => 'Wisata Agro Petik Jeruk',
                'dusun'             => 'krajan',
                'kategori'          => 'toko_buah_wisata_jeruk',
                'deskripsi'         => 'Wisata agro petik jeruk unggulan di Desa Selorejo, berlokasi dekat Gapura Desa. Pengunjung dapat langsung memetik jeruk segar dari pohon dan membeli hasil panen sebagai oleh-oleh.',
                'sumber_data'       => 'Observasi Lapangan 2026',
                'is_wisata_unggulan'=> true,
                'urutan_tampil'     => 3,
                'wisata_keyword'    => 'Agrowisata Petik Jeruk',
                'umkm_keyword'      => 'Wisata Agro Petik Jeruk',
            ],
            [
                'nama'              => 'Wisata Petik Jeruk Adila',
                'dusun'             => 'gumuk',
                'kategori'          => 'toko_buah_wisata_jeruk',
                'deskripsi'         => 'Kebun petik jeruk dengan brand "Adila" di Dusun Gumuk. Menawarkan pengalaman memetik jeruk langsung dari pohon dengan kemasan produk yang menarik.',
                'sumber_data'       => 'Observasi Lapangan 2026',
                'is_wisata_unggulan'=> true,
                'urutan_tampil'     => 4,
                'wisata_keyword'    => null,
                'umkm_keyword'      => 'Adila',
            ],
            [
                'nama'              => 'Wisata Petik Jeruk Haji Umin',
                'dusun'             => 'krajan',
                'kategori'          => 'toko_buah_wisata_jeruk',
                'deskripsi'         => 'Wisata petik jeruk milik Haji Umin di Dusun Krajan. Salah satu kebun jeruk tertua dan terpercaya di Desa Selorejo dengan hasil panen berkualitas tinggi.',
                'sumber_data'       => 'Observasi Lapangan 2026',
                'is_wisata_unggulan'=> true,
                'urutan_tampil'     => 5,
                'wisata_keyword'    => null,
                'umkm_keyword'      => 'Haji Umin',
            ],
            [
                'nama'              => 'Wisata Petik Jeruk Pak Muji',
                'dusun'             => 'krajan',
                'kategori'          => 'toko_buah_wisata_jeruk',
                'deskripsi'         => 'Kebun wisata petik jeruk Pak Muji berlokasi di Dusun Krajan. Pengunjung dapat menikmati suasana kebun jeruk yang rindang sambil memetik jeruk segar.',
                'sumber_data'       => 'Observasi Lapangan 2026',
                'is_wisata_unggulan'=> true,
                'urutan_tampil'     => 6,
                'wisata_keyword'    => null,
                'umkm_keyword'      => 'Pak Muji',
            ],
            [
                'nama'              => 'Wisata Petik Jeruk Pak Suwaji',
                'dusun'             => 'krajan',
                'kategori'          => 'toko_buah_wisata_jeruk',
                'deskripsi'         => 'Wisata petik jeruk Pak Suwaji berlokasi di Dusun Krajan dekat perbatasan Desa Gadingkulon. Memiliki gapura/gerbang masuk yang ikonik dan akses jalan yang mudah.',
                'sumber_data'       => 'Observasi Lapangan 2026',
                'is_wisata_unggulan'=> true,
                'urutan_tampil'     => 7,
                'wisata_keyword'    => null,
                'umkm_keyword'      => 'Suwaji',
            ],
        ];

        $countFeatured = 0;
        foreach ($destinasiWisata as $item) {
            $umkmKeyword = $item['umkm_keyword'];
            $wisataKeyword = $item['wisata_keyword'];
            unset($item['umkm_keyword'], $item['wisata_keyword']);

            $umkmId = null;
            if ($umkmKeyword) {
                $umkm = Umkm::where('nama_usaha', 'like', "%{$umkmKeyword}%")
                            ->orWhere('nama_pemilik', 'like', "%{$umkmKeyword}%")
                            ->first();
                $umkmId = $umkm?->id;
            }

            $wisataId = null;
            if ($wisataKeyword) {
                $w = Wisata::where('judul', 'like', "%{$wisataKeyword}%")->first();
                $wisataId = $w?->id;
            }

            $item['umkm_id'] = $umkmId;
            $item['wisata_id'] = $wisataId;
            PetaTitik::create($item);
            $countFeatured++;
        }

        // ── 2. Import Semua Entri UMKM (100+ entri) ke PetaTitik ─────────────────
        $allUmkms = Umkm::all();
        $countUmkm = 0;

        foreach ($allUmkms as $u) {
            // Cek apakah UMKM ini sudah dikaitkan dengan PetaTitik yang dibuat di atas
            $existing = PetaTitik::where('umkm_id', $u->id)->first();
            if ($existing) continue;

            // Map kategori UMKM ke kategori PetaTitik
            $kategoriSlug = match ($u->kategori) {
                'Wisata & Kios Petik Jeruk', 'Jual Jeruk & Bibit', 'Toko Buah & Sayur', 'Dagang Buah Lain' => 'toko_buah_wisata_jeruk',
                'Warung Makan', 'Kuliner Ringan & Jajanan' => 'warung_makan',
                'Toko Kelontong & Sembako', 'Sembako & Hewan/Perabot' => 'toko_kelontong_sembako',
                'Toko Obat Tanaman & Pupuk', 'Fashion & Kebutuhan Rumah Tangga', 'Frozen Food' => 'toko_berbagai_jenis',
                'Jasa & Persewaan' => 'bengkel',
                default => 'toko_kelontong_sembako',
            };

            $lowerNama = strtolower($u->nama_usaha);
            if (str_contains($lowerNama, 'cafe') || str_contains($lowerNama, 'kafe') || str_contains($lowerNama, 'coffee') || str_contains($lowerNama, 'kopi')) {
                $kategoriSlug = 'cafe';
            } elseif (str_contains($lowerNama, 'bengkel') || str_contains($lowerNama, 'servis') || str_contains($lowerNama, 'tambal ban')) {
                $kategoriSlug = 'bengkel';
            }

            $dusunSlug = strtolower($u->dusun ?: 'krajan');
            if (!in_array($dusunSlug, ['krajan', 'selokerto', 'gumuk'])) {
                $dusunSlug = 'krajan';
            }

            PetaTitik::create([
                'nama'              => $u->nama_usaha,
                'kategori'          => $kategoriSlug,
                'dusun'             => $dusunSlug,
                'deskripsi'         => $u->deskripsi ?: "Usaha {$u->jenis_usaha} di Dusun " . ucfirst($dusunSlug) . ", Desa Selorejo. Pemilik: {$u->nama_pemilik}.",
                'foto'              => $u->foto,
                'latitude'          => $u->latitude,
                'longitude'         => $u->longitude,
                'is_wisata_unggulan'=> false,
                'sumber_data'       => 'Pendataan & Pemetaan UMKM Desa 2026',
                'urutan_tampil'     => 50,
                'umkm_id'           => $u->id,
                'wisata_id'         => null,
            ]);
            $countUmkm++;
        }

                // ── 3. Seed 23 Tempat Penting & Keagamaan / Fasilitas Publik (Daftar 2026) ───
        $fasilitasPublik = [
            [
                'nama'        => 'Kantor Kepala Desa Selorejo',
                'kategori'    => 'fasilitas_desa',
                'dusun'       => 'krajan',
                'deskripsi'   => 'Pusat pelayanan administrasi dan pemerintahan Desa Selorejo, Kecamatan Dau, Kabupaten Malang.',
                'gmaps_link'  => 'https://maps.app.goo.gl/wJk5h3Gq',
                'sumber_data' => 'Pemerintah Desa Selorejo',
            ],
            [
                'nama'        => 'Musholla Nurul Iman Krajan',
                'kategori'    => 'mushola_masjid',
                'dusun'       => 'krajan',
                'deskripsi'   => 'Musholla Nurul Iman berlokasi di Dusun Krajan, Desa Selorejo. Tempat peribadatan dan kegiatan keagamaan warga.',
                'foto'        => 'images/tempat_penting/(Krajan) Musholla Nurul Iman.jpg',
                'gmaps_link'  => 'https://maps.app.goo.gl/KnD4x3XsbWZSgCeq8',
                'sumber_data' => 'Pendataan Tempat Penting 2026',
            ],
            [
                'nama'        => 'Musholla Miftahul Huda Krajan',
                'kategori'    => 'mushola_masjid',
                'dusun'       => 'krajan',
                'deskripsi'   => 'Musholla Miftahul Huda berlokasi di Dusun Krajan, Desa Selorejo.',
                'gmaps_link'  => 'https://maps.app.goo.gl/282b8aTAKTfM77sbA',
                'sumber_data' => 'Pendataan Tempat Penting 2026',
            ],
            [
                'nama'        => 'Musholla An Nur Krajan',
                'kategori'    => 'mushola_masjid',
                'dusun'       => 'krajan',
                'deskripsi'   => 'Musholla An Nur berlokasi di Dusun Krajan, Desa Selorejo.',
                'foto'        => 'images/tempat_penting/(Krajan) Musholla An Nur.jpg',
                'gmaps_link'  => 'https://maps.app.goo.gl/9rR5RpjuQUfA2qWKA',
                'sumber_data' => 'Pendataan Tempat Penting 2026',
            ],
            [
                'nama'        => "Musholla Hidayatul Mu'minin Krajan",
                'kategori'    => 'mushola_masjid',
                'dusun'       => 'krajan',
                'deskripsi'   => "Musholla Hidayatul Mu'minin berlokasi di Dusun Krajan, Desa Selorejo.",
                'gmaps_link'  => 'https://maps.app.goo.gl/3zCUya9mPgsdKFHT6',
                'sumber_data' => 'Pendataan Tempat Penting 2026',
            ],
            [
                'nama'        => 'Masjid Miftakhul Jannah Krajan',
                'kategori'    => 'mushola_masjid',
                'dusun'       => 'krajan',
                'deskripsi'   => 'Masjid Miftakhul Jannah berlokasi di Dusun Krajan, Desa Selorejo. Masjid jami warga untuk kegiatan shalat berjamaah dan Peringatan Hari Besar Islam.',
                'gmaps_link'  => 'https://maps.app.goo.gl/uEf3zbSauo8LTf2D9?g_st=aw',
                'sumber_data' => 'Pendataan Tempat Penting 2026',
            ],
            [
                'nama'        => 'Mushola Al Hidayah Krajan',
                'kategori'    => 'mushola_masjid',
                'dusun'       => 'krajan',
                'deskripsi'   => 'Mushola Al Hidayah berlokasi di Dusun Krajan, Desa Selorejo.',
                'foto'        => 'images/tempat_penting/(Krajan) Mushola Al Hidayah.jpg',
                'gmaps_link'  => 'https://maps.app.goo.gl/BAox91YYaezYjkrDA?g_st=i',
                'sumber_data' => 'Pendataan Tempat Penting 2026',
            ],
            [
                'nama'        => 'Mushola Nurul Huda Krajan',
                'kategori'    => 'mushola_masjid',
                'dusun'       => 'krajan',
                'deskripsi'   => 'Mushola Nurul Huda berlokasi di Dusun Krajan, Desa Selorejo.',
                'gmaps_link'  => 'https://maps.app.goo.gl/vrYVQNdeseH6bvF9A?g_st=ic',
                'sumber_data' => 'Pendataan Tempat Penting 2026',
            ],
            [
                'nama'        => 'Musholla Nur Hidayah Krajan',
                'kategori'    => 'mushola_masjid',
                'dusun'       => 'krajan',
                'deskripsi'   => 'Musholla Nur Hidayah berlokasi di Dusun Krajan, Desa Selorejo.',
                'foto'        => 'images/tempat_penting/(Krajan) Musholla Nur Hidayah.jpg',
                'gmaps_link'  => 'https://maps.app.goo.gl/ENxD9nZkmbKYzHxd6?g_st=ic',
                'sumber_data' => 'Pendataan Tempat Penting 2026',
            ],
            [
                'nama'        => 'Musholla Baiturrahman Krajan',
                'kategori'    => 'mushola_masjid',
                'dusun'       => 'krajan',
                'deskripsi'   => 'Musholla Baiturrahman berlokasi di Dusun Krajan, Desa Selorejo.',
                'foto'        => 'images/tempat_penting/(Krajan) Musholla Baiturrahman.jpg',
                'gmaps_link'  => 'https://maps.app.goo.gl/nwvA5qpqJ6CS9oSf9?g_st=ic',
                'sumber_data' => 'Pendataan Tempat Penting 2026',
            ],
            [
                'nama'        => 'Musholla Miftahul Jannah Krajan',
                'kategori'    => 'mushola_masjid',
                'dusun'       => 'krajan',
                'deskripsi'   => 'Musholla Miftahul Jannah berlokasi di Dusun Krajan, Desa Selorejo.',
                'gmaps_link'  => 'https://maps.app.goo.gl/J8oiraBLJhpTQiSk7?g_st=ic',
                'sumber_data' => 'Pendataan Tempat Penting 2026',
            ],
            [
                'nama'        => 'GKJW Jemaat Sengkaling Pepanthan Selorejo',
                'kategori'    => 'gereja',
                'dusun'       => 'krajan',
                'deskripsi'   => 'Gereja Kristen Jawi Wetan (GKJW) Jemaat Sengkaling Pepanthan Selorejo di Dusun Krajan. Tempat ibadah dan pembinaan iman jemaat Kristen setempat.',
                'foto'        => 'images/tempat_penting/(Krajan) Gereja Kristen Jawi Wetan.jpg',
                'gmaps_link'  => 'https://maps.app.goo.gl/DLVqp1y11KVEQYq67?g_st=ic',
                'sumber_data' => 'Pendataan Tempat Penting 2026',
            ],
            [
                'nama'        => 'Musholla Darul Muttaqin Krajan',
                'kategori'    => 'mushola_masjid',
                'dusun'       => 'krajan',
                'deskripsi'   => 'Musholla Darul Muttaqin berlokasi di Dusun Krajan, Desa Selorejo.',
                'foto'        => 'images/tempat_penting/(Krajan) Musholla Darrul Muttaqin.PNG',
                'gmaps_link'  => 'https://maps.app.goo.gl/wifRh81hyQmqZBGC8?g_st=ic',
                'sumber_data' => 'Pendataan Tempat Penting 2026',
            ],
            [
                'nama'        => 'Masjid Darussalam Gumuk',
                'kategori'    => 'mushola_masjid',
                'dusun'       => 'gumuk',
                'deskripsi'   => 'Masjid Darussalam Gumuk berlokasi di Dusun Gumuk, Desa Selorejo. Pusat peribadatan utama umat Islam di kawasan Dusun Gumuk.',
                'foto'        => 'images/tempat_penting/(Gumuk) Masjid Darussalam Gumuk.jpg',
                'gmaps_link'  => 'https://maps.app.goo.gl/v7AFkVr9XPqyyaej8?g_st=ic',
                'sumber_data' => 'Pendataan Tempat Penting 2026',
            ],
            [
                'nama'        => 'GPdI Agape Gumuk Dau',
                'kategori'    => 'gereja',
                'dusun'       => 'gumuk',
                'deskripsi'   => 'Gereja Pantekosta di Indonesia (GPdI) Agape Gumuk Dau di Dusun Gumuk, Desa Selorejo. Tempat ibadah jemaat Pantekosta.',
                'foto'        => 'images/tempat_penting/(Gumuk) Gereja Pantekosta di Indonesia (agape).jpeg',
                'gmaps_link'  => 'https://maps.app.goo.gl/VXssCFNJXZ3gtbwV9?g_st=ic',
                'sumber_data' => 'Pendataan Tempat Penting 2026',
            ],
            [
                'nama'        => 'Gubuk Marhaen & Pelinggih Sanggah Hindu',
                'kategori'    => 'fasilitas_desa',
                'dusun'       => 'gumuk',
                'deskripsi'   => 'Gubuk Marhaen & Pelinggih Sanggah Hindu di Dusun Gumuk, Desa Selorejo. Tempat peribadatan Hindu dan ruang sosial kebudayaan.',
                'foto'        => 'images/tempat_penting/(Gumuk) Gubuk Marhaen.jpg',
                'gmaps_link'  => 'https://maps.app.goo.gl/bkQzBosUJy9ekwHw8?g_st=ic',
                'sumber_data' => 'Pendataan Tempat Penting 2026',
            ],
            [
                'nama'        => 'Musholla Pondok Raudah Selokerto',
                'kategori'    => 'mushola_masjid',
                'dusun'       => 'selokerto',
                'deskripsi'   => 'Musholla Pondok Raudah berlokasi di Dusun Selokerto, Desa Selorejo.',
                'foto'        => 'images/tempat_penting/(Selokerto) Musholla Pondok Raudah.jpg',
                'gmaps_link'  => 'https://maps.app.goo.gl/BWcd9QS423KQnT6s7?g_st=ic',
                'sumber_data' => 'Pendataan Tempat Penting 2026',
            ],
            [
                'nama'        => 'Musholla Baiturrahman Selokerto',
                'kategori'    => 'mushola_masjid',
                'dusun'       => 'selokerto',
                'deskripsi'   => 'Musholla Baiturrahman berlokasi di Dusun Selokerto, Desa Selorejo.',
                'foto'        => 'images/tempat_penting/(Selokerto) Musholla Baiturrahman.jpg',
                'gmaps_link'  => 'https://maps.app.goo.gl/2XCjVUMmkCtvqsAM6?g_st=ic',
                'sumber_data' => 'Pendataan Tempat Penting 2026',
            ],
            [
                'nama'        => 'Mushola RA Sholikhin Selokerto',
                'kategori'    => 'mushola_masjid',
                'dusun'       => 'selokerto',
                'deskripsi'   => 'Mushola RA Sholikhin berlokasi di Dusun Selokerto, Desa Selorejo.',
                'foto'        => 'images/tempat_penting/(Selokerto) Mushola RA Sholikhin.jpg',
                'gmaps_link'  => 'https://maps.app.goo.gl/dUW7Cyau8vVCREjM9?g_st=ic',
                'sumber_data' => 'Pendataan Tempat Penting 2026',
            ],
            [
                'nama'        => "Masjid Baitul Ma'mur Selokerto",
                'kategori'    => 'mushola_masjid',
                'dusun'       => 'selokerto',
                'deskripsi'   => "Masjid Baitul Ma'mur berlokasi di Dusun Selokerto, Desa Selorejo. Pusat shalat jumat dan ibadah umat Islam setempat.",
                'foto'        => 'images/tempat_penting/(Selokerto) Masjid Baitul Ma’mur.jpg',
                'gmaps_link'  => 'https://maps.app.goo.gl/7HfWdkmL3gynDbjS7?g_st=ic',
                'sumber_data' => 'Pendataan Tempat Penting 2026',
            ],
            [
                'nama'        => 'Poskesdes / Klinik Kesehatan Desa Selorejo',
                'kategori'    => 'klinik',
                'dusun'       => 'selokerto',
                'deskripsi'   => 'Fasilitas kesehatan pertolongan pertama dan pos pelayanan kesehatan desa untuk warga Desa Selorejo.',
                'gmaps_link'  => 'https://maps.app.goo.gl/fCYp3rSVLKPdrtER9?g_st=ac',
                'sumber_data' => 'Pemerintah Desa Selorejo',
            ],
            [
                'nama'        => 'Masjid Miftakhul Huda Selokerto',
                'kategori'    => 'mushola_masjid',
                'dusun'       => 'selokerto',
                'deskripsi'   => 'Masjid Miftakhul Huda berlokasi di Dusun Selokerto, Desa Selorejo.',
                'foto'        => 'images/tempat_penting/(Selokerto) Masjid Miftakhul Huda_20260729_120244.jpg',
                'gmaps_link'  => 'https://maps.app.goo.gl/cQsxmKjVb5GDRZ7f7?g_st=ac',
                'sumber_data' => 'Pendataan Tempat Penting 2026',
            ],
            [
                'nama'        => 'Masjid Riyadlul Jannah Selokerto',
                'kategori'    => 'mushola_masjid',
                'dusun'       => 'selokerto',
                'deskripsi'   => 'Masjid Riyadlul Jannah berlokasi di Dusun Selokerto, Desa Selorejo.',
                'foto'        => 'images/tempat_penting/(Selokerto) Masjid Riyadlul Jannah_20260729_154421.jpg',
                'gmaps_link'  => 'https://maps.app.goo.gl/dUW7Cyau8vVCREjM9?g_st=ic',
                'sumber_data' => 'Pendataan Tempat Penting 2026',
            ],
            [
                'nama'        => 'Air Terjun Brues',
                'kategori'    => 'camping_ground',
                'dusun'       => 'gumuk',
                'deskripsi'   => 'Wisata alam air terjun alami dengan suasana segar dan pemandangan lembah pegunungan di Desa Selorejo.',
                'sumber_data' => 'Observasi Lapangan 2026',
                'wisata_keyword' => 'Air Terjun Brues',
            ],
            [
                'nama'        => 'Adventure Trail & Sirkuit ATV Selorejo',
                'kategori'    => 'camping_ground',
                'dusun'       => 'selokerto',
                'deskripsi'   => 'Sirkuit petualangan trail dan persewaan ATV menyusuri perkebunan jeruk dan bukit Desa Selorejo.',
                'sumber_data' => 'Observasi Lapangan 2026',
                'wisata_keyword' => 'Adventure Trail',
            ],
        ];

        $countFasilitas = 0;
        foreach ($fasilitasPublik as $fp) {
            $wisataKeyword = $fp['wisata_keyword'] ?? null;
            unset($fp['wisata_keyword']);

            $existing = PetaTitik::where('nama', $fp['nama'])->first();
            if ($existing) continue;

            $wisataId = null;
            if ($wisataKeyword) {
                $w = Wisata::where('judul', 'like', "%{$wisataKeyword}%")->first();
                $wisataId = $w?->id;
            }

            $fp['wisata_id'] = $wisataId;
            $fp['urutan_tampil'] = 20;
            PetaTitik::create($fp);
            $countFasilitas++;
        }

        $totalAll = PetaTitik::count();
        $this->command->info("✓ Success Seeding PetaTitik: {$countFeatured} destinasi unggulan, {$countUmkm} entri UMKM terhubung, {$countFasilitas} fasilitas publik. Total: {$totalAll} titik.");
    }
}
