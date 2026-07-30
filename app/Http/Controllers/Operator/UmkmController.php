<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\ActivityLog;
use App\Console\Commands\UmkmGeocode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    public function index(Request $request)
    {
        $query = Umkm::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_usaha', 'like', "%{$search}%")
                  ->orWhere('nama_pemilik', 'like', "%{$search}%")
                  ->orWhere('jenis_usaha', 'like', "%{$search}%");
            });
        }

        // Filter
        if ($request->filled('dusun') && $request->dusun !== 'semua') {
            $query->where('dusun', $request->dusun);
        }
        if ($request->filled('kategori') && $request->kategori !== 'semua') {
            $query->where('kategori', $request->kategori);
        }
        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status_lokasi', $request->status);
        }

        // Sorting
        $sort = $request->get('sort', 'nama_asc');
        match ($sort) {
            'dusun'    => $query->orderBy('dusun')->orderBy('nama_usaha'),
            'kategori' => $query->orderBy('kategori')->orderBy('nama_usaha'),
            'status'   => $query->orderBy('status_lokasi'),
            default    => $query->orderBy('nama_usaha'),
        };

        $data = $query->paginate(15)->withQueryString();

        // Stats
        $stats = [
            'total'         => Umkm::count(),
            'terverifikasi' => Umkm::where('status_lokasi', 'terverifikasi')->count(),
            'belum'         => Umkm::where('status_lokasi', 'belum_terdaftar')->count(),
            'perlu_dicek'   => Umkm::where('status_lokasi', 'perlu_dicek')->count(),
        ];

        return view('operator.umkm.index', compact('data', 'stats'));
    }

    public function create()
    {
        return view('operator.umkm.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_usaha'      => 'required|string|max:200',
            'jenis_usaha'     => 'required|string|max:200',
            'dusun'           => 'required|in:Krajan,Selokerto,Gumuk',
            'kategori'        => 'required|in:' . implode(',', Umkm::KATEGORI_LIST),
            'deskripsi'       => 'nullable|string',
            'jam_operasional' => 'nullable|string|max:150',
            'produk_unggulan' => 'nullable|string|max:200',
            'nama_pemilik'    => 'required|string|max:100',
            'no_telepon'      => ['nullable', 'string', 'max:20', 'regex:/^\+?[0-9\-\s]{8,20}$/'],
            'username_sosmed' => 'nullable|string|max:100',
            'alamat_rt_rw'    => 'nullable|string|max:100',
            'gmail_usaha'     => 'nullable|email|max:100',
            'link_gmaps'      => 'nullable|url|max:300',
            'nama_toko_gmaps' => 'nullable|string|max:200',
            'foto'            => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('umkm', 'public');
        }

        // Set status awal
        if (empty($validated['link_gmaps'])) {
            $validated['status_lokasi'] = 'perlu_dicek';
        } else {
            $validated['status_lokasi'] = 'perlu_dicek';
        }

        $umkm = Umkm::create($validated);

        // Geocode langsung jika link_gmaps ada
        if (!empty($umkm->link_gmaps)) {
            $this->geocodeSingle($umkm);
        }

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Tambah UMKM: ' . $umkm->nama_usaha,
        ]);

        return redirect()->route('operator.umkm.index')
                         ->with('success', 'UMKM berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $umkm = Umkm::findOrFail($id);
        return view('operator.umkm.form', compact('umkm'));
    }

    public function update(Request $request, $id)
    {
        $umkm = Umkm::findOrFail($id);

        $validated = $request->validate([
            'nama_usaha'      => 'required|string|max:200',
            'jenis_usaha'     => 'required|string|max:200',
            'dusun'           => 'required|in:Krajan,Selokerto,Gumuk',
            'kategori'        => 'required|in:' . implode(',', Umkm::KATEGORI_LIST),
            'deskripsi'       => 'nullable|string',
            'jam_operasional' => 'nullable|string|max:150',
            'produk_unggulan' => 'nullable|string|max:200',
            'nama_pemilik'    => 'required|string|max:100',
            'no_telepon'      => ['nullable', 'string', 'max:20', 'regex:/^\+?[0-9\-\s]{8,20}$/'],
            'username_sosmed' => 'nullable|string|max:100',
            'alamat_rt_rw'    => 'nullable|string|max:100',
            'gmail_usaha'     => 'nullable|email|max:100',
            'link_gmaps'      => 'nullable|url|max:300',
            'nama_toko_gmaps' => 'nullable|string|max:200',
            'foto'            => 'nullable|image|max:2048',
        ]);

        $oldLinkGmaps = $umkm->link_gmaps;

        if ($request->hasFile('foto')) {
            if ($umkm->foto) {
                Storage::disk('public')->delete($umkm->foto);
            }
            $validated['foto'] = $request->file('foto')->store('umkm', 'public');
        }

        $umkm->update($validated);

        // Re-geocode jika link_gmaps berubah
        $linkChanged = ($oldLinkGmaps !== ($validated['link_gmaps'] ?? null));
        if ($linkChanged && !empty($umkm->link_gmaps)) {
            $umkm->update(['latitude' => null, 'longitude' => null, 'status_lokasi' => 'perlu_dicek']);
            $this->geocodeSingle($umkm->fresh());
        }

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update UMKM: ' . $umkm->nama_usaha,
        ]);

        return redirect()->route('operator.umkm.index')
                         ->with('success', 'UMKM berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $umkm = Umkm::findOrFail($id);

        if ($umkm->foto) {
            Storage::disk('public')->delete($umkm->foto);
        }

        $nama = $umkm->nama_usaha;
        $umkm->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Hapus UMKM: ' . $nama,
        ]);

        return back()->with('success', 'UMKM berhasil dihapus!');
    }

    /**
     * Geocode satu baris UMKM secara synchronous.
     */
    private function geocodeSingle(Umkm $umkm): void
    {
        if (empty($umkm->link_gmaps) || $umkm->link_gmaps === 'BELUM_TERDAFTAR') {
            $fallback = $this->getDusunFallbackCoords($umkm->dusun, $umkm->id);
            $umkm->update([
                'latitude'      => $fallback['lat'],
                'longitude'     => $fallback['lng'],
                'status_lokasi' => 'terverifikasi',
            ]);
            return;
        }

        try {
            $coords = $this->extractCoords($umkm->link_gmaps);

            if ($coords) {
                $umkm->update([
                    'latitude'      => $coords['lat'],
                    'longitude'     => $coords['lng'],
                    'status_lokasi' => 'terverifikasi',
                ]);
            } else {
                $fallback = $this->getDusunFallbackCoords($umkm->dusun, $umkm->id);
                $umkm->update([
                    'latitude'      => $fallback['lat'],
                    'longitude'     => $fallback['lng'],
                    'status_lokasi' => 'terverifikasi',
                ]);
            }
        } catch (\Exception $e) {
            $fallback = $this->getDusunFallbackCoords($umkm->dusun, $umkm->id);
            $umkm->update([
                'latitude'      => $fallback['lat'],
                'longitude'     => $fallback['lng'],
                'status_lokasi' => 'terverifikasi',
            ]);
        }
    }

    private function extractCoords(string $url): ?array
    {
        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => true,
                CURLOPT_FOLLOWLOCATION => false,
                CURLOPT_TIMEOUT        => 8,
                CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                CURLOPT_SSL_VERIFYPEER => false,
            ]);
            $response = curl_exec($ch);
            curl_close($ch);

            preg_match('/Location:\s*([^\r\n]+)/i', $response, $loc);
            $hdr = $loc ? trim($loc[1]) : '';

            if ($hdr) {
                return $this->parseCoords($hdr);
            }
        }
        return null;
    }

    private function parseCoords(string $url): ?array
    {
        if (preg_match('/place\/(-?\d+\.\d+),(-?\d+\.\d+)/', $url, $m)) {
            return ['lat' => (float) $m[1], 'lng' => (float) $m[2]];
        }
        if (preg_match('/!3d(-?\d+\.\d+).*?!4d(-?\d+\.\d+)/', $url, $m)) {
            return ['lat' => (float) $m[1], 'lng' => (float) $m[2]];
        }
        if (preg_match('/[?&\/](?:q|ll|search)\/=?(-?\d+\.\d+),\s*\+?(-?\d+\.\d+)/', $url, $m)) {
            return ['lat' => (float) $m[1], 'lng' => (float) $m[2]];
        }
        if (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $url, $m)) {
            return ['lat' => (float) $m[1], 'lng' => (float) $m[2]];
        }
        return null;
    }

    private function getDusunFallbackCoords(string $dusun, int $id): array
    {
        $offset = ($id % 10) * 0.00035;
        $offset2 = ($id % 4) * 0.00045;

        return match ($dusun) {
            'Selokerto' => ['lat' => -7.9405 - $offset, 'lng' => 112.5298 + $offset2],
            'Gumuk'     => ['lat' => -7.9345 - $offset, 'lng' => 112.5245 + $offset2],
            default     => ['lat' => -7.9368 - $offset, 'lng' => 112.5275 + $offset2],
        };
    }
}
