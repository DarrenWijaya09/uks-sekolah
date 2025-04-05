@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div class="flex items-center gap-4">
                <select id="kategori" name="kategori" class="rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    <option value="">Semua Kategori</option>
                    <option value="obat" {{ request('kategori') == 'obat' ? 'selected' : '' }}>Obat</option>
                    <option value="alkes" {{ request('kategori') == 'alkes' ? 'selected' : '' }}>Alat Kesehatan</option>
                </select>

                <select id="stok_filter" name="stok_filter" class="rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    <option value="">Semua Stok</option>
                    <option value="low">Stok Menipis</option>
                    <option value="empty">Stok Habis</option>
                </select>
            </div>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-[#009A44] to-[#00A3AF] bg-clip-text text-transparent animate-fade-in">
                Daftar Obat
            </h1>
            <div class="flex gap-4">
                <a href="{{ route('admin.penggunaan-obat.riwayat') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Riwayat Penggunaan
                </a>

                <a href="{{ route('admin.obat.create') }}"
                    class="group bg-gradient-to-r from-[#009A44] to-[#00A3AF] text-white px-4 py-2 rounded-lg hover:shadow-lg flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Tambah Obat/Alkes
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700">Total Stok</h3>
                        <p class="text-2xl font-bold text-gray-900">{{ $obats->sum('stok') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700">Stok Menipis</h3>
                        <p class="text-2xl font-bold text-gray-900">{{ $lowStock->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-700">Penggunaan Hari Ini</h3>
                        <p class="text-2xl font-bold text-gray-900">{{ $penggunaanHariIni ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if ($lowStock->count())
            <div class="mb-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3 flex-grow">
                        <h3 class="text-sm font-medium text-yellow-800">Peringatan Stok Rendah:</h3>
                        <div class="mt-2 text-sm text-yellow-700">
                            <ul class="list-disc list-inside space-y-2">
                                @foreach ($lowStock as $obat)
                                    <li class="flex items-center justify-between p-2 hover:bg-yellow-100 rounded-lg">
                                        <div class="flex items-center space-x-2">
                                            <span class="font-medium">{{ $obat->nama_obat }}</span>
                                            <span class="text-yellow-600">({{ ucfirst($obat->kategori) }})</span>
                                            <span class="px-2 py-1 bg-yellow-200 text-yellow-800 rounded-full text-xs">
                                                Stok: {{ $obat->stok }}
                                            </span>
                                        </div>
                                        <a href="{{ route('admin.obat.edit', $obat->id) }}"
                                           class="inline-flex items-center px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            Update Stok
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gradient-to-r from-[#F5F5F5] to-[#FFFFFF]">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#4A4A4A]">Nama</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#4A4A4A]">Kategori</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#4A4A4A]">Stok</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#4A4A4A]">Stok Minimum</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#4A4A4A]">Kadaluarsa</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#4A4A4A]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($obats as $obat)
                            <tr class="hover:bg-gray-50 {{ $obat->isLowStock() ? 'bg-yellow-50' : '' }}">
                                <td class="px-6 py-4">{{ $obat->nama_obat }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-sm font-medium
                                        {{ $obat->kategori == 'obat' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                        {{ ucfirst($obat->kategori) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-sm font-medium
                                        {{ $obat->isLowStock() ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                        {{ $obat->stok }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ $obat->stok_minimum }}</td>
                                <td class="px-6 py-4">
                                    {{ $obat->tanggal_kadaluarsa ? \Carbon\Carbon::parse($obat->tanggal_kadaluarsa)->format('d/m/Y') : '-' }}
                                </td>
                                <td class="px-6 py-4 space-x-2">
                                    <a href="{{ route('admin.penggunaan-obat.create', ['obat_id' => $obat->id]) }}"
                                        class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-full hover:bg-blue-200">
                                        Catat Penggunaan
                                    </a>
                                    <a href="{{ route('admin.obat.edit', $obat->id) }}"
                                        class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 rounded-full hover:bg-green-200">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 bg-white border-t border-gray-200">
                {{ $obats->links() }}
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('kategori').addEventListener('change', function() {
            window.location.href = '{{ route("admin.obat.index") }}?kategori=' + this.value;
        });

        document.getElementById('stok_filter').addEventListener('change', function() {
            window.location.href = '{{ route("admin.obat.index") }}?stok_filter=' + this.value;
        });
    </script>
    @endpush

    @push('styles')
        <style>
            /* ... existing styles ... */
        </style>
    @endpush
@endsection
