@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')
<div class="space-y-6">
    <!-- HEADER -->
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
                            <option value="Segi Empat">Warna</option>
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
        class="fixed top-0 left-0 w-screen h-screen bg-black/40 hidden items-center justify-center z-[99999]">

        <div class="bg-white w-[900px] rounded-2xl p-8 relative max-h-[90vh] overflow-y-auto">

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
        <table class="w-full text-sm text-left border-collapse">

           <thead>
    <tr class="bg-pink-50 text-gray-600">
        <th class="border border-pink-200 px-3 py-3">Nomor</th>
        <th class="border border-pink-200 px-3 py-3">Kode</th>
        <th class="border border-pink-200 px-3 py-3">Gambar</th>
        <th class="border border-pink-200 px-3 py-3">Nama</th>
        <th class="border border-pink-200 px-3 py-3">Ukuran</th>
        <th class="border border-pink-200 px-3 py-3">Kategori</th>
        <th class="border border-pink-200 px-3 py-3">Harga</th>
        <th class="border border-pink-200 px-3 py-3">Warna</th>
        <th class="border border-pink-200 px-3 py-3">Stok</th>
        <th class="border border-pink-200 px-3 py-3">Deskripsi</th>
        <th class="border border-pink-200 px-3 py-3 text-center">Aksi</th>
    </tr>
</thead>

<tbody>
@forelse($produks as $produk)
<tr class="hover:bg-pink-50 transition">

<td class="border border-pink-100 px-3 py-2">
    {{ $loop->iteration }}
</td>

<td class="border border-pink-100 px-3 py-2">
    {{ $produk->kode_produk }}
</td>

<td class="border border-pink-100 px-3 py-2">
    @if($produk->gambars->count())
        <img src="{{ asset('storage/'.$produk->gambars->first()->gambar) }}"
            class="w-10 h-10 rounded-full object-cover border border-pink-200">
    @else
        <div class="w-10 h-10 bg-pink-100 rounded-full"></div>
    @endif
</td>

<td class="border border-pink-100 px-3 py-2 font-medium">
    {{ $produk->nama_produk }}
</td>

<td class="border border-pink-100 px-3 py-2">
    {{ $produk->ukurans->pluck('ukuran')->join(', ') }}
</td>

<td class="border border-pink-100 px-3 py-2">
    {{ $produk->kategori }}
</td>

<td class="border border-pink-100 px-3 py-2 text-pink-500 font-semibold">
    @php
        $minHarga = $produk->ukurans->min('harga');
        $maxHarga = $produk->ukurans->max('harga');
    @endphp

    @if($minHarga == $maxHarga)
        Rp{{ number_format($minHarga) }}
    @else
        Rp{{ number_format($minHarga) }} - Rp{{ number_format($maxHarga) }}
    @endif
</td>

<td class="border border-pink-100 px-3 py-2">
    {{ $produk->warna }}
</td>

