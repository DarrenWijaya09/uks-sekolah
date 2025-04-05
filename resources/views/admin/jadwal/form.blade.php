@extends('layouts.admin')
@section('content')
<div class="container mx-auto p-6 bg-gradient-to-br from-[#F5F5F5] to-[#FFFFFF] min-h-screen">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-[#009A44] mb-6">
                @isset($jadwalUKS) Edit Jadwal @else Tambah Jadwal @endisset
            </h2>

            <form method="POST"
                  action="@isset($jadwalUKS) {{ route('admin.jadwal-uks.update', $jadwalUKS->id) }} @else {{ route('admin.jadwal-uks.store') }} @endisset">
                @csrf
                @isset($jadwalUKS) @method('PUT') @endisset

                <div class="mb-6">
                    <label class="block text-[#4A4A4A] mb-2">Nama Kegiatan</label>
                    <input type="text" name="kegiatan" value="{{ $jadwalUKS->kegiatan ?? old('kegiatan') }}"
                           class="w-full p-3 border border-[#E0E0E0] rounded-lg focus:border-[#009A44] focus:ring-[#009A44]">
                </div>

                <div class="mb-6">
                    <label class="block text-[#4A4A4A] mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                              class="w-full p-3 border border-[#E0E0E0] rounded-lg focus:border-[#009A44] focus:ring-[#009A44]">{{ $jadwalUKS->deskripsi ?? old('deskripsi') }}</textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-[#4A4A4A] mb-2">Waktu Pelaksanaan</label>
                    <input type="datetime-local" name="waktu"
                    value="{{ isset($jadwalUKS) ? \Carbon\Carbon::parse($jadwalUKS->waktu)->format('Y-m-d\TH:i') : old('waktu') }}"
                           class="w-full p-3 border border-[#E0E0E0] rounded-lg focus:border-[#009A44] focus:ring-[#009A44]">
                </div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('admin.jadwal-uks.index') }}"
                       class="bg-gray-100 text-[#4A4A4A] px-6 py-2 rounded-lg hover:bg-gray-200">
                        Batal
                    </a>
                    <button type="submit"
                            class="bg-[#00A3AF] text-white px-6 py-2 rounded-lg hover:bg-[#00818C] transition-colors">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection