@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-4">
        <div class="max-w-5xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-[#009A44] to-[#00A3AF] px-6 py-4">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-user-md mr-3"></i>
                    {{ isset($petugas) ? 'Edit Petugas UKS' : 'Tambah Petugas UKS' }}
                </h2>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-red-700">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Card Body -->
            <div class="p-6 bg-gray-50">
                <form
                    action="{{ isset($petugas) ? route('admin.petugas-uks.update', $petugas->id) : route('admin.petugas-uks.store') }}"
                    method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @if (isset($petugas))
                        @method('PUT')
                    @endif

                    <!-- Two Column Layout -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-4">
                            <!-- Nama Field -->
                            <div class="form-group">
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="text" name="nama" id="nama"
                                        class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-4 pr-10 py-2 sm:text-sm border-gray-300 rounded-md"
                                        value="{{ old('nama', $petugas->nama ?? '') }}" placeholder="Nama lengkap petugas"
                                        required>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                </div>
                                @error('nama')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- NIP Field -->
                            <div class="form-group">
                                <label for="nip" class="block text-sm font-medium text-gray-700 mb-1">
                                    NIP
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="text" name="nip" id="nip"
                                        class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-4 pr-10 py-2 sm:text-sm border-gray-300 rounded-md"
                                        value="{{ old('nip', $petugas->nip ?? '') }}" placeholder="Nomor Induk Pegawai">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i class="fas fa-id-card text-gray-400"></i>
                                    </div>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Opsional - tidak harus 18 digit</p>
                            </div>

                            <!-- Jabatan Field -->
                            <div class="form-group">
                                <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-1">
                                    Jabatan <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="text" name="jabatan" id="jabatan"
                                        class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-4 pr-10 py-2 sm:text-sm border-gray-300 rounded-md"
                                        value="{{ old('jabatan', $petugas->jabatan ?? '') }}"
                                        placeholder="Contoh: Dokter, Perawat, Bidan" required>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i class="fas fa-briefcase text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-4">
                            <!-- Spesialisasi Field -->
                            <div class="form-group">
                                <label for="spesialisasi" class="block text-sm font-medium text-gray-700 mb-1">
                                    Spesialisasi
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="text" name="spesialisasi" id="spesialisasi"
                                        class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-4 pr-10 py-2 sm:text-sm border-gray-300 rounded-md"
                                        value="{{ old('spesialisasi', $petugas->spesialisasi ?? '') }}"
                                        placeholder="Contoh: Dokter Umum, Perawat Gigi">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i class="fas fa-stethoscope text-gray-400"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Kontak Field -->
                            <div class="form-group">
                                <label for="kontak" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nomor Kontak <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="tel" name="kontak" id="kontak"
                                        class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-4 pr-10 py-2 sm:text-sm border-gray-300 rounded-md"
                                        value="{{ old('kontak', $petugas->kontak ?? '') }}"
                                        placeholder="Contoh: 081234567890" required>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i class="fas fa-phone-alt text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Alamat Field -->
                    <div class="form-group">
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">
                            Alamat Lengkap <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1">
                            <textarea name="alamat" id="alamat" rows="3"
                                class="shadow-sm focus:ring-[#009A44] focus:border-[#009A44] block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder="Alamat lengkap tempat tinggal petugas" required>{{ old('alamat', $petugas->alamat ?? '') }}</textarea>
                        </div>
                    </div>

                    <!-- Jadwal Kerja Section -->
                    <div class="form-group">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Jadwal Kerja <span class="text-red-500">*</span>
                        </label>
                        <div id="jadwal-container" class="space-y-3">
                            @if (old('jadwal', isset($petugas) ? $petugas->jadwal : []))
                                @foreach (old('jadwal', isset($petugas) ? $petugas->jadwal : []) as $index => $jadwal)
                                    <div
                                        class="flex flex-col sm:flex-row gap-3 items-start sm:items-center jadwal-item p-3 bg-gray-50 rounded-lg border border-gray-200">
                                        <input type="hidden" name="jadwal[{{ $index }}][id]"
                                            value="{{ $jadwal['id'] ?? '' }}">

                                        <div class="w-full sm:w-1/4">
                                            <label class="block text-xs text-gray-500 mb-1">Hari</label>
                                            <select name="jadwal[{{ $index }}][hari]"
                                                class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md"
                                                required>
                                                <option value="Senin"
                                                    {{ ($jadwal['hari'] ?? '') == 'Senin' ? 'selected' : '' }}>Senin
                                                </option>
                                                <option value="Selasa"
                                                    {{ ($jadwal['hari'] ?? '') == 'Selasa' ? 'selected' : '' }}>Selasa
                                                </option>
                                                <option value="Rabu"
                                                    {{ ($jadwal['hari'] ?? '') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                                <option value="Kamis"
                                                    {{ ($jadwal['hari'] ?? '') == 'Kamis' ? 'selected' : '' }}>Kamis
                                                </option>
                                                <option value="Jumat"
                                                    {{ ($jadwal['hari'] ?? '') == 'Jumat' ? 'selected' : '' }}>Jumat
                                                </option>
                                                <option value="Sabtu"
                                                    {{ ($jadwal['hari'] ?? '') == 'Sabtu' ? 'selected' : '' }}>Sabtu
                                                </option>
                                            </select>
                                        </div>

                                        <div class="w-full sm:w-1/5">
                                            <label class="block text-xs text-gray-500 mb-1">Jam Mulai</label>
                                            <input type="time" name="jadwal[{{ $index }}][jam_mulai]"
                                                class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md"
                                                value="{{ old("jadwal.$index.jam_mulai", isset($jadwal['jam_mulai']) ? date('H:i', strtotime($jadwal['jam_mulai'])) : '') }}">
                                        </div>

                                        <div class="w-full sm:w-1/5">
                                            <label class="block text-xs text-gray-500 mb-1">Jam Selesai</label>
                                            <input type="time" name="jadwal[{{ $index }}][jam_selesai]"
                                                class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md"
                                                value="{{ old("jadwal.$index.jam_selesai", isset($jadwal['jam_selesai']) ? date('H:i', strtotime($jadwal['jam_selesai'])) : '') }}">
                                        </div>

                                        <div class="w-full sm:w-1/4">
                                            <label class="block text-xs text-gray-500 mb-1">Ruangan</label>
                                            <input type="text" name="jadwal[{{ $index }}][ruangan]"
                                                class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md"
                                                value="{{ $jadwal['ruangan'] ?? '' }}" placeholder="Nama ruangan"
                                                required>
                                        </div>

                                        <div class="w-full sm:w-auto self-end sm:self-center">
                                            <button type="button"
                                                class="btn-remove-jadwal w-full sm:w-auto px-3 py-2 bg-red-50 text-red-600 rounded-md hover:bg-red-100 text-sm">
                                                <i class="fas fa-trash mr-1"></i> Hapus
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div
                                    class="flex flex-col sm:flex-row gap-3 items-start sm:items-center jadwal-item p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <div class="w-full sm:w-1/4">
                                        <label class="block text-xs text-gray-500 mb-1">Hari</label>
                                        <select name="jadwal[0][hari]"
                                            class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md"
                                            required>
                                            <option value="Senin">Senin</option>
                                            <option value="Selasa">Selasa</option>
                                            <option value="Rabu">Rabu</option>
                                            <option value="Kamis">Kamis</option>
                                            <option value="Jumat">Jumat</option>
                                            <option value="Sabtu">Sabtu</option>
                                        </select>
                                    </div>

                                    <div class="w-full sm:w-1/5">
                                        <label class="block text-xs text-gray-500 mb-1">Jam Mulai</label>
                                        <input type="time" name="jadwal[0][jam_mulai]" class="..."
                                            value="{{ old('jadwal.0.jam_mulai', isset($jadwal['jam_mulai']) ? date('H:i', strtotime($jadwal['jam_mulai'])) : '') }}">
                                    </div>

                                    <div class="w-full sm:w-1/5">
                                        <label class="block text-xs text-gray-500 mb-1">Jam Selesai</label>
                                        <input type="time" name="jadwal[0][jam_selesai]"
                                            class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md"
                                            required>
                                    </div>

                                    <div class="w-full sm:w-1/4">
                                        <label class="block text-xs text-gray-500 mb-1">Ruangan</label>
                                        <input type="text" name="jadwal[0][ruangan]"
                                            class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md"
                                            placeholder="Nama ruangan" required>
                                    </div>

                                    <div class="w-full sm:w-auto self-end sm:self-center">
                                        <button type="button"
                                            class="btn-remove-jadwal w-full sm:w-auto px-3 py-2 bg-red-50 text-red-600 rounded-md hover:bg-red-100 text-sm">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <button type="button" id="add-jadwal"
                            class="mt-3 px-4 py-2 bg-[#00A3AF] text-white rounded-md hover:bg-[#008B9A] text-sm flex items-center">
                            <i class="fas fa-plus-circle mr-2"></i> Tambah Jadwal
                        </button>
                    </div>

                    <!-- Kunjungan Section -->
                    <div class="form-group">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Riwayat Kunjungan
                        </label>
                        <div id="kunjungan-container" class="space-y-3">
                            @if (isset($petugas) && $petugas->kunjungan)
                                @foreach ($petugas->kunjungan as $index => $kunjungan)
                                    <div
                                        class="flex flex-col gap-3 kunjungan-item p-4 bg-white rounded-lg border border-gray-200 shadow-sm">
                                        <!-- Input hidden untuk ID kunjungan yang sudah ada -->
                                        <input type="hidden" name="kunjungan[{{ $index }}][id]"
                                            value="{{ $kunjungan->id ?? '' }}">

                                        <!-- Input hidden untuk dokumen existing -->
                                        @if (isset($kunjungan->dokumen) && $kunjungan->dokumen)
                                            <input type="hidden" name="kunjungan[{{ $index }}][existing_dokumen]"
                                                value="{{ $kunjungan->dokumen }}">
                                        @endif

                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                            <div>
                                                <label class="block text-xs text-gray-500 mb-1">Tanggal</label>
                                                <input type="date" name="kunjungan[{{ $index }}][tanggal]"
                                                class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md"
                                                value="{{ old('kunjungan.' . $index . '.tanggal', $kunjungan->tanggal ?? old('kunjungan.'.$index.'.tanggal', '')) }}"
                                                required>
                                            </div>
                                            <div>
                                                <label class="block text-xs text-gray-500 mb-1">Waktu</label>
                                                <input type="time" name="kunjungan[{{ $index }}][waktu]"
                                                class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md"
                                                value="{{ old('kunjungan.' . $index . '.waktu', $kunjungan->waktu ?? old('kunjungan.'.$index.'.waktu', now()->format('H:i'))) }}"
                                                required>
                                            </div>
                                            <div>
                                                <label class="block text-xs text-gray-500 mb-1">Jenis</label>
                                                <select name="kunjungan[{{ $index }}][jenis]"
                                                class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md"
                                                required>
                                                <option value="rutin"
                                                    {{ old('kunjungan.' . $index . '.jenis', $kunjungan->jenis ?? old('kunjungan.'.$index.'.jenis', '')) == 'rutin' ? 'selected' : '' }}>
                                                    Rutin
                                                </option>
                                                <option value="insidental"
                                                    {{ old('kunjungan.' . $index . '.jenis', $kunjungan->jenis ?? old('kunjungan.'.$index.'.jenis', '')) == 'insidental' ? 'selected' : '' }}>
                                                    Insidental
                                                </option>
                                            </select>
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Kegiatan</label>
                                            <input type="text" name="kunjungan[{{ $index }}][kegiatan]"
                                            class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md"
                                            value="{{ old('kunjungan.' . $index . '.kegiatan', $kunjungan->kegiatan ?? old('kunjungan.'.$index.'.kegiatan', '')) }}"
                                            placeholder="Deskripsi kegiatan" required>
                                        </div>

                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Catatan</label>
                                            <textarea name="kunjungan[{{ $index }}][catatan]" rows="2"
                                            class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md"
                                            placeholder="Catatan tambahan">{{ old('kunjungan.' . $index . '.catatan', $kunjungan->catatan ?? old('kunjungan.'.$index.'.catatan', '')) }}</textarea>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                            <div>
                                                <label class="block text-xs text-gray-500 mb-1">Dokumen Pendukung</label>
                                                <div class="flex items-center">
                                                    <input type="file" name="kunjungan[{{ $index }}][dokumen]"
                                                        class="focus:ring-[#009A44] focus:border-[#009A44] block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#009A44]/10 file:text-[#009A44] hover:file:bg-[#009A44]/20"
                                                        accept=".pdf,.jpg,.jpeg,.png">
                                                </div>

                                                @if (isset($kunjungan->dokumen) && $kunjungan->dokumen)
                                                    <div class="mt-2">
                                                        <a href="{{ asset('storage/' . $kunjungan->dokumen) }}"
                                                            target="_blank"
                                                            class="inline-flex items-center text-sm text-[#00A3AF] hover:text-[#008B9A]">
                                                            <i class="fas fa-file-pdf mr-1"></i> Dokumen Saat Ini
                                                        </a>
                                                        <span class="text-xs text-gray-500 ml-2">(Upload baru akan
                                                            mengganti dokumen ini)</span>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="flex justify-end items-end">
                                                <button type="button"
                                                    class="btn-remove-kunjungan px-3 py-2 bg-red-50 text-red-600 rounded-md hover:bg-red-100 text-sm flex items-center">
                                                    <i class="fas fa-trash mr-1"></i> Hapus Kunjungan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <!-- Default/template untuk kunjungan baru -->
                                <div
                                    class="flex flex-col gap-3 kunjungan-item p-4 bg-white rounded-lg border border-gray-200 shadow-sm">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Tanggal</label>
                                            <input type="date" name="kunjungan[0][tanggal]"
                                                class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md"
                                                required>
                                        </div>
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Waktu</label>
                                            <input type="time" name="kunjungan[0][waktu]"
                                                class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md"
                                                value="{{ now()->format('H:i') }}" required>
                                        </div>
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Jenis</label>
                                            <select name="kunjungan[0][jenis]"
                                                class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md"
                                                required>
                                                <option value="rutin">Rutin</option>
                                                <option value="insidental">Insidental</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1">Kegiatan</label>
                                        <input type="text" name="kunjungan[0][kegiatan]"
                                            class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md"
                                            placeholder="Deskripsi kegiatan" required>
                                    </div>

                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1">Catatan</label>
                                        <textarea name="kunjungan[0][catatan]" rows="2"
                                            class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md"
                                            placeholder="Catatan tambahan"></textarea>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Dokumen Pendukung</label>
                                            <div class="flex items-center">
                                                <input type="file" name="kunjungan[0][dokumen]"
                                                    class="focus:ring-[#009A44] focus:border-[#009A44] block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#009A44]/10 file:text-[#009A44] hover:file:bg-[#009A44]/20"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                            </div>
                                        </div>

                                        <div class="flex justify-end items-end">
                                            <button type="button"
                                                class="btn-remove-kunjungan px-3 py-2 bg-red-50 text-red-600 rounded-md hover:bg-red-100 text-sm flex items-center">
                                                <i class="fas fa-trash mr-1"></i> Hapus Kunjungan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                        <button type="button" id="add-kunjungan"
                            class="mt-3 px-4 py-2 bg-[#00A3AF] text-white rounded-md hover:bg-[#008B9A] text-sm flex items-center">
                            <i class="fas fa-plus-circle mr-2"></i> Tambah Kunjungan
                        </button>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.petugas-uks.index') }}"
                            class="inline-flex justify-center items-center px-6 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#009A44]">
                            <i class="fas fa-times mr-2"></i> Batal
                        </a>
                        <button type="submit"
                            class="inline-flex justify-center items-center px-6 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#009A44] hover:bg-[#00823A] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#009A44]">
                            <i class="fas fa-save mr-2"></i> {{ isset($petugas) ? 'Update' : 'Simpan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Add Jadwal
        document.getElementById("add-jadwal").addEventListener("click", function() {
            const container = document.getElementById("jadwal-container");
            const newIndex = container.querySelectorAll('.jadwal-item').length;

            const newItem = document.createElement("div");
            newItem.className =
                "flex flex-col sm:flex-row gap-3 items-start sm:items-center jadwal-item p-3 bg-gray-50 rounded-lg border border-gray-200";
            newItem.innerHTML = `
                <div class="w-full sm:w-1/4">
                    <label class="block text-xs text-gray-500 mb-1">Hari</label>
                    <select name="jadwal[${newIndex}][hari]"
                        class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md" required>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                    </select>
                </div>

                <div class="w-full sm:w-1/5">
                    <label class="block text-xs text-gray-500 mb-1">Jam Mulai</label>
                    <input type="time" name="jadwal[${newIndex}][jam_mulai]"
                        class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md" required>
                </div>

                <div class="w-full sm:w-1/5">
                    <label class="block text-xs text-gray-500 mb-1">Jam Selesai</label>
                    <input type="time" name="jadwal[${newIndex}][jam_selesai]"
                        class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md" required>
                </div>

                <div class="w-full sm:w-1/4">
                    <label class="block text-xs text-gray-500 mb-1">Ruangan</label>
                    <input type="text" name="jadwal[${newIndex}][ruangan]"
                        class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md"
                        placeholder="Nama ruangan" required>
                </div>

                <div class="w-full sm:w-auto self-end sm:self-center">
                    <button type="button"
                        class="btn-remove-jadwal w-full sm:w-auto px-3 py-2 bg-red-50 text-red-600 rounded-md hover:bg-red-100 text-sm">
                        <i class="fas fa-trash mr-1"></i> Hapus
                    </button>
                </div>
            `;
            container.appendChild(newItem);
        });



        // Add Kunjungan
        document.getElementById("add-kunjungan").addEventListener("click", function() {
            const container = document.getElementById("kunjungan-container");
            const newIndex = container.querySelectorAll('.kunjungan-item').length;

            const newItem = document.createElement("div");
            newItem.className =
                "flex flex-col gap-3 kunjungan-item p-4 bg-white rounded-lg border border-gray-200 shadow-sm";
            newItem.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Tanggal</label>
                        <input type="date" name="kunjungan[${newIndex}][tanggal]"
                            class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md" required>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Waktu</label>
                        <input type="time" name="kunjungan[${newIndex}][waktu]"
                            class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md"
                            value="{{ now()->format('H:i') }}" required>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Jenis</label>
                        <select name="kunjungan[${newIndex}][jenis]"
                            class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md" required>
                            <option value="rutin">Rutin</option>
                            <option value="insidental">Insidental</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs text-gray-500 mb-1">Kegiatan</label>
                    <input type="text" name="kunjungan[${newIndex}][kegiatan]"
                        class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md"
                        placeholder="Deskripsi kegiatan" required>
                </div>

                <div>
                    <label class="block text-xs text-gray-500 mb-1">Catatan</label>
                    <textarea name="kunjungan[${newIndex}][catatan]" rows="2"
                        class="focus:ring-[#009A44] focus:border-[#009A44] block w-full pl-3 pr-10 py-2 text-sm border-gray-300 rounded-md"
                        placeholder="Catatan tambahan"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Dokumen Pendukung</label>
                        <div class="flex items-center">
                            <input type="file" name="kunjungan[${newIndex}][dokumen]"
                                class="focus:ring-[#009A44] focus:border-[#009A44] block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#009A44]/10 file:text-[#009A44] hover:file:bg-[#009A44]/20"
                                accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                    </div>

                    <div class="flex justify-end items-end">
                        <button type="button"
                            class="btn-remove-kunjungan px-3 py-2 bg-red-50 text-red-600 rounded-md hover:bg-red-100 text-sm flex items-center">
                            <i class="fas fa-trash mr-1"></i> Hapus Kunjungan
                        </button>
                    </div>
                </div>
            `;
            container.appendChild(newItem);
        });

        // Remove buttons
        document.addEventListener("click", function(e) {
            if (e.target.classList.contains("btn-remove-jadwal") || e.target.closest(".btn-remove-jadwal")) {
                const btn = e.target.classList.contains("btn-remove-jadwal") ? e.target : e.target.closest(
                    ".btn-remove-jadwal");
                btn.closest(".jadwal-item").remove();
            }

            if (e.target.classList.contains("btn-remove-kunjungan") || e.target.closest(".btn-remove-kunjungan")) {
                const btn = e.target.classList.contains("btn-remove-kunjungan") ? e.target : e.target.closest(
                    ".btn-remove-kunjungan");
                btn.closest(".kunjungan-item").remove();
            }
        });
    </script>

    <style>
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            ring: 2px;
            ring-color: #009A44;
        }

        .border-gray-200 {
            border-color: #e5e7eb;
        }

        .bg-gray-50 {
            background-color: #f9fafb;
        }
    </style>
@endsection
