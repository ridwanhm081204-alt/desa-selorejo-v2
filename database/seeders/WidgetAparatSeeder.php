<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\WidgetAparat;

class WidgetAparatSeeder extends Seeder {
    public function run() {
        WidgetAparat::truncate();
        WidgetAparat::create([
            'foto_kades' => null,
            'nama_kades' => 'Bambang Soponyono',
            'sambutan' => 'Selamat datang di website resmi Desa Selorejo. Kami berkomitmen untuk mewujudkan desa yang mandiri, transparan, dan berdaya saing melalui pemanfaatan teknologi digital. Kunjungi kebun jeruk keprok kami dan rasakan pengalaman agrowisata yang tak terlupakan.'
        ]);
    }
}
