<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Polling;

class PollingSeeder extends Seeder {
    public function run() {
        Polling::truncate();
        Polling::create([
            'pertanyaan' => 'Apakah Anda puas dengan pelayanan Pemerintah Desa Selorejo bulan ini?',
            'jumlah_ya' => 47,
            'jumlah_tidak' => 8,
            'tanggal_mulai' => '2026-04-01',
            'tanggal_selesai' => '2026-04-30',
            'is_active' => true
        ]);
    }
}
