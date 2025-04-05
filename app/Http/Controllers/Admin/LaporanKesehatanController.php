<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanKesehatan;
use App\Models\Siswa;
use App\Models\PenggunaanObat;
use App\Models\KunjunganUKS;

class LaporanKesehatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $periode = $request->input('periode', 'bulanan');

        $laporan = LaporanKesehatan::periode($periode)->paginate(10);
        $trenPenyakit = LaporanKesehatan::trenPenyakit($periode);
        $totalKunjungan = LaporanKesehatan::totalKunjungan($periode);

        // Ambil siswa yang pernah ke UKS
        $siswaUKS = Siswa::with('kunjunganUKS')->paginate(10);

        // Ambil siswa yang pernah menggunakan obat
        $siswaPenggunaanObat = PenggunaanObat::with('siswa', 'obat')->paginate(10);

        return view('admin.laporan.index', compact(
            'laporan', 'trenPenyakit', 'totalKunjungan', 'periode', 'siswaUKS', 'siswaPenggunaanObat'
        ));
    }


    // public function laporan(Request $request)
    // {
    //     $periode = $request->input('periode', 'bulanan'); // Default bulanan
    //     $laporan = LaporanKesehatan::periode($periode)->get();
    //     $trenPenyakit = LaporanKesehatan::trenPenyakit($periode);
    //     $totalKunjungan = LaporanKesehatan::totalKunjungan($periode);

    //     return view('admin.laporan.laporan', compact('laporan', 'trenPenyakit', 'totalKunjungan', 'periode'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.laporan.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'status_kesehatan' => 'required|string',
            'jenis_penyakit' => 'nullable|string',
            'tanggal_kunjungan' => 'required|date',
            'tindakan' => 'nullable|string',
            'obat_diberikan' => 'nullable|string',
            'periode' => 'required|in:bulanan,triwulan,tahunan',
        ]);

        LaporanKesehatan::create($request->all());

        return redirect()->route('admin.laporan-kesehatan.index')->with('success', 'Laporan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
