<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder {
    public function run() {
        Produk::truncate();
        $data = [
            [
                'nama' => 'Kopi Arabika Lereng Kawi (200gr)',
                'kategori' => 'Minuman',
                'deskripsi' => 'Biji kopi Arabika Selorejo dipanen dari ketinggian 1.200 mdpl di lereng Gunung Kawi, menghasilkan profil rasa yang kompleks dengan dominasi fruity notes seperti apel hijau dan blackberry. Diproses secara natural untuk menjaga karakteristik keasaman yang segar dan tubuh (body) yang sedang, kopi ini menjadi pilihan utama bagi para pecinta kopi specialty yang mencari citarasa autentik pegunungan Malang.',
                'harga' => 35000,
                'stok' => 100,
                'gambar' => 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?w=800&q=80'
            ],
            [
                'nama' => 'Jeruk Keprok Batu 55 (1 Kg)',
                'kategori' => 'Jeruk Segar',
                'deskripsi' => 'Sebagai ikon agrowisata Selorejo, Jeruk Keprok Batu 55 menawarkan perpaduan sempurna antara rasa manis yang kuat dengan sentuhan sensasi asam segar. Buahnya memiliki kulit yang cukup tebal berwarna kuning jingga yang menarik dan mudah dikupas, serta daging buah yang kenyal dan kaya sari buah. Jeruk ini ditanam dengan praktik pertanian ramah lingkungan untuk memastikan setiap gigitannya aman dan menyehatkan bagi keluarga.',
                'harga' => 25000,
                'stok' => 150,
                'gambar' => 'https://images.unsplash.com/photo-1557844352-761f2565b576?w=800&q=80'
            ],
            [
                'nama' => 'Jeruk Baby Java (1 Kg)',
                'kategori' => 'Jeruk Segar',
                'deskripsi' => 'Jeruk Baby Java Selorejo dikenal sebagai jeruk paling bersahabat bagi pencernaan si kecil berkat kadar asamnya yang sangat rendah namun memiliki tingkat kemanisan alami yang tinggi. Kaya akan Vitamin C dan antioksidan, jeruk ini menjadi favorit untuk dijadikan air perasan bagi bayi (MPASI) maupun sebagai sumber hidrasi harian yang menyegarkan. Tekstur kulitnya yang halus dan daging buahnya yang lembut memberikan kualitas sari buah maksimal di setiap perasannya.',
                'harga' => 20000,
                'stok' => 120,
                'gambar' => 'https://images.unsplash.com/photo-1544145945-f904253d0c71?w=800&q=80'
            ],
            [
                'nama' => 'Keripik Mbote/Talas BUMDes',
                'kategori' => 'Makanan',
                'deskripsi' => 'Keripik Mbote adalah camilan warisan leluhur Desa Selorejo yang dibuat dari Umbi Talas (Mbote) pilihan hasil bumi lereng Kawi. Diolah secara higienis oleh kelompok ibu-ibu PKK desa, umbi talas diiris tipis secara presisi dan direndam dalam bumbu rempah rahasia sebelum digoreng hingga mencapai tingkat kerenyahan maksimal. Tanpa bahan pengawet dan MSG, keripik ini menawarkan rasa gurih autentik yang sulit dilupakan.',
                'harga' => 15000,
                'stok' => 80,
                'gambar' => 'https://images.unsplash.com/photo-1599599810769-bcde5a160d32?w=800&q=80'
            ],
            [
                'nama' => 'Jamu Instan Temulawak & Jahe',
                'kategori' => 'Minuman',
                'deskripsi' => 'Produk unggulan dari Kelompok Wanita Tani (KWT) Selorejo ini menghadirkan kepraktisan minuman kesehatan tradisional dalam bentuk serbuk instan yang mudah diseduh. Campuran Temulawak, Jahe Merah, dan Gula Aren pilihan diolah secara tradisional namun tetap menjaga standar kebersihan untuk memberikan manfaat maksimal bagi daya tahan tubuh dan kehangatan sistem pencernaan. Cocok dinikmati setiap pagi sebagai pendamping gaya hidup sehat Anda.',
                'harga' => 20000,
                'stok' => 90,
                'gambar' => 'https://images.unsplash.com/photo-1599321427976-5d63f034ee51?w=800&q=80'
            ],
            [
                'nama' => 'Jeruk Keprok Keranjang Gift',
                'kategori' => 'Olahan Buah',
                'deskripsi' => 'Hadirkan kehangatan khas Desa Selorejo melalui paket hadiah eksklusif Jeruk Keprok Keranjang. Berisi 5kg jeruk pilihan kualitas super yang dikemas dalam keranjang bambu tradisional (besek) yang ramah lingkungan dan estetik. Pilihan tepat sebagai oleh-oleh premium atau hantaran spesial bagi kerabat dan kolega, mencerminkan ketulusan hasil bumi langsung dari tangan petani lokal kami.',
                'harga' => 135000,
                'stok' => 40,
                'gambar' => 'https://images.unsplash.com/photo-1543328225-b4ee54e173bd?w=800&q=80'
            ],
            [
                'nama' => 'Madu Murni Bunga Jeruk',
                'kategori' => 'Makanan',
                'deskripsi' => 'Madu Bunga Jeruk Selorejo merupakan jenis madu monofloral langka yang dihasilkan oleh lebah penghisap nektar bunga pohon jeruk yang mekar secara serempak. Memiliki aroma flora yang harum dengan sentuhan rasa yang ringan dan sedikit citrusy, madu ini kaya akan flavonoid dan enzim aktif yang baik untuk kesehatan lambung dan imunitas. Teksturnya yang jernih dan kemampuannya mengkristal dengan halus menjadi segel keaslian madu murni tanpa campuran.',
                'harga' => 85000,
                'stok' => 50,
                'gambar' => 'https://images.unsplash.com/photo-1587049352846-4a222e784d38?w=800&q=80'
            ],
            [
                'nama' => 'Sari Jeruk Selorejo Botolan',
                'kategori' => 'Minuman',
                'deskripsi' => 'Nikmati kesegaran murni 100% buah jeruk Selorejo dalam setiap botolnya tanpa tambahan pemanis buatan maupun pengawet. Menggunakan teknologi pengolahan suhu rendah untuk menjaga kandungan vitamin dan nutrisi alami tetap utuh, sari jeruk ini menawarkan rasa manis-segar yang konsisten. Praktis untuk dibawa beraktivitas dan menjadi solusi harian bagi Anda yang membutuhkan asupan Vitamin C instan di tengah kesibukan.',
                'harga' => 12000,
                'stok' => 200,
                'gambar' => 'https://images.unsplash.com/photo-1613478223719-2ab802602423?w=800&q=80'
            ],
            [
                'nama' => 'Pupuk Organik Cair Desa',
                'kategori' => 'Pertanian',
                'deskripsi' => 'Rahasia kesuburan agrowisata kami kini tersedia untuk kebun Anda sendiri. Pupuk Organik Cair (POC) Desa Selorejo diolah dari limbah pertanian dan mikroorganisme lokal (MOL) yang terbukti ampuh meningkatkan kualitas pembungaan dan pembuahan tanaman jeruk. Selain ramah lingkungan, pupuk ini membantu memperbaiki pori-pori tanah dan menyediakan nutrisi esensial bagi tanaman agar tumbuh lebih kuat, tahan penyakit, dan berbuah lebat secara alami.',
                'harga' => 45000,
                'stok' => 60,
                'gambar' => 'https://images.unsplash.com/photo-1585314062340-f1a5a7c9328d?w=800&q=80'
            ]
        ];
        foreach ($data as $item) {
            Produk::create($item);
        }
    }
}