<td class="border border-pink-100 px-3 py-2">
    <span class="px-2 py-1 text-xs rounded-lg
        {{ $produk->total_stok > 5 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
        {{ $produk->total_stok }}
    </span>
</td>

<td class="border border-pink-100 px-3 py-2 truncate max-w-[150px] text-gray-500">
    {{ $produk->deskripsi }}
</td>

<td class="border border-pink-100 px-3 py-2 text-center space-x-3">

    <!-- EDIT ICON -->
    <button
        onclick="editProduk(
            '{{ $produk->id }}',
            '{{ $produk->kode_produk }}',
            '{{ $produk->nama_produk }}',
            '{{ $produk->kategori }}',
            '{{ $produk->warna }}',
            `{{ $produk->deskripsi }}`
        )"
        class="text-yellow-500 hover:text-yellow-600 text-lg transition"
        title="Edit">
        <i class="fa-solid fa-pen-to-square"></i>
    </button>

    <!-- DELETE ICON -->
    <form action="{{ route('produk.destroy', $produk->id) }}"
          method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Yakin hapus produk?')"
            class="text-red-500 hover:text-red-600 text-lg transition"
            title="Hapus">
            <i class="fa-solid fa-trash"></i>
        </button>
    </form>

</td>

</tr>

@empty
<tr>
    <td colspan="11" class="text-center py-6 text-gray-400 border border-pink-100">
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

<!-- ================= SORTABLE JS ================= -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

<!-- ================= SCRIPT ================= -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("formProduk");
    const previewContainer = document.getElementById("previewContainer");
    const inputFile = document.getElementById("gambar");

    let selectedFiles = [];

    // DRAG & DROP PREVIEW
    Sortable.create(previewContainer, {
        animation: 150,
        onEnd: function () {
            const newOrder = [];

            previewContainer.querySelectorAll("[data-index]").forEach(item => {
                newOrder.push(selectedFiles[item.dataset.index]);
            });

            selectedFiles = newOrder;
            renderPreview();
        }
    });

    function renderDefaultPreview() {
        previewContainer.innerHTML = `
            <img src="{{ asset('images/grup.jpg') }}"
                class="rounded-xl w-full h-24 object-cover">
        `;
    }

    function renderPreview() {
        previewContainer.innerHTML = "";

        if (selectedFiles.length === 0) {
            renderDefaultPreview();
            return;
        }

        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();

            reader.onload = function () {
                const wrapper = document.createElement("div");
                wrapper.className = "relative w-24 h-24 cursor-move";
                wrapper.dataset.index = index;

                const img = document.createElement("img");
                img.src = reader.result;
                img.className = "w-full h-full object-cover rounded-xl border border-pink-200";

                const removeBtn = document.createElement("button");
                removeBtn.type = "button";
                removeBtn.innerHTML = "×";
                removeBtn.className = "absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center";

                removeBtn.onclick = function () {
                    selectedFiles.splice(index, 1);
                    renderPreview();
                };

                wrapper.appendChild(img);
                wrapper.appendChild(removeBtn);
                previewContainer.appendChild(wrapper);
            };

            reader.readAsDataURL(file);
        });
    }

    window.openModal = function () {
        form.reset();
        delete form.dataset.editId;

        selectedFiles = [];
        inputFile.value = "";
        renderDefaultPreview();

        const modal = document.getElementById("modalProduk");
        modal.classList.remove("hidden");
        modal.classList.add("flex");
    }

    window.closeModal = function () {
        const modal = document.getElementById("modalProduk");
        modal.classList.add("hidden");
        modal.classList.remove("flex");
    }

    window.toggleFilter = function () {
        document.getElementById("filterDropdown").classList.toggle("hidden");
    }

    inputFile.addEventListener("change", function (e) {
        const files = Array.from(e.target.files);

        files.forEach(file => {
            selectedFiles.push(file);
        });

        inputFile.value = "";
        renderPreview();
    });

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const checkedUkuran = document.querySelectorAll('input[name="ukuran[]"]:checked');

        if (checkedUkuran.length === 0) {
            alert("Pilih minimal 1 ukuran dulu ya");
            return;
        }

        let formData = new FormData();

        Array.from(form.elements).forEach(el => {
            if (el.name && el.type !== "file") {
                formData.append(el.name, el.value);
            }
        });

        selectedFiles.forEach(file => {
            formData.append("gambar[]", file);
        });

        let editId = form.dataset.editId;
        let url = "{{ route('produk.store') }}";

        if (editId) {
            url = "/produk/" + editId;
            formData.append("_method", "PUT");
        }

        fetch(url, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            },
            body: formData
        })
        .then(async response => {
            const text = await response.text();
            console.log("STATUS:", response.status);
            console.log("RAW RESPONSE:", text);

            let data;
            try {
                data = JSON.parse(text);
            } catch (e) {
                alert("Server error. Cek Console ya Teteh.");
                return;
            }

            if (!response.ok) {
                console.log("ERROR DATA:", data);
                alert("Gagal simpan: " + JSON.stringify(data.errors ?? data.message));
                return;
            }

            if (data.success) {
                closeModal();
                form.reset();
                selectedFiles = [];
                renderDefaultPreview();
                loadProduk();
            }
        })
        .catch(error => {
            console.error("FETCH ERROR:", error);
            alert("Fetch error, cek Console.");
        });
    });

});

window.editProduk = function (
    id, kode, nama, kategori, warna, deskripsi
) {
    openModal();

    const form = document.getElementById("formProduk");

    form.dataset.editId = id;

    form.kode_produk.value = kode;
    form.nama_produk.value = nama;
    form.kategori.value = kategori;
    form.warna.value = warna;
    form.deskripsi.value = deskripsi;
};

function loadProduk() {
    fetch("{{ route('katalog') }}")
    .then(response => response.text())
    .then(html => {
        let parser = new DOMParser();
        let doc = parser.parseFromString(html, "text/html");
        let newTable = doc.querySelector("tbody").innerHTML;
        document.querySelector("tbody").innerHTML = newTable;
    });
}
</script>

@endsection
