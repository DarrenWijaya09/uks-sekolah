<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\Log;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Siswa::query();

        if ($request->has('search') && $request->search !== '') {
            $searchTerm = strtolower($request->search);
            $query->where(function($q) use ($searchTerm) {
                $q->whereRaw('LOWER(nama) LIKE ?', ['%' . $searchTerm . '%'])
                  ->orWhereRaw('LOWER(kelas) LIKE ?', ['%' . $searchTerm . '%']);
            });

            // Untuk debug
            Log::info('Search term: ' . $searchTerm);
            Log::info('SQL Query: ' . $query->toSql());
        }

        $siswa = $query->orderBy('created_at', 'desc')->paginate(10);
        $kelasOptions = Siswa::distinct()->pluck('kelas')->sort()->values();

        return view('admin.siswa.index', compact('siswa', 'kelasOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.siswa.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            // Validasi Catatan Medis
            'keluhan' => 'nullable',
            'diagnosa' => 'nullable',
            'pengobatan' => 'nullable',
            'status_kesehatan' => 'nullable',
            // Validasi Kunjungan UKS
            'tanggal_kunjungan' => 'nullable|date',
            'keluhan_uks' => 'nullable',
            'tindakan' => 'nullable',
        ]);

        // Simpan data siswa
        $siswa = Siswa::create([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
        ]);

        // Simpan catatan medis jika ada
        if ($request->filled('keluhan') || $request->filled('diagnosa') || $request->filled('pengobatan')) {
            $siswa->catatanMedis()->create([
                'keluhan' => $request->keluhan,
                'diagnosa' => $request->diagnosa,
                'pengobatan' => $request->pengobatan,
                'status_kesehatan' => $request->status_kesehatan,
            ]);
        }

        // Simpan kunjungan UKS jika ada
        if ($request->filled('tanggal_kunjungan') || $request->filled('keluhan_uks') || $request->filled('tindakan')) {
            $siswa->kunjunganUKS()->create([
                'tanggal_kunjungan' => $request->tanggal_kunjungan,
                'keluhan' => $request->keluhan_uks,
                'tindakan' => $request->tindakan,
            ]);
        }

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        if (!$siswa) {
            return redirect()->route('admin.siswa.index')
                ->with('error', 'Siswa tidak ditemukan');
        }
        return view('admin.siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $siswa = Siswa::with(['catatanMedis', 'kunjunganUKS'])->findOrFail($id);
        return view('admin.siswa.form', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            // Validasi Catatan Medis
            'keluhan' => 'nullable',
            'diagnosa' => 'nullable',
            'pengobatan' => 'nullable',
            'status_kesehatan' => 'nullable',
            // Validasi Kunjungan UKS
            'tanggal_kunjungan' => 'nullable|date',
            'keluhan_uks' => 'nullable',
            'tindakan' => 'nullable',
        ]);

        $siswa = Siswa::with(['catatanMedis', 'kunjunganUKS'])->findOrFail($id);

        // Update data siswa utama
        $siswa->update([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
        ]);

        // Update atau buat catatan medis
        $catatanMedis = $siswa->catatanMedis->first();
        if ($catatanMedis) {
            $catatanMedis->update([
                'keluhan' => $request->keluhan,
                'diagnosa' => $request->diagnosa,
                'pengobatan' => $request->pengobatan,
                'status_kesehatan' => $request->status_kesehatan,
            ]);
        } else if ($request->filled('keluhan') || $request->filled('diagnosa') || $request->filled('pengobatan')) {
            $siswa->catatanMedis()->create([
                'keluhan' => $request->keluhan,
                'diagnosa' => $request->diagnosa,
                'pengobatan' => $request->pengobatan,
                'status_kesehatan' => $request->status_kesehatan,
            ]);
        }

        // Update atau buat kunjungan UKS
        $kunjunganUKS = $siswa->kunjunganUKS->first();
        if ($kunjunganUKS) {
            $kunjunganUKS->update([
                'tanggal_kunjungan' => $request->tanggal_kunjungan,
                'keluhan' => $request->keluhan_uks,
                'tindakan' => $request->tindakan,
            ]);
        } else if ($request->filled('tanggal_kunjungan') || $request->filled('keluhan_uks') || $request->filled('tindakan')) {
            $siswa->kunjunganUKS()->create([
                'tanggal_kunjungan' => $request->tanggal_kunjungan,
                'keluhan' => $request->keluhan_uks,
                'tindakan' => $request->tindakan,
            ]);
        }

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $siswa = Siswa::findOrFail($id);
            $siswa->delete();
            return redirect()->route('admin.siswa.index')
                ->with('success', 'Siswa berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('admin.siswa.index')
                ->with('error', 'Gagal menghapus siswa');
        }
    }
}
