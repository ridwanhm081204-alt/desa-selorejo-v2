<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder {
    public function run() {
        Produk::truncate();
        $data = [
            ['nama'=>'Kopi Arabika Lereng Kawi (200gr)','deskripsi'=>'Biji kopi arabika pilihan dari perkebunan kopi Selorejo di lereng Gunung Kawi. Diproses secara natural (natural process) menghasilkan aroma fruity dan tingkat asam yang menyegarkan.', 'harga'=>35000,'stok'=>'Tersedia', 'gambar' => 'https://images.unsplash.com/photo-1559525839-b184a4d698c7?w=800&q=80'],
            ['nama'=>'Jeruk Keprok Batu 55 (1 Kg)','deskripsi'=>'Jeruk maskot Kecamatan Dau. Kulit mudah dikupas, rasa dominan manis segar, dan ukurannya besar. Ciri khas panen pertanian organik Desa Selorejo.', 'harga'=>25000,'stok'=>'Tersedia', 'gambar' => 'https://images.unsplash.com/photo-1543328225-b4ee54e173bd?w=800&q=80'],
            ['nama'=>'Jeruk Baby Java (1 Kg)','deskripsi'=>'Jeruk istimewa kesukaan anak-anak karena tidak memiliki rasa asam sama sekali (100% manis). Sangat cocok untuk diperas.', 'harga'=>20000,'stok'=>'Tersedia', 'gambar' => 'https://images.unsplash.com/photo-1550258987-190a2d41a8ba?w=800&q=80'],
            ['nama'=>'Keripik Mbote/Talas BUMDes','deskripsi'=>'Cemilan kerupuk tradisional berbahan dasar Talas pegunungan hasil olahan PKK Desa Selorejo. Sangat renyah dan gurih alami tanpa MSG.', 'harga'=>15000,'stok'=>'Tersedia', 'gambar' => 'https://images.unsplash.com/photo-1558296767-fbbc060fdb3c?w=800&q=80'],
            ['nama'=>'Jamu Instan Temulawak & Jahe','deskripsi'=>'Minuman serbuk herbal produksi KWT (Kelompok Wanita Tani) Selorejo. Berkhasiat menjaga imun dan menghangatkan tubuh dengan rasa manis alami aren.', 'harga'=>20000,'stok'=>'Tersedia', 'gambar' => 'https://images.unsplash.com/photo-1599321427976-5d63f034ee51?w=800&q=80'],
            ['nama'=>'Jeruk Keprok Keranjang Gift','deskripsi'=>'Paket oleh-oleh eksklusif berisi 5kg jeruk keprok pilihan. Dikemas dalam keranjang bambu tradisional yang cantik dan ramah lingkungan.', 'harga'=>135000,'stok'=>'Tersedia', 'gambar' => 'https://images.unsplash.com/photo-1557844352-761f2565b576?w=800&q=80'],
            ['nama'=>'Madu Murni Bunga Jeruk','deskripsi'=>'Madu asli hasil budidaya lebah di sekitar perkebunan jeruk Desa Selorejo. Memiliki aroma floral yang unik dan rasa manis yang lembut.', 'harga'=>85000,'stok'=>'Tersedia', 'gambar' => 'https://images.unsplash.com/photo-1587049352846-4a222e784d38?w=800&q=80'],
            ['nama'=>'Sari Jeruk Selorejo Botolan','deskripsi'=>'100% perasan jeruk asli tanpa pemanis buatan dan pengawet. Diproses secara higienis untuk menjaga kesegaran dan nutrisi vitamin C.', 'harga'=>12000,'stok'=>'Tersedia', 'gambar' => 'https://images.unsplash.com/photo-1613478223719-2ab802602423?w=800&q=80'],
            ['nama'=>'Pupuk Organik Cair Desa','deskripsi'=>'Pupuk ramah lingkungan hasil olahan limbah pertanian desa. Terbukti efektif meningkatkan kualitas buah jeruk dan menjaga kesuburan tanah.', 'harga'=>45000,'stok'=>'Tersedia', 'gambar' => 'https://images.unsplash.com/photo-1585314062340-f1a5a7c9328d?w=800&q=80']
        ];
        Produk::insert($data);
    }
}
