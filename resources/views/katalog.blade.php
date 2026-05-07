@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')
<div class="space-y-6">
    <!-- HEADER -->
    <div class="flex justify-between items-center">

        <!-- KIRI -->
        <div class="flex gap-3 relative">

            <!-- ADD -->
            <button onclick="openModalCreate()"
                class="bg-pink-400 text-white px-4 py-2 rounded-xl text-sm">
                + Add Produk
            </button>

            <div id="previewModal"
                class="fixed top-0 left-0 w-screen h-screen bg-black/40 hidden items-center justify-center z-[99999]">

                <div class="bg-white w-[700px] rounded-2xl p-8 relative max-h-[90vh] overflow-y-auto">

                    <button onclick="closePreview()"
                        class="absolute top-4 right-4 text-gray-500 text-xl">
                        ✕
                    </button>

                    <div id="previewProdukGambarContainer"
                        class="grid grid-cols-3 gap-3 mb-5">
                    </div>

                    <h2 id="previewProdukNama"
                        class="text-2xl font-bold text-pink-500 mb-1"></h2>

                    <p id="previewProdukKode"
                        class="text-sm text-gray-400 mb-4"></p>

                    <div class="grid grid-cols-2 gap-3 text-sm mb-4">
                        <div class="bg-pink-50 p-3 rounded-xl">
                            <p class="text-gray-400">Kategori</p>
                            <p id="previewProdukKategori" class="font-semibold"></p>
                        </div>

                        <div class="bg-pink-50 p-3 rounded-xl">
                            <p class="text-gray-400">Warna</p>
                            <p id="previewProdukWarna" class="font-semibold"></p>
                        </div>
                    </div>

                    <div class="bg-pink-50 p-4 rounded-xl mb-4">
                        <p class="text-gray-400 text-sm mb-2">Ukuran, Stok & Harga</p>
                        <div id="previewProdukUkuran" class="text-sm font-medium"></div>
                    </div>

                    <div>
                        <p class="text-gray-400 text-sm mb-2">Deskripsi</p>
                        <p id="previewProdukDeskripsi"
                        class="text-sm leading-relaxed whitespace-pre-line text-gray-700"></p>
                    </div>
                </div>
            </div>

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
        <th class="border border-pink-200 px-3 py-3">No</th>
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
    @php
        $ukuranTerpilih = $produk->ukurans
            ->filter(fn($u) => $u->harga !== null && $u->harga > 0);
    @endphp

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
    {{ $ukuranTerpilih->pluck('ukuran')->join(', ') }}
</td>

<td class="border border-pink-100 px-3 py-2">
    {{ $produk->kategori }}
</td>

<td class="border border-pink-100 px-3 py-2 text-pink-500 font-semibold">
    @php
        $ukuranTerpilih = $produk->ukurans
            ->filter(fn($u) => $u->harga !== null && $u->harga > 0);

        $minHarga = $ukuranTerpilih->min('harga');
        $maxHarga = $ukuranTerpilih->max('harga');
    @endphp

    @if($ukuranTerpilih->isEmpty())
        -
    @elseif($minHarga == $maxHarga)
        Rp{{ number_format($minHarga, 0, ',', '.') }}
    @else
        Rp{{ number_format($minHarga, 0, ',', '.') }} - Rp{{ number_format($maxHarga, 0, ',', '.') }}
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
    {!! json_encode($produk->deskripsi) !!}
</td>

