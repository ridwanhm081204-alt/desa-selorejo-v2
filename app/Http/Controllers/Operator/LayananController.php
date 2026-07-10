<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\LogStatus;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengajuan::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('no_tiket', 'like', "%{$search}%")
                  ->orWhere('nik_pemohon', 'like', "%{$search}%")
                  ->orWhere('nama_pemohon', 'like', "%{$search}%");
            });
        }

        // Filter status
        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        // Filter jenis
        if ($request->filled('jenis') && $request->jenis !== 'semua') {
            $query->where('jenis_layanan', $request->jenis);
        }

        $pengajuans = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        // Counters for status
        $counts = [
            'total' => Pengajuan::count(),
            'diajukan' => Pengajuan::where('status', 'diajukan')->count(),
            'diverifikasi' => Pengajuan::where('status', 'diverifikasi')->count(),
            'diproses_disdukcapil' => Pengajuan::where('status', 'diproses_disdukcapil')->count(),
            'selesai' => Pengajuan::where('status', 'selesai')->count(),
            'ditolak' => Pengajuan::where('status', 'ditolak')->count(),
        ];

        return view('operator.layanan.index', compact('pengajuans', 'counts'));
    }

    public function show($id)
    {
        $pengajuan = Pengajuan::with([
            'detailAktaKelahiran',
            'detailAktaKematian',
            'detailKk',
            'detailKtp',
            'dokumenUploads',
            'logStatuses.operator'
        ])->findOrFail($id);

        return view('operator.layanan.show', compact('pengajuan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        $request->validate([
            'status' => 'required|in:diajukan,diverifikasi,diproses_disdukcapil,selesai,ditolak',
            'catatan' => 'required|string|max:1000',
        ]);

        $statusLama = $pengajuan->status;
        $statusBaru = $request->status;

        $pengajuan->update([
            'status' => $statusBaru,
            'catatan_admin' => $request->catatan,
            'diverifikasi_oleh' => auth()->id(),
        ]);

        LogStatus::create([
            'pengajuan_id' => $pengajuan->id,
            'status_lama' => $statusLama,
            'status_baru' => $statusBaru,
            'diubah_oleh' => auth()->id(),
            'catatan' => $request->catatan,
        ]);

        // If death certificate is completed (selesai), can we automatically do anything? Not requested, just track status.

        return back()->with('success', 'Status pengajuan #' . $pengajuan->no_tiket . ' berhasil diperbarui.');
    }

    public function kirimNotifikasi($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        $statusLabel = $pengajuan->status_label;
        $catatan = $pengajuan->catatan_admin ?: 'Sedang diproses oleh petugas desa.';
        
        $pesan = "Halo {$pengajuan->nama_pemohon},\n\nKami menginfokan update status pengajuan layanan desa Anda:\n\n📌 *Layanan:* {$pengajuan->jenis_layanan_label}\n🎫 *No. Tiket:* {$pengajuan->no_tiket}\n📈 *Status Baru:* {$statusLabel}\n📝 *Catatan:* {$catatan}\n\nAnda dapat mengecek progres pengajuan kapan saja di website resmi Desa Selorejo via menu Cek Status Layanan.\n\nTerima kasih atas kesabarannya!\n\n_Pemerintah Desa Selorejo_";

        $noHp = preg_replace('/[^0-9]/', '', $pengajuan->no_hp_pemohon);
        if (str_starts_with($noHp, '0')) {
            $noHp = '62' . substr($noHp, 1);
        }

        $waUrl = "https://wa.me/{$noHp}?text=" . urlencode($pesan);

        return redirect()->away($waUrl);
    }
}
