<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PenggunaanObat;
use App\Models\Obat;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenggunaanObatController extends Controller
{
    public function index()
    {
        $stokRendahThreshold = 10;

        $obats = Obat::paginate(10);
        $lowStock = Obat::where('stok', '<', $stokRendahThreshold)->get();
        $penggunaanHariIni = PenggunaanObat::whereDate('created_at', today())->count();
        $totalPenggunaanHariIni = PenggunaanObat::whereDate('created_at', today())->sum('jumlah');
        $totalObat = Obat::count();
        $obatTerendah = Obat::orderBy('stok', 'asc')->limit(5)->get();

        return view('admin.obat.index', compact(
            'obats', 'lowStock', 'penggunaanHariIni', 'totalPenggunaanHariIni', 'totalObat', 'obatTerendah'
        ));
    }



    public function create()
    {
        $siswas = Siswa::all();
        $obats = Obat::where('stok', '>', 0)->get();

        return view('admin.obat.penggunaan', compact('siswas', 'obats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'obat_id' => 'required|exists:obat,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_penggunaan' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            $obat = Obat::findOrFail($request->obat_id);

            if ($obat->stok < $request->jumlah) {
                return back()
                    ->withInput()
                    ->withErrors(['jumlah' => "Stok {$obat->nama_obat} tidak mencukupi. Stok tersedia: {$obat->stok}"]);
            }

            // Buat record penggunaan obat
            $penggunaan = PenggunaanObat::create([
                'siswa_id' => $request->siswa_id,
                'obat_id' => $request->obat_id,
                'jumlah' => $request->jumlah,
                'tanggal_penggunaan' => $request->tanggal_penggunaan,
                'keterangan' => $request->keterangan
            ]);

            // Kurangi stok obat
            if (!$obat->kurangiStok($request->jumlah)) {
                throw new \Exception('Gagal mengurangi stok obat');
            }

            DB::commit();
            return redirect()
                ->route('admin.penggunaan-obat.riwayat')
                ->with('success', 'Penggunaan obat berhasil dicatat');

        } catch (\Exception $e) {
            DB::rollback();
            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat mencatat penggunaan obat. ' . $e->getMessage()]);
        }
    }

    public function riwayat()
    {
        $month = request('month', date('m'));
        $year = request('year', date('Y'));

        $penggunaan = PenggunaanObat::with(['siswa', 'obat'])
            ->whereYear('tanggal_penggunaan', $year)
            ->whereMonth('tanggal_penggunaan', $month)
            ->latest('tanggal_penggunaan')
            ->paginate(10);

        $totalPenggunaan = PenggunaanObat::whereYear('tanggal_penggunaan', $year)
            ->whereMonth('tanggal_penggunaan', $month)
            ->sum('jumlah');

        $mostUsedMedicine = DB::table('penggunaan_obat')
            ->join('obat', 'penggunaan_obat.obat_id', '=', 'obat.id')
            ->select('obat.nama_obat as nama', DB::raw('SUM(penggunaan_obat.jumlah) as total'))
            ->whereYear('tanggal_penggunaan', $year)
            ->whereMonth('tanggal_penggunaan', $month)
            ->groupBy('obat.id', 'obat.nama_obat')
            ->orderByDesc('total')
            ->first();

        $totalSiswa = PenggunaanObat::whereYear('tanggal_penggunaan', $year)
            ->whereMonth('tanggal_penggunaan', $month)
            ->distinct('siswa_id')
            ->count('siswa_id');

        return view('admin.obat.riwayat', compact(
            'penggunaan',
            'totalPenggunaan',
            'mostUsedMedicine',
            'totalSiswa'
        ));
    }

    public function edit(PenggunaanObat $penggunaanObat)
    {
        $obats = Obat::all();
        $siswas = Siswa::all();
        return view('admin.penggunaan-obat.edit', compact('penggunaanObat', 'obats', 'siswas'));
    }

    public function update(Request $request, PenggunaanObat $penggunaanObat)
    {
        // Implementasi update
    }

    public function destroy(PenggunaanObat $penggunaanObat)
    {
        DB::beginTransaction();
        try {
            $obat = $penggunaanObat->obat;

            // Kembalikan stok obat
            if (!$obat->tambahStok($penggunaanObat->jumlah)) {
                throw new \Exception('Gagal mengembalikan stok obat');
            }

            // Hapus record penggunaan
            $penggunaanObat->delete();

            DB::commit();
            return redirect()
                ->route('admin.penggunaan-obat.riwayat')
                ->with('success', 'Catatan penggunaan berhasil dihapus dan stok obat dikembalikan');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus penggunaan obat. ' . $e->getMessage()]);
        }
    }
}