<td class="border border-pink-100 px-3 py-2 text-center space-x-3">
    <!-- VIEW ICON -->
    <button
        class="preview-btn text-blue-500 hover:text-blue-600 text-lg transition"
        data-kode="{{ $produk->kode_produk }}"
        data-nama="{{ $produk->nama_produk }}"
        data-kategori="{{ $produk->kategori }}"
        data-warna="{{ $produk->warna }}"
        data-deskripsi="{{ $produk->deskripsi }}"
        data-ukuran="{!! $ukuranTerpilih
            ->map(fn($u) => $u->ukuran . ' - Stok: ' . $u->stok . ' - Harga: Rp' . number_format($u->harga, 0, ',', '.'))
            ->join(' | ') !!}"
        data-gambar='@json($produk->gambars->pluck("gambar"))'
        title="Preview">
        <i class="fa-solid fa-eye"></i>
    </button>

    <button
        class="edit-btn text-yellow-500 hover:text-yellow-600 text-lg transition"
        data-id="{{ $produk->id }}"
        data-kode="{{ $produk->kode_produk }}"
        data-nama="{{ $produk->nama_produk }}"
        data-kategori="{{ $produk->kategori }}"
        data-warna="{{ $produk->warna }}"
        data-deskripsi="{{ $produk->deskripsi }}"
        data-ukurans='@json($produk->ukurans)'
        data-gambars='@json($produk->gambars)'
        title="Edit">
        <i class="fa-solid fa-pen-to-square"></i>
    </button>

    <!-- DELETE ICON -->
    <form action="{{ route('produk.destroy', $produk->id) }}"
        method="POST" class="inline">
        @csrf
        @method('DELETE')

        <button
            type="button"
            class="delete-btn text-red-500 hover:text-red-600 text-lg transition"
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
            <div class="w-full h-24 border-2 border-dashed border-pink-300
                rounded-xl flex flex-col items-center justify-center text-pink-400 text-sm">

                <i class="fa-solid fa-image text-xl mb-1"></i>
                <span>Belum ada gambar</span>
            </div>
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

    window.openModalCreate = function () {
        form.reset();
        delete form.dataset.editId;

        selectedFiles = [];
        inputFile.value = "";
        renderDefaultPreview();

        document.querySelectorAll('input[name="ukuran[]"]').forEach(cb => cb.checked = false);
        document.querySelectorAll('input[name^="stok_ukuran"]').forEach(input => input.value = "");
        document.querySelectorAll('input[name^="harga_ukuran"]').forEach(input => input.value = "");

        const modal = document.getElementById("modalProduk");
        modal.classList.remove("hidden");
        modal.classList.add("flex");
    }

    window.openModalEdit = function () {
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

document.addEventListener("click", function(e){
    const btn = e.target.closest(".preview-btn");
    if(!btn) return;

    const ukuranHtml = btn.dataset.ukuran.replaceAll(" | ", "<br>");

    previewProduk(
        btn.dataset.kode,
        btn.dataset.nama,
        btn.dataset.kategori,
        btn.dataset.warna,
        btn.dataset.deskripsi,
        ukuranHtml,
        btn.dataset.gambar
    );
});

window.editProduk = function (
    id, kode, nama, kategori, warna, deskripsi, ukurans, gambars
) {
    openModalEdit();

    const form = document.getElementById("formProduk");
    form.dataset.editId = id;

    form.kode_produk.value = kode;
    form.nama_produk.value = nama;
    form.kategori.value = kategori;
    form.warna.value = warna;
    form.deskripsi.value = deskripsi;

    document.querySelectorAll('input[name="ukuran[]"]').forEach(cb => cb.checked = false);
    document.querySelectorAll('input[name^="stok_ukuran"]').forEach(input => input.value = "");
    document.querySelectorAll('input[name^="harga_ukuran"]').forEach(input => input.value = "");

    ukurans.forEach(item => {
        const checkbox = document.querySelector(`input[name="ukuran[]"][value="${item.ukuran}"]`);
        const stokInput = document.querySelector(`input[name="stok_ukuran[${item.ukuran}]"]`);
        const hargaInput = document.querySelector(`input[name="harga_ukuran[${item.ukuran}]"]`);

        if (checkbox) checkbox.checked = true;
        if (stokInput) stokInput.value = item.stok;
        if (hargaInput) hargaInput.value = item.harga;
    });

    const previewContainer = document.getElementById("previewContainer");
    previewContainer.innerHTML = "";

    if (gambars.length > 0) {
        gambars.forEach(item => {
            const img = document.createElement("img");
            img.src = "/storage/" + item.gambar;
            img.className = "w-24 h-24 object-contain rounded-xl border border-pink-200 bg-white p-1";
            previewContainer.appendChild(img);
        });
    } else {
        renderDefaultPreview();
    }
};

document.addEventListener("click", function(e){
    const btn = e.target.closest(".edit-btn");
    if(!btn) return;

    editProduk(
        btn.dataset.id,
        btn.dataset.kode,
        btn.dataset.nama,
        btn.dataset.kategori,
        btn.dataset.warna,
        btn.dataset.deskripsi,
        JSON.parse(btn.dataset.ukurans),
        JSON.parse(btn.dataset.gambars)
    );
});

document.addEventListener("click", function(e){
    const btn = e.target.closest(".delete-btn");
    if(!btn) return;

    e.preventDefault();

    if(confirm("Yakin hapus produk ini?")){
        btn.closest("form").submit();
    }
});

window.previewProduk = function (
    kode, nama, kategori, warna, deskripsi, ukuranHtml, gambar
) {
    document.getElementById("previewProdukKode").innerText = kode;
    document.getElementById("previewProdukNama").innerText = nama;
    document.getElementById("previewProdukKategori").innerText = kategori;
    document.getElementById("previewProdukWarna").innerText = warna;
    document.getElementById("previewProdukDeskripsi").innerText = deskripsi;
    document.getElementById("previewProdukUkuran").innerHTML = ukuranHtml;
    const container = document.getElementById("previewProdukGambarContainer");
    container.innerHTML = "";

    let images = [];

    try {
        images = JSON.parse(gambar);
    } catch (e) {
        images = [];
    }

    // kalau kosong
    if (images.length === 0) {
        container.innerHTML = `
            <div class="col-span-3 bg-pink-100 h-40 rounded-xl flex items-center justify-center text-gray-400">
                Tidak ada gambar
            </div>
        `;
        return;
    }

    images.forEach(img => {
        const el = document.createElement("img");
        el.src = "/storage/" + img;

        el.className = `
            w-full h-32
            object-contain
            bg-white
            rounded-xl
            border border-pink-200
            p-1
        `;

        container.appendChild(el);
    });

    const modal = document.getElementById("previewModal");
    modal.classList.remove("hidden");
    modal.classList.add("flex");
};

window.closePreview = function () {
    const modal = document.getElementById("previewModal");
    modal.classList.add("hidden");
    modal.classList.remove("flex");
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
