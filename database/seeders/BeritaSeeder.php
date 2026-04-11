<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Berita;

class BeritaSeeder extends Seeder {
    public function run() {
        Berita::truncate();
        $berita = [
            [
                'judul' => 'Koperasi "Merah Putih" Desa Selorejo Suplai Jeruk Bantu Program Makan Bergizi Gratis Nasional',
                'slug' => 'koperasi-selorejo-suplai-jeruk-makan-bergizi-gratis',
                'konten' => '<p>Koperasi Desa Merah Putih Selorejo secara resmi menginisiasi kerja sama strategis sebagai penyuplai utama komoditas jeruk untuk Program Makan Bergizi Gratis (MBG) Nasional. Langkah ini diambil guna memastikan rantai pasok distribusi jeruk lokal langsung menjangkau pusat-pusat gizi di wilayah Malang Raya tanpa melalui perantara panjang.</p><p>Ketua Koperasi menyatakan bahwa sistem "direct-to-nutrition-center" ini tidak hanya menjamin kesegaran buah bagi masyarakat, tetapi juga memberikan harga beli yang jauh lebih adil bagi petani Selorejo. Proses penyortiran dan grading dilakukan secara ketat di gudang koperasi untuk memenuhi standar nutrisi dan kualitas yang ditetapkan pemerintah.</p>',
                'kategori' => 'Kabar Desa',
                'tanggal' => '2026-02-15',
                'penulis' => 'Admin Desa',
                'gambar' => 'https://images.unsplash.com/photo-1595246140625-573b715d11dc?w=800&q=80',
                'status_publish' => 'publish'
            ],
            [
                'judul' => 'Masterplan Destinasi Wisata 2024: Membangun Lahan Parkir Khusus Bus Pariwisata untuk Bedengan & Petik Jeruk',
                'slug' => 'masterplan-lahan-parkir-bus-pariwisata-2024',
                'konten' => '<p>Pemerintah Desa Selorejo mengesahkan masterplan destinasi wisata 2024 yang menitikberatkan pada pembangunan infrastruktur lahan parkir khusus bus pariwisata. Proyek ini bertujuan untuk mengatasi kemacetan di jalur menuju Bumi Perkemahan Bedengan dan lokasi Agrowisata Petik Jeruk yang sering kali padat pada akhir pekan.</p><p>Lahan parkir baru ini akan dilengkapi dengan fasilitas modern, termasuk paving blok berkualitas tinggi, sistem drainase yang baik, serta area istirahat bagi para kru bus. Dengan adanya fasilitas ini, diharapkan arus wisatawan masal dapat terkelola dengan lebih rapi, aman, dan memberikan kenyamanan ekstra bagi para pengunjung desa.</p>',
                'kategori' => 'Kabar Desa',
                'tanggal' => '2024-11-20',
                'penulis' => 'Humas Pemdes',
                'gambar' => 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=800&q=80',
                'status_publish' => 'publish'
            ],
            [
                'judul' => 'Kampanye Beralih ke Pertanian Organik: Ciptakan Jeruk Bebas Residu Pestisida',
                'slug' => 'kampanye-beralih-pertanian-organik-jeruk',
                'konten' => '<p>Gerakan beralih ke pertanian organik semakin gencar dilakukan oleh kelompok tani di wilayah Desa Selorejo. Melalui pendampingan dari pakar agrikultur, para petani kini mulai meninggalkan pestisida kimia dan beralih menggunakan pupuk kompos serta pestisida nabati buatan sendiri untuk menjaga ekosistem lahan jeruk.</p><p>Hasilnya, buah Jeruk Keprok Batu 55 yang dihasilkan kini memiliki kualitas bebas residu kimia, membuatnya jauh lebih aman dikonsumsi langsung dari pohonnya. Kampanye ini juga bertujuan untuk menjaga kesuburan tanah Selorejo dalam jangka panjang agar dapat terus dinikmati oleh generasi mendatang sebagai warisan agrikultur yang berkelanjutan.</p>',
                'kategori' => 'Kabar Desa',
                'tanggal' => '2024-05-10',
                'penulis' => 'BUMDes Selorejo',
                'gambar' => 'https://images.unsplash.com/photo-1592982537447-6f296cb3adea?w=800&q=80',
                'status_publish' => 'publish'
            ],
            [
                'judul' => 'Musyawarah Perencanaan Desa: Menentukan Prioritas Pembangunan Tahun 2027',
                'slug' => 'musyawarah-perencanaan-desa-selorejo-2027',
                'konten' => '<p>Balai Desa Selorejo dipadati oleh perwakilan warga dari berbagai RW dalam agenda Musyawarah Perencanaan Pembangunan (Musrenbang) Desa untuk tahun anggaran 2027. Pertemuan ini menjadi wadah bagi masyarakat untuk menyampaikan aspirasi mengenai prioritas pembangunan fisik dan pemberdayaan ekonomi desa.</p><p>Beberapa usulan utama yang mengemuka antara lain perbaikan jalan usaha tani untuk mempermudah distribusi panen, serta optimalisasi sistem drainase di area permukiman guna mencegah genangan saat musim hujan. Keterlibatan aktif warga dalam musyawarah ini menjadi kunci transparansi dan efektivitas penggunaan Dana Desa ke depan.</p>',
                'kategori' => 'Kabar Desa',
                'tanggal' => '2025-03-01',
                'penulis' => 'Sekretaris Desa',
                'gambar' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=800&q=80',
                'status_publish' => 'publish'
            ],
            [
                'judul' => 'Festival Jeruk Selorejo: Semarak Panen Raya di Lereng Kawi',
                'slug' => 'festival-jeruk-selorejo-semarak-panen-raya',
                'konten' => '<p>Kemeriahan menyelimuti Desa Selorejo dalam gelaran Festival Jeruk tahunan yang menjadi puncak acara "Bersih Desa". Ribuan warga dan wisatawan memenuhi jalanan untuk menyaksikan parade budaya yang menampilkan Gunungan Jeruk setinggi tiga meter sebagai simbol kemakmuran dan rasa syukur atas hasil panen yang melimpah.</p><p>Selain gunungan jeruk, festival ini juga menghadirkan Gunungan Opak dan beragam pertunjukan seni tradisional seperti Reog dan tari-tarian lokal. Tradisi berebut isi gunungan di akhir acara menjadi momen yang paling dinantikan, melambangkan kebersamaan dan berkah yang dibagikan secara merata kepada seluruh lapisan masyarakat desa.</p>',
                'kategori' => 'Kabar Desa',
                'tanggal' => '2024-08-15',
                'penulis' => 'Admin Desa',
                'gambar' => 'https://images.unsplash.com/photo-1558905623-bc97b76778f5?w=800&q=80',
                'status_publish' => 'publish'
            ],
            [
                'judul' => 'Peningkatan Digitalisasi Desa: Akses Wi-Fi Gratis di Area Publik',
                'slug' => 'peningkatan-digitalisasi-desa-selorejo-wifi-gratis',
                'konten' => '<p>Dalam upaya mewujudkan visi "Smart Village", Pemerintah Desa Selorejo telah merampungkan pemasangan infrastruktur Wi-Fi gratis di titik-titik publik strategis. Fasilitas internet kecepatan tinggi ini kini dapat dinikmati warga di area Alun-alun, Balai Desa, dan pusat oleh-oleh guna mendukung produktivitas digital masyarakat desa.</p><p>Kehadiran internet gratis ini diharapkan dapat membantu para pelajar dalam mengakses materi pendidikan daring serta memudahkan pelaku UMKM desa dalam mempromosikan produk unggulannya melalui pasar digital. Digitalisasi ini merupakan langkah nyata desa untuk tetap relevan dan kompetitif di era informasi modern.</p>',
                'kategori' => 'Kabar Desa',
                'tanggal' => '2025-01-10',
                'penulis' => 'Operator Desa',
                'gambar' => 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?w=800&q=80',
                'status_publish' => 'publish'
            ],
            [
                'judul' => 'Pelatihan UMKM Desa: Inovasi Pengemasan Produk Jeruk',
                'slug' => 'pelatihan-umkm-desa-inovasi-pengemasan',
                'konten' => '<p>Sejumlah pelaku UMKM lokal Selorejo mengikuti lokakarya intensif mengenai inovasi pengemasan dan branding produk turunan jeruk. Pelatihan yang diprakarsai oleh BUMDes ini bertujuan untuk meningkatkan nilai jual produk olahan seperti dari sirup, dodol, hingga keripik jeruk agar layak menembus pasar ritel modern di perkotaan.</p><p>Para peserta diajarkan teknik pengemasan fungsional yang dapat memperpanjang masa simpan produk tanpa bahan pengawet kimia, serta desain label yang lebih menarik secara visual. Dengan kemasan yang lebih profesional, produk-produk khas Selorejo diharapkan dapat bersaing dengan merek nasional dan meningkatkan pendapatan ekonomi keluarga petani.</p>',
                'kategori' => 'Kabar Desa',
                'tanggal' => '2024-12-05',
                'penulis' => 'BUMDes Selorejo',
                'gambar' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=800&q=80',
                'status_publish' => 'publish'
            ],
            [
                'judul' => 'Posyandu Terintegrasi: Menjamin Kesehatan Ibu dan Anak',
                'slug' => 'posyandu-terintegrasi-kesehatan-ibu-anak',
                'konten' => '<p>Layanan kesehatan di Desa Selorejo memasuki babak baru dengan pengoperasian Posyandu Integrasi Layanan Primer (ILP). Berbeda dengan posyandu konvensional, model ILP ini menawarkan pelayanan kesehatan yang mencakup seluruh siklus hidup, mulai dari balita, remaja, usia produktif, hingga lansia di satu lokasi terpadu.</p><p>Transformasi ini melibatkan penyediaan alat kesehatan antropometri standar serta tenaga kader yang telah terlatih untuk melakukan skrining kesehatan awal terhadap penyakit tidak menular. Dengan layanan yang lebih dekat dan terpadu, pemerintah desa berkomitmen untuk terus meningkatkan indeks kesehatan warga dan mendeteksi dini risiko gangguan kesehatan sejak tingkat akar rumput.</p>',
                'kategori' => 'Kabar Desa',
                'tanggal' => '2025-04-05',
                'penulis' => 'Admin Desa',
                'gambar' => 'https://images.unsplash.com/photo-1584362946045-12448ca55d91?w=800&q=80',
                'status_publish' => 'publish'
            ]
        ];
        Berita::insert($berita);
    }
}
