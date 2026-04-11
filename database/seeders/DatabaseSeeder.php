<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $this->call([
            UserSeeder::class,
            ProfileSeeder::class,
            StrukturOrganisasiSeeder::class,
            BpdSeeder::class,
            LembagaDesaSeeder::class,
            WisataSeeder::class,
            ProdukSeeder::class,
            GaleriSeeder::class,
            StatistikPendudukSeeder::class,
            ApbdesSeeder::class,
            BeritaSeeder::class,
            PollingSeeder::class,
            WidgetAparatSeeder::class,
            TautanTerkaitSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
