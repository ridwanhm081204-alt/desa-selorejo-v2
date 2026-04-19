<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;
use App\Models\ProdukReview;

class ProdukReviewSeeder extends Seeder
{
    public function run(): void
    {
        $produks = Produk::all();
        if ($produks->isEmpty()) return;

        $reviews = [
            ['nama' => 'Budi Santoso', 'stars' => 5, 'saran' => 'Jeruknya sangat segar dan manis!', 'kritik' => 'Pengemasan bisa dipercepat.'],
            ['nama' => 'Siti Aminah', 'stars' => 4, 'saran' => 'Kualitas UMKM yang membanggakan.', 'kritik' => 'Ongkir ke Jakarta lumayan mahal.'],
            ['nama' => 'Rian Hidayat', 'stars' => 5, 'saran' => 'Langganan beli di sini buat oleh-oleh.', 'kritik' => 'Stok sering habis saat musim liburan.'],
            ['nama' => 'Dewi Lestari', 'stars' => 5, 'saran' => 'Packing sangat rapi, tidak ada jeruk yang busuk.', 'kritik' => 'Tingkatkan terus kualitasnya.'],
            ['nama' => 'Eko Prasetyo', 'stars' => 3, 'saran' => 'Cukup oke, tapi ukurannya tidak seragam.', 'kritik' => 'Ada beberapa yang agak masam.'],
            ['nama' => 'Linda Wijaya', 'stars' => 5, 'saran' => 'Sari jeruknya enak banget buat anak-anak.', 'kritik' => 'Botolnya agak susah dibuka.'],
            ['nama' => 'Hendra Kusuma', 'stars' => 4, 'saran' => 'Pengiriman cepat sampai ke Surabaya.', 'kritik' => 'Warna jeruknya ada yang kusam.'],
        ];

        foreach ($produks as $p) {
            // Beri tiap produk 2-4 ulasan acak
            $count = rand(2, 4);
            for ($i = 0; $i < $count; $i++) {
                $rev = $reviews[array_rand($reviews)];
                ProdukReview::create([
                    'produk_id' => $p->id,
                    'nama_lengkap' => $rev['nama'],
                    'email' => strtolower(str_replace(' ', '.', $rev['nama'])) . '@example.com',
                    'rating' => $rev['stars'],
                    'saran' => $rev['saran'],
                    'kritik' => $rev['kritik'],
                    'created_at' => now()->subDays(rand(1, 30)),
                ]);
            }
            
            // Seed shares juga
            $p->update(['shares' => rand(5, 40)]);
        }
    }
}
