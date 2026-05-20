@extends('layouts.app')

@section('title', 'Discount')

@section('content')

<div class="bg-white dark:bg-[#1F2937]
            rounded-[25px] p-6 shadow-md
            transition-all duration-300">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">

        <div>

            <h2 class="text-[22px] font-semibold text-[#f37b7b]">
                Data Discount
            </h2>

            <p class="text-gray-400 dark:text-gray-300 text-sm">
                Kelola promo dan discount aplikasi
            </p>

        </div>

        <button onclick="openModal()"
                class="bg-[#f37b7b] hover:bg-[#eb6969]
                       text-white px-5 py-3 rounded-2xl
                       text-sm font-medium transition-all duration-300
                       hover:scale-105">

            + Tambah Discount

        </button>

    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto">

        <table class="w-full">

            <thead>

                <tr class="bg-[#fff1f1] dark:bg-[#374151]
                           text-[#f37b7b]">

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

                <tr class="border-b border-gray-100 dark:border-gray-700
                           hover:bg-pink-50 dark:hover:bg-gray-700
                           transition-all duration-300">

                    {{-- BANNER --}}
                    <td class="p-4">

                        @if($discount->banner)

                        <img src="{{ asset('storage/' . $discount->banner) }}"
                             class="w-[120px] h-[70px]
                                    object-cover rounded-xl shadow-sm">

                        @endif

                    </td>

                    {{-- TITLE --}}
                    <td class="p-4 font-medium
                               text-gray-700 dark:text-white">

                        {{ $discount->title }}

                    </td>

                    {{-- TYPE --}}
                    <td class="p-4 capitalize
                               text-gray-600 dark:text-gray-300">

                        {{ $discount->type }}

                    </td>

                    {{-- DISCOUNT --}}
                    <td class="p-4 text-[#f37b7b] font-semibold">

                        {{ $discount->discount_percent }}%

                    </td>

                    {{-- DATE --}}
                    <td class="p-4 text-sm
                               text-gray-500 dark:text-gray-300">

                        {{ $discount->start_date }}

                        <br>

                        sampai

                        <br>

                        {{ $discount->end_date }}

                    </td>

                    {{-- STATUS --}}
                    <td class="p-4">

                        @if($discount->is_active)

                        <span class="bg-green-100 dark:bg-green-900/30
                                     text-green-600 dark:text-green-400
                                     px-3 py-1 rounded-full text-xs">

                            Aktif

                        </span>

                        @else

                        <span class="bg-red-100 dark:bg-red-900/30
                                     text-red-500 dark:text-red-400
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
                                       text-xs text-center
                                       transition-all duration-300">

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
                                               rounded-xl text-xs w-full
                                               transition-all duration-300">

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
                                               rounded-xl text-xs
                                               transition-all duration-300">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7"
                        class="text-center py-10
                               text-gray-400 dark:text-gray-500">

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
     class="fixed inset-0 bg-black/50 hidden
            items-center justify-center z-50
            backdrop-blur-sm">

    <div class="bg-white dark:bg-[#1F2937]
                w-[700px] rounded-3xl p-6 relative
                transition-all duration-300 shadow-2xl">

        {{-- CLOSE --}}
        <button onclick="closeModal()"
                class="absolute top-5 right-5
                       text-2xl text-gray-400
                       hover:text-red-400 transition-all">

            ×

        </button>

        <h2 class="text-2xl font-semibold
                   text-[#f37b7b] mb-6">

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
                   class="w-full border
                          border-gray-200 dark:border-gray-700
                          bg-white dark:bg-[#374151]
                          text-gray-700 dark:text-white
                          rounded-2xl p-3 focus:outline-none">

            {{-- TYPE --}}
            <select name="type"
                    class="w-full border
                           border-gray-200 dark:border-gray-700
                           bg-white dark:bg-[#374151]
                           text-gray-700 dark:text-white
                           rounded-2xl p-3 focus:outline-none">

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
                   class="w-full border
                          border-gray-200 dark:border-gray-700
                          bg-white dark:bg-[#374151]
                          text-gray-700 dark:text-white
                          rounded-2xl p-3 focus:outline-none">

            {{-- DATE --}}
            <div>

                <label class="text-sm
                              text-gray-500 dark:text-gray-300
                              mb-2 block">

                    Periode Discount

                </label>

                <div class="grid grid-cols-2 gap-4">

                    {{-- MULAI --}}
                    <div>

                        <label class="text-xs
                                      text-gray-400 dark:text-gray-300
                                      mb-1 block">

                            Mulai

                        </label>

                        <input type="date"
                               name="start_date"
                               class="w-full border
                                      border-gray-200 dark:border-gray-700
                                      bg-white dark:bg-[#374151]
                                      text-gray-700 dark:text-white
                                      rounded-2xl p-3 focus:outline-none">

                    </div>

                    {{-- HINGGA --}}
                    <div>

                        <label class="text-xs
                                      text-gray-400 dark:text-gray-300
                                      mb-1 block">

                            Hingga

                        </label>

                        <input type="date"
                               name="end_date"
                               class="w-full border
                                      border-gray-200 dark:border-gray-700
                                      bg-white dark:bg-[#374151]
                                      text-gray-700 dark:text-white
                                      rounded-2xl p-3 focus:outline-none">

                    </div>

                </div>

            </div>

            {{-- BANNER --}}
            <input type="file"
                   name="banner"
                   class="w-full border
                          border-gray-200 dark:border-gray-700
                          bg-white dark:bg-[#374151]
                          text-gray-700 dark:text-white
                          rounded-2xl p-3">

            {{-- BUTTON --}}
            <button type="submit"
                    class="bg-[#f37b7b] hover:bg-[#eb6969]
                           text-white px-4 py-3
                           rounded-xl text-sm font-medium
                           transition-all duration-300
                           hover:scale-105 shadow-md">

                Simpan Discount

            </button>

        </form>

    </div>

</div>

<script>

    /* OPEN MODAL */
    function openModal() {

        document.getElementById('discountModal')
            .classList.remove('hidden');

        document.getElementById('discountModal')
            .classList.add('flex');

        document.querySelector('#discountModal h2')
            .innerText = 'Tambah Discount';

        let form =
            document.querySelector('#discountModal form');

        form.reset();

        form.action =
            "{{ route('discount.store') }}";

        let oldMethod =
            form.querySelector('input[name="_method"]');

        if (oldMethod) {

            oldMethod.remove();

        }
    }

    /* CLOSE MODAL */
    function closeModal() {

        document.getElementById('discountModal')
            .classList.add('hidden');

        document.getElementById('discountModal')
            .classList.remove('flex');
    }

    /* EDIT MODAL */
    function openEditModal(
        id,
        title,
        type,
        discount_percent,
        start_date,
        end_date
    ) {

        document.getElementById('discountModal')
            .classList.remove('hidden');

        document.getElementById('discountModal')
            .classList.add('flex');

        document.querySelector('#discountModal h2')
            .innerText = 'Edit Discount';

        let form =
            document.querySelector('#discountModal form');

        form.action = '/discount/' + id;

        let oldMethod =
            form.querySelector('input[name="_method"]');

        if (oldMethod) {

            oldMethod.remove();

        }

        form.insertAdjacentHTML(
            'beforeend',

            `
            <input type="hidden"
                   name="_method"
                   value="PUT">
            `
        );

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