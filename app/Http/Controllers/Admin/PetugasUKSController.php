<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PetugasUKS;
use App\Models\JadwalKerja;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PetugasUKSController extends Controller
{
    public function index()
    {
        $petugas = PetugasUKS::with(['jadwal', 'kunjungan'])
            ->withCount('kunjungan')
            ->orderBy('nama')
            ->get();

        return view('admin.petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('admin.petugas.form');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'jabatan' => 'required|string|max:255',
            'spesialisasi' => 'nullable|string|max:255',
            'kontak' => 'required|string|max:20',
            'alamat' => 'required|string',
            'jadwal' => 'sometimes|array',
            'jadwal.*.hari' => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jadwal.*.jam_mulai' => 'required|date_format:H:i',
            'jadwal.*.jam_selesai' => 'required|date_format:H:i|after:jadwal.*.jam_mulai',
            'jadwal.*.ruangan' => 'required|string|max:100',
            'kunjungan' => 'sometimes|array',
            'kunjungan.*.tanggal' => 'required|date',
            'kunjungan.*.waktu' => 'required|date_format:H:i',
            'kunjungan.*.kegiatan' => 'required|string|max:255',
            'kunjungan.*.jenis' => 'required|in:rutin,insidental',
            'kunjungan.*.catatan' => 'nullable|string',
            'kunjungan.*.dokumen' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validasi gagal. Silakan periksa kembali data Anda.');
        }

        // Buat petugas baru
        $petugas = PetugasUKS::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'spesialisasi' => $request->spesialisasi,
            'kontak' => $request->kontak,
            'alamat' => $request->alamat
        ]);

        // Simpan jadwal kerja
        if ($request->has('jadwal')) {
            foreach ($request->jadwal as $jadwal) {
                $petugas->jadwal()->create($jadwal);
            }
        }

        // Simpan kunjungan beserta dokumen
        if ($request->has('kunjungan')) {
            foreach ($request->kunjungan as $kunjungan) {
                $dataKunjungan = [
                    'tanggal' => $kunjungan['tanggal'],
                    'waktu' => $kunjungan['waktu'],
                    'kegiatan' => $kunjungan['kegiatan'],
                    'jenis' => $kunjungan['jenis'],
                    'catatan' => $kunjungan['catatan'] ?? null
                ];

                // Handle dokumen upload
                if (isset($kunjungan['dokumen']) && $kunjungan['dokumen']->isValid()) {
                    $path = $kunjungan['dokumen']->store('public/dokumen-kunjungan');
                    $dataKunjungan['dokumen'] = str_replace('public/', '', $path);
                }

                $petugas->kunjungan()->create($dataKunjungan);
            }
        }

        return redirect()->route('admin.petugas-uks.index')
            ->with('success', 'Data petugas berhasil ditambahkan');
    }

    public function show($id)
    {
        $petugas = PetugasUKS::with(['jadwal', 'kunjungan'])
            ->findOrFail($id);

        return view('admin.petugas.show', compact('petugas'));
    }

    public function edit($id)
    {
        $petugas = PetugasUKS::with(['jadwal', 'kunjungan'])
            ->findOrFail($id);

        // Format data jadwal dan kunjungan untuk form
        $petugas->jadwal = $petugas->jadwal->map(function ($item) {
            return [
                'hari' => $item->hari,
                'jam_mulai' => $item->jam_mulai,
                'jam_selesai' => $item->jam_selesai,
                'ruangan' => $item->ruangan
            ];
        })->toArray();

        $petugas->kunjungan = $petugas->kunjungan->map(function ($item) {
            return [
                'tanggal' => $item->tanggal,
                'waktu' => $item->waktu,
                'kegiatan' => $item->kegiatan,
                'jenis' => $item->jenis,
                'catatan' => $item->catatan,
                'dokumen' => $item->dokumen
            ];
        })->toArray();

        return view('admin.petugas.form', compact('petugas'));
    }

    public function update(Request $request, $id)
    {
        $petugas = PetugasUKS::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'jabatan' => 'required|string|max:255',
            'spesialisasi' => 'nullable|string|max:255',
            'kontak' => 'required|string|max:20',
            'alamat' => 'required|string',
            'jadwal' => 'sometimes|array',
            'jadwal.*.hari' => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jadwal.*.jam_mulai' => 'nullable|date_format:H:i',
            'jadwal.*.jam_selesai' => 'nullable|date_format:H:i|after:jadwal.*.jam_mulai',
            'jadwal.*.ruangan' => 'required|string|max:100',
            'kunjungan' => 'sometimes|array',
            'kunjungan.*.tanggal' => 'required|date',
            'kunjungan.*.waktu' => 'required|date_format:H:i',
            'kunjungan.*.kegiatan' => 'required|string|max:255',
            'kunjungan.*.jenis' => 'required|in:rutin,insidental',
            'kunjungan.*.catatan' => 'nullable|string',
            'kunjungan.*.dokumen' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validasi gagal. Silakan periksa kembali data Anda.');
        }

        // Update data utama petugas
        $petugas->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'spesialisasi' => $request->spesialisasi,
            'kontak' => $request->kontak,
            'alamat' => $request->alamat
        ]);

        // **Perbaikan update jadwal**
        $petugas->jadwal()->delete();
        if ($request->has('jadwal')) {
            foreach ($request->jadwal as $jadwal) {
                // Validasi manual jam selesai harus setelah jam mulai
                if (!empty($jadwal['jam_mulai']) && !empty($jadwal['jam_selesai']) && $jadwal['jam_selesai'] <= $jadwal['jam_mulai']) {
                    return redirect()->back()->with('error', 'Jam selesai harus setelah jam mulai.');
                }

                $petugas->jadwal()->create($jadwal);
            }
        }


        // Handle kunjungan
        $existingKunjunganIds = $petugas->kunjungan->pluck('id')->toArray();
        $submittedKunjunganIds = [];

        if ($request->has('kunjungan')) {
            foreach ($request->kunjungan as $kunjungan) {
                $dataKunjungan = [
                    'tanggal' => $kunjungan['tanggal'],
                    'waktu' => $kunjungan['waktu'],
                    'kegiatan' => $kunjungan['kegiatan'],
                    'jenis' => $kunjungan['jenis'],
                    'catatan' => $kunjungan['catatan'] ?? null
                ];

                // Handle dokumen upload jika ada file baru
                if (isset($kunjungan['dokumen']) && $kunjungan['dokumen'] instanceof \Illuminate\Http\UploadedFile) {
                    // Hapus dokumen lama jika ada
                    if (isset($kunjungan['id'])) {
                        $oldKunjungan = Kunjungan::find($kunjungan['id']);
                        if ($oldKunjungan && $oldKunjungan->dokumen) {
                            Storage::delete('public/' . $oldKunjungan->dokumen);
                        }
                    }

                    $path = $kunjungan['dokumen']->store('public/dokumen-kunjungan');
                    $dataKunjungan['dokumen'] = str_replace('public/', '', $path);
                } elseif (isset($kunjungan['id'])) {
                    // Pertahankan dokumen lama jika tidak ada upload baru
                    $existingKunjungan = Kunjungan::find($kunjungan['id']);
                    if ($existingKunjungan && $existingKunjungan->dokumen) {
                        $dataKunjungan['dokumen'] = $existingKunjungan->dokumen;
                    }
                }

                if (isset($kunjungan['id']) && in_array($kunjungan['id'], $existingKunjunganIds)) {
                    // Update kunjungan yang sudah ada
                    $petugas->kunjungan()
                        ->where('id', $kunjungan['id'])
                        ->update($dataKunjungan);
                    $submittedKunjunganIds[] = $kunjungan['id'];
                } else {
                    // Buat kunjungan baru
                    $newKunjungan = $petugas->kunjungan()->create($dataKunjungan);
                    $submittedKunjunganIds[] = $newKunjungan->id;
                }
            }
        }

        // Hapus kunjungan yang tidak ada di request
        $toDeleteKunjungan = array_diff($existingKunjunganIds, $submittedKunjunganIds);
        if (!empty($toDeleteKunjungan)) {
            // Hapus dokumen terkait sebelum menghapus kunjungan
            $kunjungansToDelete = Kunjungan::whereIn('id', $toDeleteKunjungan)->get();
            foreach ($kunjungansToDelete as $kunjungan) {
                if ($kunjungan->dokumen) {
                    Storage::delete('public/' . $kunjungan->dokumen);
                }
            }
            $petugas->kunjungan()->whereIn('id', $toDeleteKunjungan)->delete();
        }

        return redirect()->route('admin.petugas-uks.index')
            ->with('success', 'Data petugas berhasil diperbarui');
    }

    public function destroy($id)
    {
        $petugas = PetugasUKS::findOrFail($id);

        // Hapus dokumen kunjungan terkait
        foreach ($petugas->kunjungan as $kunjungan) {
            if ($kunjungan->dokumen) {
                Storage::delete('public/' . $kunjungan->dokumen);
            }
        }

        // Hapus data terkait
        $petugas->jadwal()->delete();
        $petugas->kunjungan()->delete();
        $petugas->delete();

        return redirect()->route('admin.petugas-uks.index')
            ->with('success', 'Data petugas berhasil dihapus');
    }
}