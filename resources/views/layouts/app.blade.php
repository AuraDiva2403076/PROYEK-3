<!DOCTYPE html>
<html lang="id" class="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hara Dashboard')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>

    <script src="https://unpkg.com/lucide@latest"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #FDF7F7;
            transition: all .3s ease;
        }

        .dark body {
            background-color: #111827;
            color: white;
        }

        .card-shadow {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body class="flex transition-all duration-300"
    x-data="{ openDropdown: false, openModal: false }">

    {{-- SIDEBAR --}}
    <x-sidebar />

    {{-- MAIN CONTENT --}}
    <main class="flex-1 p-8">

        {{-- HEADER --}}
        <div class="w-full grid grid-cols-[auto_1fr_auto] items-center mb-8">

            {{-- TITLE --}}
            <div>
                <h1 class="text-[24px] font-semibold text-[#f37b7b]">
                    @yield('title', 'Dashboard')
                </h1>
            </div>

            {{-- SEARCH --}}
            <div class="flex justify-center">
                <div class="relative w-[420px] max-w-full">

                    <i
                        class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-[#f37b7b] text-[13px]"></i>

                    <form method="GET" action="{{ route('search') }}">

                        <input type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari..."
                            class="w-full h-[35px] pl-10 pr-1 text-[12px]
                                   bg-white dark:bg-gray-800
                                   text-black dark:text-white
                                   border border-[#f48a8a]
                                   rounded-full
                                   focus:outline-none">

                    </form>
                </div>
            </div>

            {{-- RIGHT MENU --}}
            <div class="flex items-center gap-[15px]">

                {{-- LANGUAGE --}}
                <div
                    class="flex items-center gap-3 bg-white dark:bg-gray-800 px-4 h-[50px]
                           rounded-2xl shadow-md min-w-[130px]">

                    <img src="https://flagcdn.com/w20/id.png"
                        class="w-[24px] h-[24px] rounded-full object-cover shadow">

                    <span class="font-semibold text-[13px] dark:text-white">
                        ID
                    </span>

                    <i
                        class="fa-solid fa-chevron-down ml-auto text-[#f37b7b] text-[14px]"></i>

                </div>

                {{-- NOTIFICATION --}}
                <div class="text-[#f37b7b] text-[20px] cursor-pointer">
                    <i class="fa-regular fa-bell"></i>
                </div>

                {{-- PROFILE WRAPPER --}}
                <div class="relative">

                    <div @click="openDropdown = !openDropdown"
                        @click.away="openDropdown = false"
                        class="flex items-center gap-3
                               bg-white dark:bg-gray-800
                               px-4 h-[50px]
                               rounded-2xl shadow-md min-w-[150px]
                               cursor-pointer hover:bg-gray-50
                               dark:hover:bg-gray-700
                               transition-all select-none">

                        <div
                            class="w-[26px] h-[26px] rounded-full bg-[#f37b7b]
                                   text-white flex items-center justify-center
                                   text-[13px] font-semibold overflow-hidden">

                            @if(auth()->guard('admin')->check() && auth()->guard('admin')->user()->avatar)

                                <img src="{{ asset('storage/' . auth()->guard('admin')->user()->avatar) }}"
                                    class="w-full h-full object-cover">

                            @else

                                {{ auth()->guard('admin')->check() ? strtoupper(substr(auth()->guard('admin')->user()->name, 0, 1)) : 'Y' }}

                            @endif

                        </div>

                        <div class="leading-tight">

                            <div class="font-semibold text-[12px] pb-1 dark:text-white">

                                {{ auth()->guard('admin')->check() ? auth()->guard('admin')->user()->name : 'Yolanda' }}

                            </div>

                            <div class="text-[10px] text-gray-400">
                                Admin
                            </div>

                        </div>

                        <i
                            class="fa-solid fa-chevron-down ml-auto text-[#f37b7b]
                                   text-[14px] transform transition-transform duration-200"
                            :class="openDropdown ? 'rotate-180' : ''"></i>

                    </div>

                    {{-- DROPDOWN --}}
                    <div x-show="openDropdown"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-48
                               bg-white dark:bg-gray-800
                               rounded-xl shadow-lg py-2 z-50
                               border border-gray-100 dark:border-gray-700"
                        style="display: none;">

                        <button
                            @click="openModal = true; openDropdown = false"
                            class="w-full text-left px-4 py-2 text-[12px]
                                   font-medium text-gray-700 dark:text-gray-200
                                   hover:bg-[#FDF7F7]
                                   dark:hover:bg-gray-700
                                   hover:text-[#f37b7b]
                                   flex items-center gap-2 transition-colors">

                            <i class="fa-solid fa-user-gear text-[13px]"></i>

                            Settings Profile

                        </button>

                        <hr class="border-gray-100 dark:border-gray-700 my-1">

                        <form action="{{ route('logout') }}" method="POST">

                            @csrf

                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-[12px]
                                       font-medium text-red-500
                                       hover:bg-red-50 dark:hover:bg-red-900/20
                                       flex items-center gap-2 transition-colors">

                                <i class="fa-solid fa-right-from-bracket text-[13px]"></i>

                                Logout

                            </button>

                        </form>

                    </div>

                </div>

            </div>
        </div>

        {{-- PAGE CONTENT --}}
        @yield('content')

    </main>

    {{-- MODAL --}}
    <div x-show="openModal"
        class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center"
        style="display: none;">

        <div class="fixed inset-0 bg-black/30 backdrop-blur-sm"
            @click="openModal = false"></div>

        <div
            class="bg-white dark:bg-gray-800
                   rounded-2xl w-full max-w-md mx-4 p-6
                   shadow-2xl z-10
                   border border-gray-100 dark:border-gray-700">

            <div class="flex justify-between items-center mb-5">

                <h3 class="text-[16px] font-semibold text-[#f37b7b]">
                    Update Profil Admin
                </h3>

                <button @click="openModal = false"
                    class="text-gray-400 hover:text-gray-600 transition-colors">

                    <i class="fa-solid fa-xmark text-[18px]"></i>

                </button>

            </div>

            {{-- FORM --}}
            <form action="{{ route('admin.profile.update') }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-4">

                @csrf
                @method('PUT')

                {{-- FORM CONTENT --}}
                {{-- BIARKAN SAMA PUNYA KAMU --}}
                {{-- TIDAK PERLU DIUBAH --}}

            </form>

        </div>
    </div>

    {{-- SUCCESS ALERT --}}
    @if(session('success'))

        <div x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 4000)"
            class="fixed bottom-5 right-5 z-50
                   bg-emerald-500 text-white
                   px-4 py-3 rounded-xl shadow-lg
                   flex items-center gap-3 transition-all
                   text-[12px] font-medium">

            <i class="fa-solid fa-circle-check text-[15px]"></i>

            <span>{{ session('success') }}</span>

        </div>

    @endif

    <script src="//unpkg.com/alpinejs" defer></script>

    {{-- DARK MODE SCRIPT --}}
    <script>

        const savedTheme = localStorage.getItem('theme');

        if (savedTheme === 'dark') {
            document.documentElement.classList.add('dark');
        }

        document.addEventListener('DOMContentLoaded', () => {

            const themeSelect = document.getElementById('themeSelect');

            if (themeSelect) {

                themeSelect.value = savedTheme || 'light';

                themeSelect.addEventListener('change', function () {

                    if (this.value === 'dark') {

                        document.documentElement.classList.add('dark');

                        localStorage.setItem('theme', 'dark');

                    } else {

                        document.documentElement.classList.remove('dark');

                        localStorage.setItem('theme', 'light');

                    }
                });
            }
        });

        function previewImage(event) {

            const reader = new FileReader();

            reader.onload = function () {

                let output = document.getElementById('preview-avatar');

                if (!output) {

                    const placeholder =
                        document.getElementById('placeholder-avatar');

                    if (placeholder) {

                        output = document.createElement('img');

                        output.id = 'preview-avatar';

                        output.className =
                            'w-full h-full object-cover';

                        placeholder.parentNode.replaceChild(
                            output,
                            placeholder
                        );
                    }
                }

                output.src = reader.result;
            };

            reader.readAsDataURL(event.target.files[0]);
        }

    </script>

</body>
</html>