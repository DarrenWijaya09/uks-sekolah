@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <h1
                class="text-3xl font-bold bg-gradient-to-r from-[#009A44] to-[#00A3AF] bg-clip-text text-transparent animate-fade-in">
                Daftar Siswa
            </h1>
            <a href="{{ route('admin.siswa.create') }}"
                class="group bg-gradient-to-r from-[#009A44] to-[#00A3AF] text-white px-6 py-3 rounded-full transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex items-center gap-2 w-full md:w-auto justify-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 group-hover:rotate-90 transition-transform duration-300" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Tambah Siswa
            </a>
        </div>

        <!-- Tambahkan form pencarian setelah tombol Tambah Siswa -->
        <div class="mb-6">
            <form action="{{ route('admin.siswa.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#009A44]/20 focus:border-[#009A44] transition-colors duration-200"
                        placeholder="Cari nama atau kelas...">
                </div>
                <button type="submit"
                    class="bg-[#009A44] text-white px-6 py-2 rounded-lg hover:bg-[#008A34] transition-colors duration-200 w-full md:w-auto">
                    Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.siswa.index') }}"
                        class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors duration-200 text-center w-full md:w-auto">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div
            class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition-shadow duration-300">
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gradient-to-r from-[#F5F5F5] to-[#FFFFFF]">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#4A4A4A] uppercase tracking-wider">
                                Nama</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#4A4A4A] uppercase tracking-wider">
                                Kelas</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#4A4A4A] uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#F5F5F5]">
                        @foreach ($siswa as $data)
                            <tr class="hover:bg-[#F5F5F5] transition-colors duration-200 group">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div
                                        class="text-sm text-[#4A4A4A] font-medium group-hover:text-[#009A44] transition-colors">
                                        {{ $data->nama }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-3 py-1 rounded-full text-sm font-medium bg-[#009A44]/10 text-[#009A44]">{{ $data->kelas }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                    <a href="{{ route('admin.siswa.show', $data->id) }}"
                                        class="inline-flex items-center px-4 py-2 bg-[#009A44]/10 text-[#009A44] rounded-full hover:bg-[#009A44]/20 transition-all duration-200 hover:scale-105">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Lihat
                                    </a>
                                    <a href="{{ route('admin.siswa.edit', $data->id) }}"
                                        class="inline-flex items-center px-4 py-2 bg-[#00A3AF]/10 text-[#00A3AF] rounded-full hover:bg-[#00A3AF]/20 transition-all duration-200 hover:scale-105">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.siswa.destroy', $data->id) }}" method="POST" class="inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-red-50 text-red-700 rounded-full hover:bg-red-100 transition-all duration-200 hover:scale-105">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tambahkan pagination di bawah tabel -->
        <div class="mt-6">
            {{ $siswa->links() }}
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Animate elements on page load
                const elements = document.querySelectorAll('.animate-fade-in');
                elements.forEach((el, index) => {
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(-20px)';

                    setTimeout(() => {
                        el.style.transition = 'all 0.5s ease';
                        el.style.opacity = '1';
                        el.style.transform = 'translateY(0)';
                    }, 100 * index);
                });

                // Table row hover effect
                const rows = document.querySelectorAll('tbody tr');
                rows.forEach(row => {
                    row.addEventListener('mouseenter', () => {
                        row.style.transform = 'translateX(10px)';
                    });
                    row.addEventListener('mouseleave', () => {
                        row.style.transform = 'translateX(0)';
                    });
                });
            });

            // Perbaikan fungsi confirmDelete
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#009A44',
                        cancelButtonColor: '#4A4A4A',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true,
                        customClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                });
            });
        </script>
    @endpush

    @push('styles')
        <style>
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in {
                animation: fadeIn 0.5s ease-out;
            }

            /* Smooth transitions for table rows */
            tbody tr {
                transition: all 0.3s ease;
            }

            /* Responsive adjustments */
            @media (max-width: 768px) {
                .container {
                    padding: 1rem;
                }

                td,
                th {
                    padding: 0.75rem 0.5rem;
                }

                .space-x-2>* {
                    margin: 0.25rem 0;
                }
            }
        </style>
    @endpush
@endsection
