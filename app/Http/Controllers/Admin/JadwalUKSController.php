<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalUKS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class JadwalUKSController extends Controller
{
    public function index()
    {
        $upcomingEvents = JadwalUKS::where('waktu', '>', now())
            ->orderBy('waktu', 'asc')
            ->get();

        return view('admin.jadwal.index', compact('upcomingEvents'));
    }


    public function create()
    {
        return view('admin.jadwal.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kegiatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'waktu' => 'required|date'
        ]);

        JadwalUKS::create($request->all());

        return redirect()->route('admin.jadwal-uks.index')
            ->with('success', 'Jadwal berhasil ditambahkan')
            ->withHeaders([
                'Cache-Control' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
                'Pragma' => 'no-cache',
                'Expires' => '0'
            ]);
    }

    public function getEvents()
    {
        try {
            $events = JadwalUKS::all()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->kegiatan,
                    'start' => Carbon::parse($item->waktu)->format('Y-m-d'),
                    'end' => Carbon::parse($item->waktu)->format('Y-m-d'),
                    'extendedProps' => [
                        'waktu' => Carbon::parse($item->waktu)->format('d M Y H:i'),
                        'deskripsi' => $item->deskripsi
                    ],
                    'backgroundColor' => $item->waktu > now() ? '#00A3AF' : '#009A44',
                    'borderColor' => '#ffffff'
                ];
            });

            return response()->json($events);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal memuat data kalender'
            ], 500);
        }
    }

    public function edit($id)
    {
        $jadwalUKS = JadwalUKS::findOrFail($id);
        return view('admin.jadwal.form', compact('jadwalUKS'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kegiatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'waktu' => 'required|date',
        ]);

        $jadwalUKS = JadwalUKS::findOrFail($id);
        $jadwalUKS->update([
            'kegiatan' => $request->kegiatan,
            'deskripsi' => $request->deskripsi,
            'waktu' => $request->waktu,
        ]);

        return redirect()->route('admin.jadwal-uks.index')->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function destroy(JadwalUKS $jadwalUKS)
    {
        $jadwalUKS->delete();

        return redirect()->route('admin.jadwal-uks.index')
            ->with('success', 'Jadwal berhasil dihapus');
    }
}