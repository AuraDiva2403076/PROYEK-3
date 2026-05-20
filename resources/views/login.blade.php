<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin - Hara Hijab Needs</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-[#FFF5F5] via-[#FFFBFB] to-[#FCECEC] dark:from-[#0f172a] dark:via-[#111827] dark:to-[#1e293b] min-h-screen flex items-center justify-center p-4 sm:p-6 transition-all duration-300">

    <div class="bg-white/80 dark:bg-slate-900/90 backdrop-blur-md w-full max-w-4xl rounded-3xl shadow-2xl shadow-[#f37b7b]/5 dark:shadow-black/30 border border-white/50 dark:border-slate-700 flex overflow-hidden min-h-[550px] transition-all duration-300">

        {{-- LEFT IMAGE --}}
        <div class="hidden md:block md:w-1/2 relative overflow-hidden">

            <img
                src="{{ asset('images/banner-hara.png') }}"
                alt="Login Visual"
                class="w-full h-full object-cover object-left">

            <div class="absolute inset-0 bg-black/20"></div>

            <div class="absolute bottom-8 left-8 text-white z-10">

                <h2 class="text-3xl font-bold leading-tight">
                    Hara Hijab Needs
                </h2>

                <p class="text-sm text-white/80 mt-2 max-w-xs">
                    Sistem rekomendasi hijab berdasarkan skin tone dengan AI.
                </p>

            </div>

        </div>

        {{-- RIGHT CONTENT --}}
        <div class="w-full md:w-1/2 p-8 sm:p-12 flex flex-col justify-center">

            {{-- MOBILE LOGO --}}
            <div class="md:hidden text-center mb-6">

                <h1 class="text-3xl font-bold tracking-wider text-[#f37b7b]">
                    hara.
                </h1>

            </div>

            {{-- TITLE --}}
            <div class="mb-8">

                <h3 class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-white tracking-tight">
                    Selamat Datang Kembali
                </h3>

                <p class="text-xs sm:text-sm text-gray-400 dark:text-slate-400 mt-1.5">
                    Silakan masukkan akun admin autentik Anda
                </p>

            </div>

            {{-- ERROR --}}
            @if ($errors->any())

                <div class="bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-300 text-xs p-3.5 rounded-xl mb-5 border border-red-100 dark:border-red-500/20 flex items-center space-x-2 animate-pulse">

                    <svg class="w-4 h-4 shrink-0"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>

                    </svg>

                    <span>{{ $errors->first() }}</span>

                </div>

            @endif

            {{-- FORM --}}
            <form action="{{ route('login.submit') }}"
                  method="POST"
                  class="space-y-5">

                @csrf

                {{-- EMAIL --}}
                <div class="space-y-1.5">

                    <label class="block text-xs font-semibold text-gray-600 dark:text-slate-300 uppercase tracking-wider">
                        Email Admin
                    </label>

                    <div class="relative">

                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 dark:text-slate-500">

                            <svg class="w-4 h-4"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"/>

                            </svg>

                        </span>

                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autofocus
                               placeholder="admin@haraneeds.com"
                               class="w-full h-11 pl-10 pr-4 text-xs bg-gray-50/50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl focus:outline-none focus:bg-white dark:focus:bg-slate-800 focus:border-[#f37b7b] focus:ring-4 focus:ring-[#f37b7b]/10 transition-all text-gray-700 dark:text-white placeholder-gray-400 dark:placeholder-slate-500">

                    </div>

                </div>

                {{-- PASSWORD --}}
                <div class="space-y-1.5">

                    <label class="block text-xs font-semibold text-gray-600 dark:text-slate-300 uppercase tracking-wider">
                        Password
                    </label>

                    <div class="relative">

                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400 dark:text-slate-500">

                            <svg class="w-4 h-4"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>

                            </svg>

                        </span>

                        <input type="password"
                               name="password"
                               required
                               placeholder="••••••••"
                               class="w-full h-11 pl-10 pr-4 text-xs bg-gray-50/50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl focus:outline-none focus:bg-white dark:focus:bg-slate-800 focus:border-[#f37b7b] focus:ring-4 focus:ring-[#f37b7b]/10 transition-all text-gray-700 dark:text-white placeholder-gray-400 dark:placeholder-slate-500">

                    </div>

                </div>

                {{-- REMEMBER --}}
                <div class="flex items-center justify-between pt-1">

                    <div class="flex items-center">

                        <input type="checkbox"
                               name="remember"
                               id="remember"
                               class="accent-[#f37b7b] h-3.5 w-3.5 rounded border-gray-300 focus:ring-[#f37b7b]/20 cursor-pointer">

                        <label for="remember"
                               class="text-xs text-gray-500 dark:text-slate-400 ml-2 select-none cursor-pointer hover:text-gray-700 dark:hover:text-white transition-colors">

                            Ingat sesi masuk saya

                        </label>

                    </div>

                </div>

                {{-- BUTTON --}}
                <button type="submit"
                        class="w-full h-11 bg-[#f37b7b] text-white text-xs font-semibold rounded-xl hover:bg-[#e26a6a] shadow-lg shadow-[#f37b7b]/15 hover:shadow-[#f37b7b]/25 transform active:scale-[0.98] transition-all flex items-center justify-center space-x-2 cursor-pointer mt-2">

                    <span>Masuk Ke Dashboard</span>

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M14 5l7 7m0 0l-7 7m7-7H3"/>

                    </svg>

                </button>

            </form>

        </div>

    </div>

    {{-- DARK MODE SYSTEM --}}
    <script>
        if (
            localStorage.getItem('theme') === 'dark' ||
            (
                !localStorage.getItem('theme') &&
                window.matchMedia('(prefers-color-scheme: dark)').matches
            )
        ) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

</body>
</html>