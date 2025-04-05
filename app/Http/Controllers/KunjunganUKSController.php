<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KunjunganUKS;
class KunjunganUKSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal_kunjungan' => 'required|date',
            'keluhan' => 'required|string',
            'tindakan' => 'nullable|string',
        ]);

        KunjunganUKS::create($request->all());

        return redirect()->route('kunjungan_uks.index')->with('success', 'Data kunjungan berhasil ditambahkan!');
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
