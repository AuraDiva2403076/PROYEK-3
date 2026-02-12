<form id="formProduk" enctype="multipart/form-data">
@csrf

<div class="grid grid-cols-2 gap-6">

    <!-- KIRI -->
    <div>
        <img id="previewImage"
            src="{{ asset('images/grup.jpg') }}"
            class="rounded-xl w-full h-48 object-cover mb-4">

        <label class="border-2 border-dashed border-pink-300
            rounded-xl p-4 text-center block cursor-pointer text-sm">
            Upload gambar
            <input type="file" name="gambar" id="gambar" class="hidden">
        </label>
    </div>

    <!-- KANAN -->
    <div class="space-y-3 text-sm">

        <input type="text" name="kode_produk"
            placeholder="Kode Produk"
            class="w-full border border-pink-300 rounded-xl p-2">

        <input type="text" name="nama_produk"
            placeholder="Nama Produk"
            class="w-full border border-pink-300 rounded-xl p-2">

        <div class="grid grid-cols-3 gap-3">
            <select name="ukuran"
                class="border border-pink-300 rounded-xl p-2">
                <option>S</option>
                <option>M</option>
                <option>L</option>
            </select>

            <select name="kategori"
                class="border border-pink-300 rounded-xl p-2">
                <option>Pashmina</option>
                <option>Segi Empat</option>
            </select>

            <input type="number" name="stok"
                placeholder="Stok"
                class="border border-pink-300 rounded-xl p-2">
        </div>

        <div class="grid grid-cols-2 gap-3">
            <input type="text" name="warna"
                placeholder="Warna"
                class="border border-pink-300 rounded-xl p-2">

            <input type="number" name="harga"
                placeholder="Harga"
                class="border border-pink-300 rounded-xl p-2">
        </div>

        <textarea name="deskripsi" rows="2"
            placeholder="Deskripsi"
            class="w-full border border-pink-300 rounded-xl p-2"></textarea>

        <button type="submit"
            class="bg-pink-400 text-white px-4 py-2 rounded-xl w-full">
            Simpan Produk
        </button>
    </div>
    

</div>
</form>
