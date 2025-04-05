@extends('layouts.admin')
@section('content')
    <div class="container mx-auto p-6 bg-[#F5F5F5] min-h-screen">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div class="mb-4 md:mb-0">
                <h1 class="text-2xl font-bold text-[#009A44]">Jadwal Kegiatan UKS</h1>
                <p class="text-[#4A4A4A] mt-2">Manajemen Kalender Kegiatan Kesehatan Sekolah</p>
            </div>
            <a href="{{ route('admin.jadwal-uks.create') }}"
                class="bg-[#00A3AF] hover:bg-[#00818C] text-white px-6 py-2 rounded-lg transition-colors flex items-center">
                <i class="fas fa-plus mr-2"></i>Tambah Jadwal
            </a>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Upcoming Events -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-[#009A44]">
                    <div class="flex items-center mb-4">
                        <div class="bg-[#009A44] p-2 rounded-full mr-3">
                            <i class="fas fa-bell text-white text-lg"></i>
                        </div>
                        <h2 class="text-lg font-semibold text-[#4A4A4A]">Acara Mendatang</h2>
                    </div>

                    <div class="max-h-80 overflow-y-auto space-y-4 border border-[#ddd] p-4 rounded-lg">
                        @forelse($upcomingEvents as $event)
                            <div class="bg-[#F5F5F5] p-4 rounded-lg hover:bg-[#E0EAEF] transition-colors">
                                <div>
                                    <h3 class="font-medium text-[#009A44]">{{ $event->kegiatan }}</h3>
                                    <p class="text-sm text-[#4A4A4A] mt-1">
                                        <i class="fas fa-clock text-[#00A3AF] mr-2"></i>
                                        {{ \Carbon\Carbon::parse($event->waktu)->format('d M Y H:i') }}
                                    </p>
                                    <p class="text-sm text-[#4A4A4A] mt-1">
                                        <i class="fas fa-info-circle text-[#00A3AF] mr-2"></i>
                                        {{ Str::limit($event->deskripsi, 40) }}
                                    </p>
                                </div>
                                <!-- Tombol Edit di sebelah kiri bawah -->
                                <div class="mt-4 flex justify-start space-x-2">
                                    <a href="{{ route('admin.jadwal-uks.edit', $event->id) }}"
                                        class="text-[#00A3AF] hover:text-[#009A44] flex items-center">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('admin.jadwal-uks.edit', $event->id) }}"
                                        class="bg-[#00A3AF] text-white px-3 py-1 rounded-lg text-sm hover:bg-[#009A44] transition">
                                        Edit
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center p-4">
                                <div class="text-[#00A3AF] text-4xl mb-2">
                                    <i class="fas fa-calendar-times"></i>
                                </div>
                                <p class="text-[#4A4A4A]">Tidak ada acara mendatang</p>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>

            <!-- Calendar Section -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-6 border-t-4 border-[#00A3AF]">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- FullCalendar Styles -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <style>
        .fc {
            font-family: 'Poppins', sans-serif;
        }

        .fc-toolbar-title {
            color: #009A44;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .fc-button-primary {
            background-color: #00A3AF !important;
            border-color: #00A3AF !important;
            transition: all 0.3s ease;
        }

        .fc-button-primary:hover {
            background-color: #00818C !important;
            border-color: #00818C !important;
        }

        .fc-event {
            border-radius: 4px;
            padding: 2px 5px;
            margin: 2px 0;
            cursor: pointer;
        }

        .event-titles {
            white-space: normal;
            line-height: 1.2;
            word-break: break-word;
            max-width: 95%;
            font-size: 0.75rem;
            padding: 2px;
        }

        .event-dot-container {
            position: relative;
            margin-top: 2px;
        }

        .fc-daygrid-day-top {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .future-event .event-dot {
            background: #00A3AF;
        }

        .past-event .event-dot {
            background: #009A44;
            opacity: 0.5;
        }

        .fc-day-today {
            background: none !important;
            box-shadow: none !important;
        }
    </style>

    <!-- FullCalendar Scripts -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.15/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/web-component@6.1.15/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.15/index.global.min.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let calendar = null;

            function initCalendar() {
                const calendarEl = document.getElementById('calendar');

                if (!calendarEl) {
                    console.error("Elemen kalender tidak ditemukan!");
                    return;
                }

                if (calendar) {
                    calendar.destroy(); // Hancurkan instance lama sebelum membuat baru
                }

                calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,dayGridWeek,dayGridDay'
                    },
                    events: {
                        url: "{{ route('admin.jadwal-uks.events') }}",
                        extraParams: {
                            nocache: new Date().getTime()
                        },
                        failure: function() {
                            console.error("Gagal mengambil data jadwal UKS!");
                        }
                    },

                    eventDidMount: function(info) {
                        // console.log("Event Data:", info.event); // Debugging event

                        setTimeout(() => {
                            if (typeof tippy !==
                                "undefined") { // Pastikan Tippy.js sudah dimuat
                                tippy(info.el, {
                                    content: `
                                <div class="p-2 max-w-xs text-white">
                                    <h4 class="font-semibold text-[#FFFFFF]">${info.event.title}</h4>
                                    <p class="text-sm text-[#FFFFFF] mt-1">
                                        <i class="fas fa-clock mr-2"></i>${info.event.extendedProps.waktu}
                                    </p>
                                    <p class="text-sm text-[#FFFFFF] mt-2">${info.event.extendedProps.deskripsi}</p>
                                </div>
                            `,
                                    allowHTML: true,
                                    theme: 'light',
                                    placement: 'top',
                                    interactive: true
                                });
                            } else {
                                console.error("Tippy.js belum dimuat!");
                            }
                        }, 300); // Tunggu 300ms untuk memastikan elemen dirender
                    },

                    dayCellContent: function(info) {
                        const currentDate = info.date.toISOString().split('T')[0]; // Format YYYY-MM-DD
                        const events = calendar.getEvents();

                        // Filter event berdasarkan tanggal (tanpa waktu)
                        const filteredEvents = events.filter(event => {
                            return event.start.toISOString().split('T')[0] === currentDate;
                        });

                        return {
                            html: `
                        <div class="fc-daygrid-day-top">
                            <div class="fc-daygrid-day-number">${info.dayNumberText}</div>
                            ${filteredEvents.length > 0 ? `
                                            <div class="event-dot-container">
                                                <div class="event-dot"></div>
                                            </div>
                                        ` : ''}
                        </div>
                    `
                        };
                    },
                    datesSet: function(info) {
                        calendar.removeAllEvents(); // Hapus semua event sebelum mengambil yang baru
                        calendar.refetchEvents(); // Ambil ulang event dari server

                        setTimeout(() => calendar.updateSize(), 100);
                    }
                });

                calendar.render();
            }

            // Pastikan Tippy.js sudah siap sebelum initCalendar() dipanggil
            function loadTippyAndInit() {
                if (typeof tippy === "undefined") {
                    console.error("Tippy.js belum dimuat, menunggu...");
                    setTimeout(loadTippyAndInit, 200); // Coba lagi setelah 200ms
                } else {
                    console.log("Tippy.js siap, memulai kalender...");
                    initCalendar();
                }
            }

            loadTippyAndInit();
            document.addEventListener('turbo:load', loadTippyAndInit);
        });
    </script>
@endsection
