@extends('layouts.app')

@section('title', 'Discount')

@section('content')

<div class="bg-white rounded-[25px] p-6 shadow-md">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">

        <div>
            <h2 class="text-[22px] font-semibold text-[#f37b7b]">
                Data Discount
            </h2>

            <p class="text-gray-400 text-sm">
                Kelola promo dan discount aplikasi
            </p>
        </div>

        <button onclick="openModal()"
                class="bg-[#f37b7b] hover:bg-[#eb6969]
                       text-white px-5 py-3 rounded-2xl
                       text-sm font-medium transition">

            + Tambah Discount

        </button>

    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto">

        <table class="w-full">

            <thead>

                <tr class="bg-[#fff1f1] text-[#f37b7b]">

                    <th class="p-4 text-left rounded-l-2xl">
                        Banner
                    </th>

                    <th class="p-4 text-left">
                        Promo
                    </th>

                    <th class="p-4 text-left">
                        Tipe
                    </th>

                    <th class="p-4 text-left">
                        Discount
                    </th>

                    <th class="p-4 text-left">
                        Tanggal
                    </th>

                    <th class="p-4 text-left">
                        Status
                    </th>

                    <th class="p-4 text-left rounded-r-2xl">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($discounts as $discount)

                <tr class="border-b border-gray-100">

                    {{-- BANNER --}}
                    <td class="p-4">

                        @if($discount->banner)

                        <img src="{{ asset('storage/' . $discount->banner) }}"
                             class="w-[120px] h-[70px]
                                    object-cover rounded-xl">

                        @endif

                    </td>

                    {{-- TITLE --}}
                    <td class="p-4 font-medium">

                        {{ $discount->title }}

                    </td>

                    {{-- TYPE --}}
                    <td class="p-4 capitalize">

                        {{ $discount->type }}

                    </td>

                    {{-- DISCOUNT --}}
                    <td class="p-4 text-[#f37b7b] font-semibold">

                        {{ $discount->discount_percent }}%

                    </td>

                    {{-- DATE --}}
                    <td class="p-4 text-sm text-gray-500">

                        {{ $discount->start_date }}

                        <br>

                        sampai

                        <br>

                        {{ $discount->end_date }}

                    </td>

                    {{-- STATUS --}}
                    <td class="p-4">

                        @if($discount->is_active)

                        <span class="bg-green-100 text-green-600
                                     px-3 py-1 rounded-full text-xs">

                            Aktif

                        </span>

                        @else

                        <span class="bg-red-100 text-red-500
                                     px-3 py-1 rounded-full text-xs">

                            Nonaktif

                        </span>

                        @endif

                    </td>

                    {{-- ACTION --}}
                    <td class="p-4">

                        <div class="flex flex-col gap-2">

                            {{-- EDIT --}}
                            <button
            onclick="openEditModal(
                '{{ $discount->id }}',
                '{{ $discount->title }}',
                '{{ $discount->type }}',
                '{{ $discount->discount_percent }}',
                '{{ $discount->start_date }}',
                '{{ $discount->end_date }}'
            )"
                                    class="bg-blue-400 hover:bg-blue-500
                                      text-white px-4 py-2 rounded-xl
                                      text-xs text-center">

                                Edit

                                </button>

                            {{-- TOGGLE --}}
                            <form action="{{ route('discount.toggle', $discount->id) }}"
                                  method="POST">

                                @csrf
                                @method('PATCH')

                                <button type="submit"
                                        class="bg-yellow-400 hover:bg-yellow-500
                                               text-white px-4 py-2
                                               rounded-xl text-xs w-full">

                                    @if($discount->is_active)

                                        Nonaktifkan

                                    @else

                                        Aktifkan

                                    @endif

                                </button>

                            </form>

                            {{-- DELETE --}}
                            <form action="{{ route('discount.destroy', $discount->id) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="w-full bg-red-400
                                               hover:bg-red-500
                                               text-white px-4 py-2
                                               rounded-xl text-xs">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7"
                        class="text-center py-10 text-gray-400">

                        Belum ada discount

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

