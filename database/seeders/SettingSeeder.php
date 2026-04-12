<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder {
    public function run() {
        $settings = [
            ['key'=>'nama_desa','value'=>'Desa Selorejo'],
            ['key'=>'nama_pemerintah','value'=>'Pemerintah Desa Selorejo'],
            ['key'=>'kecamatan','value'=>'Kecamatan Dau'],
            ['key'=>'kabupaten','value'=>'Kabupaten Malang'],
            ['key'=>'provinsi','value'=>'Jawa Timur'],
            ['key'=>'alamat','value'=>'Jl. Raya Selorejo No. 1, Desa Selorejo, Kec. Dau, Kab. Malang 65151'],
            ['key'=>'telepon','value'=>'0813.3163.5678'],
            ['key'=>'whatsapp','value'=>'0813.3163.5678'],
            ['key'=>'email','value'=>'desawisataselorejo@gmail.com'],
            ['key'=>'jam_kerja','value'=>'Senin-Jumat: 08.00-15.00 WIB'],
            ['key'=>'facebook','value'=>'https://facebook.com/desaselorejo'],
            ['key'=>'instagram','value'=>'https://instagram.com/desaselorejo'],
            ['key'=>'youtube','value'=>''],
            ['key'=>'kode_pos','value'=>'65151'],
            ['key'=>'jumlah_penduduk','value'=>'3.640'],
            ['key'=>'jumlah_kk','value'=>'1.024'],
            ['key'=>'luas_wilayah','value'=>'623'],
            ['key'=>'jumlah_dusun','value'=>'3']
        ];
        foreach ($settings as $s) {
            Setting::updateOrCreate(['key'=>$s['key']], ['value'=>$s['value']]);
        }
    }
}
