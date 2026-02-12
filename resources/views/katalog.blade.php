@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')
<div class="space-y-6">

    <!-- ================= HEADER ================= -->
    <div class="flex justify-between items-center">

        <!-- KIRI -->
        <div class="flex gap-3 relative">

            <!-- ADD -->
            <button onclick="openModal()" 
                class="bg-pink-400 text-white px-4 py-2 rounded-xl text-sm">
                + Add Produk
            </button>

            <!-- FILTER -->
            <button onclick="toggleFilter()" 
                class="border border-pink-400 text-pink-500 px-4 py-2 rounded-xl text-sm">
                Filter
            </button>

            <!-- DROPDOWN FILTER -->
            <div id="filterDropdown" 
                class="hidden absolute top-12 left-0 bg-white shadow-xl rounded-2xl p-4 w-64 z-40">

                <form method="GET" action="{{ route('katalog') }}" class="space-y-3">

                    <div>
                        <label class="text-xs text-gray-500">Kategori</label>
                        <select name="kategori"
                            class="w-full border border-pink-300 rounded-xl p-2 text-sm">
                            <option value="">Semua</option>
                            <option value="Pashmina">Pashmina</option>
                            <option value="Segi Empat">Segi Empat</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-xs text-gray-500">Ukuran</label>
                        <select name="ukuran"
                            class="w-full border border-pink-300 rounded-xl p-2 text-sm">
                            <option value="">Semua</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                        </select>
                    </div>

                    <button type="submit"
                        class="bg-pink-400 text-white w-full py-2 rounded-xl text-sm">
                        Terapkan
                    </button>
                </form>
            </div>

        </div>
    </div>


    <!-- ================= MODAL ================= -->
    <div id="modalProduk" 
        class="fixed inset-0 bg-black bg-opacity-40 hidden justify-center items-center z-50">

        <div class="bg-white w-[900px] rounded-2xl p-8 relative">

            <h2 class="text-xl font-bold mb-6">Tambah / Edit Produk</h2>

            @include('produk.tambah_produk')

            <button onclick="closeModal()" 
                class="absolute top-4 right-4 text-gray-500 text-xl">
                ✕
            </button>
        </div>
    </div>


    <!-- ================= TABLE ================= -->
    <div class="bg-white rounded-3xl p-6 shadow overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead>
                <tr class="border-b text-gray-500">
                    <th class="py-3">Kode</th>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Ukuran</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Warna</th>
                    <th>Stok</th>
                    <th>Deskripsi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($produks as $produk)
                <tr class="hover:bg-gray-50">
                    <td>{{ $produk->kode_produk }}</td>

                    <td>
                        @if($produk->gambar)
                            <img src="{{ asset('storage/'.$produk->gambar) }}" 
                                class="w-10 h-10 rounded-full object-cover">
                        @else
                            <div class="w-10 h-10 bg-gray-200 rounded-full"></div>
                        @endif
                    </td>

                    <td>{{ $produk->nama_produk }}</td>
                    <td>{{ $produk->ukuran }}</td>
                    <td>{{ $produk->kategori }}</td>
                    <td>Rp{{ number_format($produk->harga) }}</td>
                    <td>{{ $produk->warna }}</td>
                    <td>{{ $produk->stok }}</td>
                    <td class="truncate max-w-[150px]">
                        {{ $produk->deskripsi }}
                    </td>

                    <td class="text-center space-x-2">

                        <!-- EDIT -->
                        <button 
                            onclick="editProduk(
                                '{{ $produk->id }}',
                                '{{ $produk->kode_produk }}',
                                '{{ $produk->nama_produk }}',
                                '{{ $produk->ukuran }}',
                                '{{ $produk->kategori }}',
                                '{{ $produk->stok }}',
                                '{{ $produk->warna }}',
                                '{{ $produk->harga }}',
                                `{{ $produk->deskripsi }}`
                            )"
                            class="bg-yellow-400 text-white px-3 py-1 rounded-lg text-xs">
                            Edit
                        </button>

                        <!-- DELETE -->
                        <form action="{{ route('produk.destroy', $produk->id) }}" 
                            method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus produk?')" 
                                class="bg-red-500 text-white px-3 py-1 rounded-lg text-xs">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center py-6 text-gray-400">
                        Belum ada produk
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-6">
            {{ $produks->links() }}
        </div>
    </div>
</div>


<!-- ================= SCRIPT ================= -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("formProduk");

    window.openModal = function () {
        form.reset();
        delete form.dataset.editId;
        document.getElementById("previewImage").src = "{{ asset('images/grup.jpg') }}";
        document.getElementById("modalProduk").classList.remove("hidden");
        document.getElementById("modalProduk").classList.add("flex");
    }

    window.closeModal = function () {
        document.getElementById("modalProduk").classList.add("hidden");
    }

    window.toggleFilter = function(){
        document.getElementById("filterDropdown").classList.toggle("hidden");
    }

    document.addEventListener("change", function (e) {
        if (e.target.id === "gambar") {
            const reader = new FileReader();
            reader.onload = function () {
                document.getElementById("previewImage").src = reader.result;
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(form);
        let editId = form.dataset.editId;

        let url = "{{ route('produk.store') }}";
        let method = "POST";

        if(editId){
            url = "/produk/" + editId;
            formData.append('_method', 'PUT');
        }

        fetch(url, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            closeModal();
            if(data.success){
    closeModal();
    form.reset();
    loadProduk(); // panggil ulang data tanpa reload
}

        });
    });

});

window.editProduk = function(
    id, kode, nama, ukuran, kategori, stok, warna, harga, deskripsi
){
    openModal();

    const form = document.getElementById("formProduk");

    form.dataset.editId = id;

    form.kode_produk.value = kode;
    form.nama_produk.value = nama;
    form.ukuran.value = ukuran;
    form.kategori.value = kategori;
    form.stok.value = stok;
    form.warna.value = warna;
    form.harga.value = harga;
    form.deskripsi.value = deskripsi;
};
function loadProduk(){
    fetch("{{ route('katalog') }}")
    .then(response => response.text())
    .then(html => {
        let parser = new DOMParser();
        let doc = parser.parseFromString(html, 'text/html');
        let newTable = doc.querySelector("tbody").innerHTML;
        document.querySelector("tbody").innerHTML = newTable;
    });
}

</script>
@endsection