{{-- MODAL --}}
<div id="discountModal"
     class="fixed inset-0 bg-black/40 hidden
            items-center justify-center z-50">

    <div class="bg-white w-[700px] rounded-3xl p-6 relative">

        {{-- CLOSE --}}
        <button onclick="closeModal()"
                class="absolute top-5 right-5 text-2xl text-gray-400">
            ×
        </button>

        <h2 class="text-2xl font-semibold text-[#f37b7b] mb-6">
            Tambah Discount
        </h2>

        <form action="{{ route('discount.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-4">

            @csrf

            {{-- TITLE --}}
            <input type="text"
                   name="title"
                   placeholder="Nama Promo / Event"
                   class="w-full border rounded-2xl p-3">

            {{-- TYPE --}}
            <select name="type"
                    class="w-full border rounded-2xl p-3">

                <option value="product">
                    Discount Produk
                </option>

                <option value="event">
                    Special Event
                </option>

            </select>

            {{-- DISCOUNT --}}
            <input type="number"
                   name="discount_percent"
                   placeholder="Persen Discount"
                   class="w-full border rounded-2xl p-3">

            {{-- DATE --}}
            <div>

                <label class="text-sm text-gray-500 mb-2 block">
                    Periode Discount
                </label>

                <div class="grid grid-cols-2 gap-4">

                    {{-- MULAI --}}
                    <div>

                        <label class="text-xs text-gray-400 mb-1 block">
                            Mulai
                        </label>

                        <input type="date"
                               name="start_date"
                               class="w-full border rounded-2xl p-3">

                    </div>

                    {{-- HINGGA --}}
                    <div>

                        <label class="text-xs text-gray-400 mb-1 block">
                            Hingga
                        </label>

                        <input type="date"
                               name="end_date"
                               class="w-full border rounded-2xl p-3">

                    </div>

                </div>

            </div>

            {{-- BANNER --}}
            <input type="file"
                   name="banner"
                   class="w-full border rounded-2xl p-3">

            {{-- BUTTON --}}
            <button type="submit"
                    class="bg-[#f37b7b] hover:bg-[#eb6969]
                           text-white px-4 py-2
                           rounded-xl text-sm font-medium
                           transition-all duration-300
                           hover:scale-105 shadow-md">

                Simpan Discount

            </button>

        </form>

    </div>

</div>
<script>

    /* =========================
       OPEN MODAL TAMBAH
    ========================= */
    function openModal() {

        // buka modal
        document.getElementById('discountModal')
            .classList.remove('hidden');

        document.getElementById('discountModal')
            .classList.add('flex');

        // reset title
        document.querySelector('#discountModal h2')
            .innerText = 'Tambah Discount';

        // reset form
        let form = document.querySelector('#discountModal form');

        form.reset();

        // action kembali ke store
        form.action = "{{ route('discount.store') }}";

        // hapus _method PUT kalau sebelumnya edit
        let oldMethod = form.querySelector('input[name="_method"]');

        if (oldMethod) {
            oldMethod.remove();
        }
    }


    /* =========================
       CLOSE MODAL
    ========================= */
    function closeModal() {

        document.getElementById('discountModal')
            .classList.add('hidden');

        document.getElementById('discountModal')
            .classList.remove('flex');
    }


    /* =========================
       OPEN EDIT MODAL
    ========================= */
    function openEditModal(
        id,
        title,
        type,
        discount_percent,
        start_date,
        end_date
    ) {

        // buka modal
        document.getElementById('discountModal')
            .classList.remove('hidden');

        document.getElementById('discountModal')
            .classList.add('flex');

        // ubah title
        document.querySelector('#discountModal h2')
            .innerText = 'Edit Discount';

        // ambil form
        let form = document.querySelector('#discountModal form');

        // ubah action ke update
        form.action = '/discount/' + id;

        // hapus method lama kalau ada
        let oldMethod = form.querySelector('input[name="_method"]');

        if (oldMethod) {
            oldMethod.remove();
        }

        // tambahkan method PUT
        form.insertAdjacentHTML(
            'beforeend',
            `
            <input type="hidden"
                   name="_method"
                   value="PUT">
            `
        );

        // isi input
        form.querySelector('input[name="title"]').value
            = title;

        form.querySelector('select[name="type"]').value
            = type;

        form.querySelector('input[name="discount_percent"]').value
            = discount_percent;

        form.querySelector('input[name="start_date"]').value
            = start_date;

        form.querySelector('input[name="end_date"]').value
            = end_date;
    }

</script>
@endsection