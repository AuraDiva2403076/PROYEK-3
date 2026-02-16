<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hara Dashboard')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #FDF7F7; }
        .card-shadow { box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
    </style>
</head>

<body class="flex">

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
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-[#f37b7b] text-[13px]"></i>

                    <form method="GET" action="{{ route('katalog') }}">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari..."
                               class="w-full h-[35px] pl-10 pr-1 text-[12px] bg-white
                                      border border-[#f48a8a] rounded-full
                                      focus:outline-none">
                    </form>
                </div>
            </div>

            {{-- RIGHT MENU --}}
            <div class="flex items-center gap-[15px]">

                {{-- LANGUAGE --}}
                <div class="flex items-center gap-3 bg-white px-4 h-[50px]
                            rounded-2xl shadow-md min-w-[130px]">
                    <img src="https://flagcdn.com/w20/id.png"
                         class="w-[24px] h-[24px] rounded-full object-cover shadow">
                    <span class="font-semibold text-[13px]">ID</span>
                    <i class="fa-solid fa-chevron-down ml-auto text-[#f37b7b] text-[14px]"></i>
                </div>

                {{-- NOTIFICATION --}}
                <div class="text-[#f37b7b] text-[20px] cursor-pointer">
                    <i class="fa-regular fa-bell"></i>
                </div>

                {{-- PROFILE --}}
                <div class="flex items-center gap-3 bg-white px-4 h-[50px]
                            rounded-2xl shadow-md min-w-[150px]">

                    <div class="w-[26px] h-[26px] rounded-full bg-[#f37b7b]
                                text-white flex items-center justify-center
                                text-[13px] font-semibold">
                        Y
                    </div>

                    <div class="leading-tight">
                        <div class="font-semibold text-[12px] pb-1">Yolanda</div>
                        <div class="text-[10px] text-gray-400">Admin</div>
                    </div>

                    <i class="fa-solid fa-chevron-down ml-auto text-[#f37b7b] text-[14px]"></i>
                </div>

            </div>
        </div>

        {{-- PAGE CONTENT --}}
        @yield('content')

    </main>
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
