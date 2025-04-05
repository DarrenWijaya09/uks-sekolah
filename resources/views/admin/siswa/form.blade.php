@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <!-- Header -->
            <div class="px-8 py-5 bg-gradient-to-r from-green-600 to-green-500">
                <h2 class="text-2xl font-bold text-white">
                    {{ isset($siswa) ? 'Edit Siswa' : 'Tambah Siswa' }}
                </h2>
                <p class="mt-1 text-green-100">Silakan isi form data siswa dengan lengkap</p>
            </div>

            <!-- Form Content -->
            <div class="px-8 py-8">
                <form action="{{ isset($siswa) ? route('admin.siswa.update', $siswa->id) : route('admin.siswa.store') }}"
                      method="POST" class="space-y-6">
                    @csrf
                    @if(isset($siswa))
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Siswa</label>
                            <input type="text" name="nama" id="nama"
                                class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                                value="{{ isset($siswa) ? $siswa->nama : old('nama') }}" required>
                        </div>

                        <!-- Kelas -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="kelas" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                            <input type="text" name="kelas" id="kelas"
                                class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                                value="{{ isset($siswa) ? $siswa->kelas : old('kelas') }}" required>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                                value="{{ isset($siswa) ? $siswa->tanggal_lahir : old('tanggal_lahir') }}" required>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin"
                                class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" required>
                                <option value="Laki-laki" {{ (isset($siswa) && $siswa->jenis_kelamin == 'Laki-laki') ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ (isset($siswa) && $siswa->jenis_kelamin == 'Perempuan') ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <!-- Alamat -->
                        <div class="col-span-2">
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                            <textarea name="alamat" id="alamat" rows="3"
                                class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">{{ isset($siswa) ? $siswa->alamat : old('alamat') }}</textarea>
                        </div>

                        <!-- Catatan Medis -->
                        <div class="col-span-2 border-t pt-4">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Catatan Medis</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="keluhan" class="block text-sm font-medium text-gray-700 mb-1">Keluhan</label>
                                    <textarea name="keluhan" id="keluhan" rows="2"
                                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">{{ optional($siswa->catatanMedis->first())->keluhan ?? old('keluhan') }}
                                    </textarea>
                                </div>
                                <div>
                                    <label for="diagnosa" class="block text-sm font-medium text-gray-700 mb-1">Diagnosa</label>
                                    <textarea name="diagnosa" id="diagnosa" rows="2"
                                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">{{ optional($siswa->catatanMedis->sortByDesc('created_at')->first())->diagnosa ?? old('diagnosa') }}
                                    </textarea>
                                </div>
                                <div>
                                    <label for="pengobatan" class="block text-sm font-medium text-gray-700 mb-1">Pengobatan</label>
                                    <textarea name="pengobatan" id="pengobatan" rows="2"
                                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">{{ optional($siswa->catatanMedis->first())->pengobatan ?? old('pengobatan') }}</textarea>
                                </div>
                                <div>
                                    <label for="status_kesehatan" class="block text-sm font-medium text-gray-700 mb-1">Status Kesehatan</label>
                                    <textarea name="status_kesehatan" id="status_kesehatan" rows="2"
                                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">{{ optional($siswa->catatanMedis->first())->status_kesehatan ?? old('status_kesehatan') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Kunjungan UKS -->
                        <div class="col-span-2 border-t pt-4">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Kunjungan UKS</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="tanggal_kunjungan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kunjungan</label>
                                    <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan"
                                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                                        value="{{ optional($siswa->kunjunganUKS->first())->tanggal_kunjungan ?? old('tanggal_kunjungan') }}">
                                </div>
                                <div>
                                    <label for="keluhan_uks" class="block text-sm font-medium text-gray-700 mb-1">Keluhan</label>
                                    <textarea name="keluhan_uks" id="keluhan_uks" rows="2"
                                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">{{ optional($siswa->kunjunganUKS->first())->keluhan ?? old('keluhan_uks') }}</textarea>
                                </div>
                                <div>
                                    <label for="tindakan" class="block text-sm font-medium text-gray-700 mb-1">Tindakan</label>
                                    <textarea name="tindakan" id="tindakan" rows="2"
                                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">{{ optional($siswa->kunjunganUKS->first())->tindakan ?? old('tindakan') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="col-span-2 flex items-center space-x-4 pt-6">
                            <button type="submit"
                                class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-200 ease-in-out transform hover:scale-[1.02]">
                                {{ isset($siswa) ? 'Update' : 'Simpan' }}
                            </button>
                            <a href="{{ route('admin.siswa.index') }}"
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
