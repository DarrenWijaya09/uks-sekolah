<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sekolah Cinta Kasih Tzu Chi') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .bg-tzuchi-gradient {
                background: linear-gradient(135deg, #009A44 0%, #00A3AF 100%);
            }

            /* Animasi untuk fade in */
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }

            /* Animasi untuk slide in dari kiri */
            @keyframes slideInLeft {
                from { opacity: 0; transform: translateX(-30px); }
                to { opacity: 1; transform: translateX(0); }
            }

            /* Animasi untuk slide in dari kanan */
            @keyframes slideInRight {
                from { opacity: 0; transform: translateX(30px); }
                to { opacity: 1; transform: translateX(0); }
            }

            /* Animasi untuk gradient background */
            @keyframes gradientFlow {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }

            /* Class untuk animasi fade in */
            .animate-fade-in {
                animation: fadeIn 0.8s ease-out forwards;
            }

            /* Class untuk animasi slide dari kiri */
            .animate-slide-left {
                animation: slideInLeft 0.8s ease-out forwards;
            }

            /* Class untuk animasi slide dari kanan */
            .animate-slide-right {
                animation: slideInRight 0.8s ease-out forwards;
            }

            /* Class untuk animasi gradient */
            .animate-gradient {
                background-size: 200% 200%;
                animation: gradientFlow 15s ease infinite;
            }

            /* Animasi untuk card content */
            .card-entrance {
                opacity: 0;
                transform: translateY(20px);
                animation: fadeIn 0.8s ease-out forwards;
                animation-delay: 0.3s;
            }

            /* Efek hover untuk logo */
            .logo-hover {
                transition: all 0.3s ease;
            }

            .logo-hover:hover {
                transform: translateY(-5px);
                filter: brightness(1.1);
            }

            /* Efek hover untuk text */
            .text-hover {
                transition: all 0.3s ease;
            }

            .text-hover:hover {
                letter-spacing: 0.5px;
                text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            }
        </style>
    </head>
    <body class="font-[Poppins] antialiased">
        <div class="min-h-screen flex">
            <!-- Left Side - Branding -->
            <div class="hidden lg:flex lg:w-1/2 bg-tzuchi-gradient animate-gradient">
                <div class="w-full flex flex-col items-center justify-center px-12">
                    <div class="text-center">
                        <!-- Logo dengan animasi baru -->
                        <img src="{{ asset('assets/image/tzu-chi.png') }}"
                             alt="Tzu Chi Logo"
                             class="max-w-sm mx-auto mb-10 animate-fade-in logo-hover">
                        <h1 class="text-4xl font-bold text-white mb-4 animate-slide-left text-hover">
                            Sekolah Cinta Kasih Tzu Chi
                        </h1>
                        <p class="text-white/90 text-xl animate-slide-right text-hover">
                            Pendidikan yang Mengembangkan Potensi dengan Cinta Kasih
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Side - Form -->
            <div class="w-full lg:w-1/2 bg-gray-50">
                <div class="flex min-h-screen flex-col justify-center px-6 py-12 lg:px-8">
                    <div class="sm:mx-auto sm:w-full sm:max-w-md">
                        <!-- Mobile Logo -->
                        <div class="lg:hidden text-center mb-10 animate-fade-in">
                            <img src="{{ asset('assets/image/tzu-chi.png') }}"
                                 alt="Tzu Chi Logo"
                                 class="max-w-[200px] mx-auto logo-hover">
                            <h2 class="mt-5 text-2xl font-bold text-[#009A44] text-hover">
                                Sekolah Cinta Kasih Tzu Chi
                            </h2>
                        </div>

                        <!-- Main Content -->
                        <div class="bg-white py-8 px-4 shadow-md rounded-xl sm:px-10 card-entrance hover:shadow-lg transition-shadow duration-300">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
