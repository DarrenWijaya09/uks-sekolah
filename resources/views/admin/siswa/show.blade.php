@extends('layouts.admin')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Detail Siswa</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="text-gray-600 font-medium">Nama Lengkap</label>
                                <p class="text-gray-800">{{ $siswa->nama ?? 'Data tidak tersedia' }}</p>
                            </div>

                            <div>
                                <label class="text-gray-600 font-medium">Kelas</label>
                                <p class="text-gray-800">{{ $siswa->kelas ?? 'Data tidak tersedia' }}</p>
                            </div>

                            <div>
                                <label class="text-gray-600 font-medium">Jenis Kelamin</label>
                                <p class="text-gray-800">{{ $siswa->jenis_kelamin }}</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="text-gray-600 font-medium">Tanggal Lahir</label>
                                <p class="text-gray-800">{{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d F Y') }}
                                </p>
                            </div>

                            <div>
                                <label class="text-gray-600 font-medium">Alamat</label>
                                <p class="text-gray-800">{{ $siswa->alamat }}</p>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Catatan Medis</h3>
                                    @if($siswa->catatanMedis->count() > 0)
                                        <div class="space-y-2">
                                            @foreach ($siswa->catatanMedis as $catatan)
                                                <div class="p-4 bg-gray-50 rounded-lg">
                                                    <p class="text-gray-600"><span class="font-medium">Keluhan:</span> {{ $catatan->keluhan }}</p>
                                                    <p class="text-gray-600"><span class="font-medium">Diagnosa:</span> {{ $catatan->diagnosa }}</p>
                                                    <p class="text-gray-600"><span class="font-medium">Pengobatan:</span> {{ $catatan->pengobatan }}</p>
                                                    <p class="text-gray-600"><span class="font-medium">Status Kesehatan:</span> {{ $catatan->status_kesehatan }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-gray-500 italic">Tidak ada catatan medis</p>
                                    @endif
                                </div>

                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Kunjungan UKS</h3>
                                    @if($siswa->kunjunganUKS->count() > 0)
                                        <div class="space-y-2">
                                            @foreach ($siswa->kunjunganUKS as $kunjungan)
                                                <div class="p-4 bg-gray-50 rounded-lg">
                                                    <p class="text-gray-600"><span class="font-medium">Tanggal:</span> {{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('d F Y') }}</p>
                                                    <p class="text-gray-600"><span class="font-medium">Keluhan:</span> {{ $kunjungan->keluhan }}</p>
                                                    <p class="text-gray-600"><span class="font-medium">Tindakan:</span> {{ $kunjungan->tindakan }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-gray-500 italic">Tidak ada riwayat kunjungan UKS</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex space-x-4">
                        <a href="{{ route('admin.siswa.edit', $siswa->id) }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                            Edit Data
                        </a>
                        <a href="{{ route('admin.siswa.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                        <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
