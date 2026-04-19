<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;
use App\Models\ProdukTransaksi;

class ProdukTransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $produks = Produk::all();
        if ($produks->isEmpty()) return;

        $names = ['Andiani Putri', 'Farhan Yudha', 'Grace Natalie', 'Kevin Sanjaya', 'Maria Selena', 'Pratama Arhan', 'Rizky Ridho', 'Marselino Ferdinan', 'Asnawi Mangkualam'];
        $addresses = [
            'Jl. Merdeka No. 45, Klojen',
            'Jl. Soekarno Hatta No. 12, Lowokwaru',
            'Jl. Ijen No. 10, Gading Kasri',
            'Perumahan Permata Jingga Blok C-15',
            'Jl. Veteran No. 8, Penanggungan',
            'Dusun Jetak Ngasri, Mulyoagung',
            'Jl. Raya Dau No. 100, Selorejo',
        ];

        $statuses = ['Pesanan Masuk', 'Sedang Dipacking', 'Dalam Perjalanan', 'Sudah Sampai Tujuan'];

        for ($i = 0; $i < 20; $i++) {
            $p = $produks->random();
            $qty = rand(1, 5);
            $total = $p->harga * $qty;
            
            \App\Models\ProdukTransaksi::create([
                'produk_id' => $p->id,
                'jumlah' => $qty,
                'total_harga' => $total,
                'nama_pemesan' => $names[array_rand($names)],
                'telepon' => '08' . rand(100000000, 999999999),
                'alamat' => $addresses[array_rand($addresses)],
                'kelurahan' => 'Selorejo',
                'kecamatan' => 'Dau',
                'kabupaten' => 'Malang',
                'kode_pos' => '65151',
                'metode_pembayaran' => 'WhatsApp Checkout',
                'status' => $statuses[array_rand($statuses)],
                'created_at' => now()->subHours(rand(1, 168)),
            ]);
        }
    }
}
