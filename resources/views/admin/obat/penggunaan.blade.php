@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <!-- Header -->
            <div class="px-8 py-5 bg-gradient-to-r from-blue-600 to-blue-500">
                <h2 class="text-2xl font-bold text-white">
                    Catat Penggunaan Obat
                </h2>
                <p class="mt-1 text-blue-100">Silakan isi form penggunaan obat dengan lengkap</p>
            </div>

            <!-- Form Content -->
            <div class="px-8 py-8">
                <form action="{{ route('admin.penggunaan-obat.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Siswa -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="siswa_id" class="block text-sm font-medium text-gray-700 mb-1">Siswa</label>
                            <select name="siswa_id" id="siswa_id" required
                                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Pilih Siswa</option>
                                @foreach ($siswas as $siswa)
                                    <option value="{{ $siswa->id }}">{{ $siswa->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Obat -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="obat_id" class="block text-sm font-medium text-gray-700 mb-1">Obat/Alkes</label>
                            <select name="obat_id" id="obat_id" required
                                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Pilih Obat/Alkes</option>
                                @foreach ($obats as $obat)
                                    <option value="{{ $obat->id }}" {{ request('obat_id') == $obat->id ? 'selected' : '' }}>
                                        {{ $obat->nama_obat }} (Stok: {{ $obat->stok }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Jumlah Digunakan -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="jumlah" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Digunakan</label>
                            <input type="number" name="jumlah" id="jumlah" required min="1"
                                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Masukkan jumlah yang digunakan">
                        </div>

                        <!-- Tanggal Penggunaan -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="tanggal_penggunaan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Penggunaan</label>
                            <input type="date" name="tanggal_penggunaan" id="tanggal_penggunaan" required
                                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                value="{{ date('Y-m-d') }}">
                        </div>

                        <!-- Keterangan -->
                        <div class="col-span-2">
                            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan Penggunaan</label>
                            <textarea name="keterangan" id="keterangan" rows="3"
                                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Masukkan keterangan penggunaan obat/alkes"></textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="col-span-2 flex items-center space-x-4 pt-4">
                            <button type="submit"
                                class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200 ease-in-out transform hover:scale-[1.02]">
                                Simpan
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

@push('scripts')
<script>
    // Validasi stok saat input jumlah
    document.getElementById('obat_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const stok = parseInt(selectedOption.text.match(/Stok: (\d+)/)[1]);
        const jumlahInput = document.getElementById('jumlah');
        jumlahInput.max = stok;
    });

    document.getElementById('jumlah').addEventListener('input', function() {
        const selectedOption = document.getElementById('obat_id').options[document.getElementById('obat_id').selectedIndex];
        const stok = parseInt(selectedOption.text.match(/Stok: (\d+)/)[1]);
        if (this.value > stok) {
            alert('Jumlah yang dimasukkan melebihi stok yang tersedia!');
            this.value = stok;
        }
    });
</script>
@endpush
@endsection
