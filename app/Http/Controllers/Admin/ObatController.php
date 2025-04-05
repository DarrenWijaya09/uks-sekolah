<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use App\Models\PenggunaanObat;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Query dasar untuk filter
        $baseQuery = Obat::query()
            ->when(request('kategori'), function($query) {
                return $query->where('kategori', request('kategori'));
            })
            ->when(request('stok_filter') === 'low', function($query) {
                return $query->lowStock();
            })
            ->when(request('stok_filter') === 'empty', function($query) {
                return $query->outOfStock();
            });

        // Data untuk tabel dengan pagination
        $obats = (clone $baseQuery)
            ->latest()
            ->paginate(10);

        // Ambil data stok rendah
        $lowStock = Obat::lowStock()->get();

        // Hitung penggunaan hari ini
        $penggunaanHariIni = PenggunaanObat::whereDate('tanggal_penggunaan', today())->count();

        return view('admin.obat.index', compact(
            'obats',
            'lowStock',
            'penggunaanHariIni'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.obat.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kategori' => 'required|in:obat,alkes',
            'jenis' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'stok_minimum' => 'required|integer|min:0',
            'tanggal_kadaluarsa' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            Obat::create($validated);
            DB::commit();

            return redirect()
                ->route('admin.obat.index')
                ->with('success', 'Obat berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menambah obat. ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $obat = Obat::findOrFail($id);

        // Ambil riwayat penggunaan obat berdasarkan ID obat
        $penggunaan_obat = PenggunaanObat::where('obat_id', $id)->with(['siswa', 'obat'])->get();

        return view('admin.obat.show', compact('obat', 'penggunaan_obat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $obat = Obat::findOrFail($id);
        return view('admin.obat.form', compact('obat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $obat = Obat::findOrFail($id);

        $validated = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kategori' => 'required|in:obat,alkes',
            'jenis' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'stok_minimum' => 'required|integer|min:0',
            'tanggal_kadaluarsa' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            $obat->update($validated);
            DB::commit();

            return redirect()
                ->route('admin.obat.index')
                ->with('success', 'Obat berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui obat. ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $obat = Obat::findOrFail($id);

            // Cek apakah obat masih memiliki riwayat penggunaan
            if ($obat->penggunaanObat()->exists()) {
                return back()->withErrors(['error' => 'Tidak dapat menghapus obat yang memiliki riwayat penggunaan']);
            }

            $obat->delete();
            DB::commit();

            return redirect()
                ->route('admin.obat.index')
                ->with('success', 'Obat berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus obat. ' . $e->getMessage()]);
        }
    }
}
