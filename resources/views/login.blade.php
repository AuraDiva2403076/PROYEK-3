<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Hara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; background-color: #FDF7F7; }</style>
</head>
<body class="h-screen flex items-center justify-center p-4">

    <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-[28px] font-bold text-[#f37b7b]">hara.</h1>
            <p class="text-xs text-gray-400 mt-1">Gunakan akun admin untuk masuk ke dashboard</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-500 text-xs p-3 rounded-xl mb-4 border border-red-200">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-[11px] font-semibold text-gray-600 mb-1">Email Admin</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full h-[40px] px-3 text-[12px] bg-white border border-gray-200 rounded-xl focus:outline-none focus:border-[#f37b7b] transition-all">
            </div>

            <div>
                <label class="block text-[11px] font-semibold text-gray-600 mb-1">Password</label>
                <input type="password" name="password" required
                       class="w-full h-[40px] px-3 text-[12px] bg-white border border-gray-200 rounded-xl focus:outline-none focus:border-[#f37b7b] transition-all">
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="accent-[#f37b7b] h-3 w-3">
                <label Akses untuk="remember" class="text-[11px] text-gray-500 ml-2 select-none cursor-pointer">Ingat saya di perangkat ini</label>
            </div>

            <button type="submit" 
                    class="w-full h-[40px] bg-[#f37b7b] text-white text-[13px] font-medium rounded-xl hover:bg-[#e26a6a] shadow-lg shadow-[#f37b7b]/10 transition-colors pt-1">
                Masuk ke Dashboard
            </button>
        </form>
    </div>

</body>
</html>