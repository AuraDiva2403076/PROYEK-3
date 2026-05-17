<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Selamat Datang di Hara Hijab Needs</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
        @endif

        <style>
            body { font-family: 'Instrument Sans', sans-serif; background-color: #FDF7F7; }
        </style>
    </head>
    <body class="text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        
        {{-- HEADER NAVIGATION --}}
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-block px-5 py-1.5 border-[#f48a8a] border text-[#f37b7b] rounded-full text-sm font-medium hover:bg-[#fff2f2] transition">
                            Ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-block px-5 py-1.5 text-gray-600 hover:text-[#f37b7b] text-sm font-medium transition">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-block px-5 py-1.5 bg-[#f37b7b] text-white rounded-full text-sm font-medium hover:bg-[#e26b6b] transition">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        {{-- MAIN HERO CARD --}}
        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow">
            <main class="flex max-w-[335px] w-full flex-col lg:max-w-4xl lg:flex-row bg-white rounded-3xl shadow-xl overflow-hidden dynamic-card">
                
                {{-- LEFT SIDE: INTRO --}}
                <div class="text-[13px] leading-[20px] flex-1 p-8 lg:p-20 flex flex-col justify-center">
                    <h1 class="text-3xl font-bold mb-2 text-[#f37b7b]">Hara.</h1>
                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-6">Hijab Needs & Recommendation System</p>
                    
                    <h2 class="text-xl font-semibold mb-3 text-gray-800">Temukan Warna Hijab Terbaikmu</h2>
                    <p class="mb-6 text-gray-500 leading-relaxed">
                        Selamat datang di panel manajemen Hara Hijab Needs. Masuk untuk mengelola produk, menganalisis data penjualan, melakukan promosi diskon, serta mengelola fitur rekomendasi warna hijab berbasis kecerdasan buatan.
                    </p>

                    <div class="flex gap-4">
                        <a href="{{ route('login') }}" class="px-6 py-2 bg-[#f37b7b] text-white rounded-xl text-center font-medium hover:bg-[#e26b6b] shadow-md transition">
                            Mulai Sekarang
                        </a>
                    </div>
                </div>

                {{-- RIGHT SIDE: DECORATION / IMAGE PLACEHOLDER --}}
                <div class="flex-1 bg-[#fff2f2] p-8 lg:p-20 flex flex-col justify-center items-center text-center relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-[#f48a8a] opacity-20 rounded-full blur-xl"></div>
                    <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-[#f37b7b] opacity-10 rounded-full blur-xl"></div>
                    
                    {{-- Logo / Icon Box --}}
                    <div class="w-20 h-20 bg-white rounded-2xl shadow-md flex items-center justify-center text-3xl mb-4 text-[#f37b7b]">
                        ✨
                    </div>
                    <span class="text-lg font-semibold text-gray-700 mb-1">Smart Recommendation</span>
                    <p class="text-xs text-gray-400 max-w-xs">Menggunakan analisis tone kulit untuk memberikan rekomendasi warna hijab yang paling presisi dan menawan.</p>
                </div>

            </main>
        </div>

    </body>
</html>