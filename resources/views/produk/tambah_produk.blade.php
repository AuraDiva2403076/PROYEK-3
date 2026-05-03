<form id="formProduk" enctype="multipart/form-data">
@csrf

<div class="grid grid-cols-2 gap-6">

    <!-- KIRI -->
    <div>
        <div id="previewContainer"
            class="flex flex-wrap gap-3 mb-4">
        </div>

        <label class="border-2 border-dashed border-pink-300
            hover:border-pink-400
            rounded-xl p-4 text-center block cursor-pointer text-sm
            transition duration-200">
            Upload gambar
            <input type="file" name="gambar[]" id="gambar" class="hidden" multiple>
        </label>
    </div>

    <!-- KANAN -->
    <div class="space-y-3 text-sm">

        <input type="text" name="kode_produk"
            placeholder="Kode Produk"
            class="w-full border border-pink-300 rounded-xl p-2
                   outline-none
                   focus:border-pink-500
                   focus:ring-2 focus:ring-pink-200
                   transition duration-200">

        <input type="text" name="nama_produk"
            placeholder="Nama Produk"
            class="w-full border border-pink-300 rounded-xl p-2
                   outline-none
                   focus:border-pink-500
                   focus:ring-2 focus:ring-pink-200
                   transition duration-200">

        <!-- KATEGORI -->
        <select name="kategori"
            class="w-full border border-pink-300 rounded-xl p-2
                outline-none focus:border-pink-500 focus:ring-2 focus:ring-pink-200">
            <option>Square Hijab</option>
            <option>Pashmina</option>
            <option>Hijab Inner 2 In 1</option>
            <option>Bergo Instant</option>
            <option>Syar'i</option>
            <option>Hijab Anak</option>
        </select>

        <!-- UKURAN & STOK -->
        <div class="space-y-2">
            <label class="text-xs text-gray-500">Ukuran & Stok (max 2)</label>

            <div class="grid grid-cols-2 gap-3">

                <!-- S -->
                <div class="border border-pink-200 rounded-xl p-2">
                    <label class="flex items-center gap-2 text-sm">
                        <input type="checkbox" name="ukuran[]" value="S">
                        S
                    </label>

                    <div class="grid grid-cols-2 gap-2 mt-2">
                        <input type="number" name="stok_ukuran[S]"
                            placeholder="Stok S"
                            class="w-full border border-pink-300 rounded-xl p-2">

                        <input type="number" name="harga_ukuran[S]"
                            placeholder="Harga S"
                            class="w-full border border-pink-300 rounded-xl p-2">
                    </div>
                </div>

                <!-- M -->
                <div class="border border-pink-200 rounded-xl p-2">
                    <label class="flex items-center gap-2 text-sm">
                        <input type="checkbox" name="ukuran[]" value="M">
                        M
                    </label>
                    <div class="grid grid-cols-2 gap-2 mt-2">
                        <input type="number" name="stok_ukuran[M]"
                            placeholder="Stok M"
                            class="w-full border border-pink-300 rounded-xl p-2">

                        <input type="number" name="harga_ukuran[M]"
                            placeholder="Harga M"
                            class="w-full border border-pink-300 rounded-xl p-2">
                    </div>
                </div>

                <!-- L -->
                <div class="border border-pink-200 rounded-xl p-2">
                    <label class="flex items-center gap-2 text-sm">
                        <input type="checkbox" name="ukuran[]" value="L">
                        L
                    </label>
                    <div class="grid grid-cols-2 gap-2 mt-2">
                        <input type="number" name="stok_ukuran[L]"
                            placeholder="Stok L"
                            class="w-full border border-pink-300 rounded-xl p-2">

                        <input type="number" name="harga_ukuran[L]"
                            placeholder="Harga L"
                            class="w-full border border-pink-300 rounded-xl p-2">
                    </div>
                </div>

            </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <input type="text" name="warna"
                placeholder="Warna"
                class="border border-pink-300 rounded-xl p-2
                       outline-none
                       focus:border-pink-500
                       focus:ring-2 focus:ring-pink-200
                       transition duration-200">
        </div>

        <textarea name="deskripsi" rows="2"
            placeholder="Deskripsi"
            class="w-full border border-pink-300 rounded-xl p-2
                   outline-none
                   focus:border-pink-500
                   focus:ring-2 focus:ring-pink-200
                   transition duration-200"></textarea>

        <button type="submit"
            class="bg-pink-400
                   hover:bg-pink-500
                   active:bg-pink-600
                   focus:ring-2 focus:ring-pink-200
                   text-white px-4 py-2 rounded-xl w-full
                   transition duration-200">
            Simpan Produk
        </button>
    </div>

</div>
</form>
