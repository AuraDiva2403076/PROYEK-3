<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hara Dashboard</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #FDF7F7; }
        .sidebar-active { background: #FF9B9B; color: white !important; border-radius: 12px; }
        .card-shadow { box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
    </style>
</head>
<body class="flex">

    <x-sidebar />

    <main class="flex-1 p-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-pink-400"> @yield('title', 'Dashboard') </h1>
            <div class="flex items-center space-x-4">
                <input type="text" placeholder="Cari..." class="px-4 py-2 border border-pink-100 rounded-full w-96 focus:outline-none focus:ring-2 focus:ring-pink-200">
                <div class="flex items-center space-x-2 bg-white p-2 rounded-lg shadow-sm">
                    <img src="https://flagcdn.com/w20/id.png" width="20" alt="ID">
                    <span class="font-bold">ID</span>
                </div>
                <div class="bg-white p-2 rounded-full shadow-sm text-gray-400">🔔</div>
                <div class="flex items-center space-x-2 bg-white p-1 pr-4 rounded-full shadow-sm">
                    <div class="w-8 h-8 bg-pink-200 rounded-full flex items-center justify-center text-xs">Y</div>
                    <div class="text-[10px]">
                        <p class="font-bold leading-none">Yolanda</p>
                        <p class="text-gray-400">Admin</p>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')
    </main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
