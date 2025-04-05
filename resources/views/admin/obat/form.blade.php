@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <!-- Header -->
            <div class="px-8 py-5 bg-gradient-to-r from-green-600 to-green-500">
                <h2 class="text-2xl font-bold text-white">
                    {{ isset($obat) ? 'Edit Obat / Alat Kesehatan' : 'Tambah Obat / Alat Kesehatan' }}
                </h2>
                <p class="mt-1 text-green-100">Silakan isi form berikut dengan lengkap</p>
            </div>

            <!-- Form Content -->
            <div class="px-8 py-8">
                <form action="{{ isset($obat) ? route('admin.obat.update', $obat->id) : route('admin.obat.store') }}"
                      method="POST"
                      class="space-y-6">
                    @csrf
                    @if(isset($obat))
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Obat -->
                        <div class="col-span-2">
                            <label for="nama_obat" class="block text-sm font-medium text-gray-700 mb-1">Nama Obat/Alkes</label>
                            <input type="text"
                                   name="nama_obat"
                                   id="nama_obat"
                                   required
                                   value="{{ old('nama_obat', $obat->nama_obat ?? '') }}"
                                   class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                                   placeholder="Masukkan nama obat atau alat kesehatan">
                            @error('nama_obat')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                            <select name="kategori"
                                    id="kategori"
                                    required
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                                <option value="">Pilih Kategori</option>
                                <option value="obat" {{ (old('kategori', $obat->kategori ?? '') == 'obat') ? 'selected' : '' }}>Obat</option>
                                <option value="alkes" {{ (old('kategori', $obat->kategori ?? '') == 'alkes') ? 'selected' : '' }}>Alat Kesehatan</option>
                            </select>
                            @error('kategori')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jenis (diubah menjadi text input) -->
                        <div>
                            <label for="jenis" class="block text-sm font-medium text-gray-700 mb-1">Jenis</label>
                            <input type="text"
                                   name="jenis"
                                   id="jenis"
                                   required
                                   value="{{ old('jenis', $obat->jenis ?? '') }}"
                                   class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                                   placeholder="Masukkan jenis obat/alkes">
                            @error('jenis')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Stok -->
                        <div>
                            <label for="stok" class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                            <input type="number"
                                   name="stok"
                                   id="stok"
                                   required
                                   min="0"
                                   value="{{ old('stok', $obat->stok ?? '') }}"
                                   class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                                   placeholder="Masukkan jumlah stok">
                            @error('stok')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Stok Minimum -->
                        <div>
                            <label for="stok_minimum" class="block text-sm font-medium text-gray-700 mb-1">Stok Minimum</label>
                            <input type="number"
                                   name="stok_minimum"
                                   id="stok_minimum"
                                   required
                                   min="0"
                                   value="{{ old('stok_minimum', $obat->stok_minimum ?? '') }}"
                                   class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                                   placeholder="Stok minimum untuk peringatan">
                            @error('stok_minimum')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Kadaluarsa -->
                        <div>
                            <label for="tanggal_kadaluarsa" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kadaluarsa</label>
                            <input type="date"
                                   name="tanggal_kadaluarsa"
                                   id="tanggal_kadaluarsa"
                                   required
                                   value="{{ old('tanggal_kadaluarsa', isset($obat) ? $obat->tanggal_kadaluarsa->format('Y-m-d') : '') }}"
                                   class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            @error('tanggal_kadaluarsa')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Keterangan -->
                        <div class="col-span-2">
                            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                            <textarea name="keterangan"
                                      id="keterangan"
                                      rows="3"
                                      class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                                      placeholder="Masukkan keterangan tambahan jika ada">{{ old('keterangan') ?: ($obat->keterangan ?? '') }}</textarea>
                            @error('keterangan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="col-span-2 flex items-center space-x-4 pt-4">
                            <button type="submit"
                                class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-200 ease-in-out transform hover:scale-[1.02]">
                                {{ isset($obat) ? 'Update' : 'Simpan' }}
                            </button>
                            <a href="{{ route('admin.obat.index') }}"
                                class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium rounded-lg transition duration-200 ease-in-out">
                                Kembali
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
