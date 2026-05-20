@extends('layouts.app')

@section('title', 'Pengaturan')

@section('content')

<div class="bg-white dark:bg-[#1E293B] p-10 rounded-3xl card-shadow max-w-5xl border border-[#F38B93]/20 transition-all duration-300">

    <h3 class="text-lg font-semibold mb-10 text-gray-800 dark:text-white">
        Pengaturan Umum
    </h3>

    {{-- Tema Sistem --}}
    <div class="flex items-start gap-8 mb-6">
        <label class="w-44 font-semibold text-sm text-gray-700 dark:text-slate-300 pt-2">
            Tema Sistem
        </label>

        <select id="themeSelect"
            class="px-4 py-2 border-2 border-[#F38B93]/30 rounded-xl text-sm
                   bg-white dark:bg-[#0F172A]
                   text-gray-700 dark:text-white
                   focus:outline-none focus:border-[#F38B93]
                   focus:ring-2 focus:ring-[#F38B93]/20
                   transition-all duration-300">

            <option value="light">Terang</option>
            <option value="dark">Gelap</option>

        </select>
    </div>

    {{-- Nama Toko --}}
    <div class="flex items-start gap-8 mb-6">
        <label class="w-44 font-semibold text-sm text-gray-700 dark:text-slate-300 pt-2">
            Nama Toko
        </label>

        <input type="text"
               value="Hara Hijab Needs"
               class="flex-1 px-4 py-2 border-2 border-[#F38B93]/30 rounded-xl text-sm
                      bg-white dark:bg-[#0F172A]
                      text-gray-700 dark:text-white
                      focus:outline-none focus:border-[#F38B93]
                      focus:ring-2 focus:ring-[#F38B93]/20
                      transition-all duration-300">
    </div>

    {{-- Alamat --}}
    <div class="flex items-start gap-8 mb-6">
        <label class="w-44 font-semibold text-sm text-gray-700 dark:text-slate-300 pt-2">
            Alamat
        </label>

        <textarea
            class="flex-1 px-4 py-3 border-2 border-[#F38B93]/30 rounded-xl text-sm h-[120px] resize-none
                   bg-white dark:bg-[#0F172A]
                   text-gray-700 dark:text-white
                   focus:outline-none focus:border-[#F38B93]
                   focus:ring-2 focus:ring-[#F38B93]/20
                   transition-all duration-300">Jend. Sudirman No.221, Indramayu...</textarea>
    </div>

    {{-- Logo --}}
<div class="flex items-start gap-8 mb-8">
    <label class="w-44 font-semibold text-sm text-gray-700 dark:text-slate-300 pt-2">
        Logo
    </label>

    <div class="relative w-[150px] h-[150px] border-2 border-[#F38B93]/40
                rounded-full flex items-center justify-center
                bg-white dark:bg-[#0F172A] shadow-lg
                overflow-visible">

        <img id="preview-logo"
             src="{{ asset('logohara2.png') }}"
             class="w-[80%] h-auto object-contain transition-all duration-300
                    dark:brightness-0 dark:invert">

        <label for="logoUpload"
               class="absolute -bottom-2 -right-2
                      text-white
                      w-10 h-10
                      rounded-full
                      flex items-center justify-center
                      text-sm
                      shadow-lg
                      cursor-pointer
                      hover:scale-110
                      transition-all duration-300
                      border-4 border-white dark:border-[#0F172A]
                      z-20"
               style="background-color:#F38B93;">
            <i class="fa-solid fa-camera"></i>
        </label>

        <input type="file"
               id="logoUpload"
               name="logo"
               accept="image/*"
               class="hidden"
               onchange="previewLogo(event)">
    </div>
</div>
    {{-- Notifikasi --}}
    <div class="flex items-center gap-8 mb-6">
        <label class="w-44 font-semibold text-sm text-gray-700 dark:text-slate-300">
            Notifikasi ke Pengguna
        </label>

        <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" class="sr-only peer" checked>

            <div class="w-16 h-8 bg-gray-200 dark:bg-[#0F172A] border border-[#F38B93]/25 rounded-full peer
                        peer-checked:bg-[#F38B93]
                        after:content-[''] after:absolute after:top-1 after:left-1
                        after:bg-white after:rounded-full
                        after:h-6 after:w-6 after:transition-all
                        peer-checked:after:translate-x-8">
            </div>
        </label>
    </div>

    {{-- Mode Perbaikan --}}
    <div class="flex items-center gap-8 mb-6">
        <label class="w-44 font-semibold text-sm text-gray-700 dark:text-slate-300">
            Mode Perbaikan
        </label>

        <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" class="sr-only peer">

            <div class="w-16 h-8 bg-gray-200 dark:bg-[#0F172A] border border-[#F38B93]/25 rounded-full peer
                        peer-checked:bg-[#F38B93]
                        after:content-[''] after:absolute after:top-1 after:left-1
                        after:bg-white after:rounded-full
                        after:h-6 after:w-6 after:transition-all
                        peer-checked:after:translate-x-8">
            </div>
        </label>
    </div>

    {{-- API KEY --}}
    <div class="flex items-start gap-8 mb-6">
        <label class="w-44 font-semibold text-sm text-gray-700 dark:text-slate-300 pt-2">
            API Key
        </label>

        <input type="text"
               value="AHDU5793hytr0dkks65720103uhdyYHNJhyio;"
               class="flex-1 px-4 py-2 border-2 border-[#F38B93]/30 rounded-xl text-sm
                      bg-white dark:bg-[#0F172A]
                      text-gray-700 dark:text-white
                      focus:outline-none focus:border-[#F38B93]
                      focus:ring-2 focus:ring-[#F38B93]/20
                      transition-all duration-300">
    </div>

    {{-- Link Sosial Media --}}
    <div class="flex items-start gap-8">
        <label class="w-44 font-semibold text-sm text-gray-700 dark:text-slate-300 pt-2">
            Link Sosial Media
        </label>

        <input type="text"
               value="https://harahijabneeds.com"
               class="flex-1 px-4 py-2 border-2 border-[#F38B93]/30 rounded-xl text-sm
                      bg-white dark:bg-[#0F172A]
                      text-gray-700 dark:text-white
                      focus:outline-none focus:border-[#F38B93]
                      focus:ring-2 focus:ring-[#F38B93]/20
                      transition-all duration-300">
    </div>

</div>

@endsection