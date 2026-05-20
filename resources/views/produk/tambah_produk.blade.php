<form id="formProduk" enctype="multipart/form-data">
@csrf

<div class="grid grid-cols-2 gap-6 text-gray-800 dark:text-gray-100">

    <!-- KIRI -->
    <div>

        <div id="previewContainer"
            class="flex flex-wrap gap-3 mb-4">
        </div>

        <label class="border-2 border-dashed
            border-[#F38B93]/50
            hover:border-[#F38B93]
            rounded-xl p-4 text-center block cursor-pointer text-sm
            bg-[#1E293B]
            text-white
            transition duration-200">

            Upload gambar

            <input type="file" name="gambar[]" id="gambar" class="hidden" multiple>
        </label>

    </div>

    <!-- KANAN -->
    <div class="space-y-3 text-sm">

        <!-- INPUT -->
        <input type="text" name="kode_produk"
            placeholder="Kode Produk"
            class="w-full border border-[#F38B93]/25
                   bg-[#1E293B]
                   text-white
                   rounded-xl p-2
                   outline-none
                   focus:border-[#F38B93]
                   focus:ring-2 focus:ring-[#F38B93]/20
                   transition duration-200">

        <input type="text" name="nama_produk"
            placeholder="Nama Produk"
            class="w-full border border-[#F38B93]/25
                   bg-[#1E293B]
                   text-white
                   rounded-xl p-2
                   outline-none
                   focus:border-[#F38B93]
                   focus:ring-2 focus:ring-[#F38B93]/20
                   transition duration-200">

        <!-- KATEGORI -->
        <select name="kategori"
            class="w-full border border-[#F38B93]/25
                bg-[#1E293B]
                text-white
                rounded-xl p-2
                outline-none
                focus:border-[#F38B93]
                focus:ring-2 focus:ring-[#F38B93]/20">

            <option>Square Hijab</option>
            <option>Pashmina</option>
            <option>Hijab Inner 2 In 1</option>
            <option>Bergo Instant</option>
            <option>Instant Syar'i</option>
            <option>Hijab Anak</option>

        </select>

        <!-- UKURAN -->
        <div class="space-y-2">

            <label class="text-xs text-gray-400">
                Ukuran & Stok (max 2)
            </label>

            <div class="grid grid-cols-2 gap-3">

                <!-- S -->
                <div class="border border-[#F38B93]/15
                    bg-[#1E293B]
                    rounded-xl p-2">

                    <label class="flex items-center gap-2 text-sm text-white">
                        <input type="checkbox" name="ukuran[]" value="S">
                        S
                    </label>

                    <div class="grid grid-cols-2 gap-2 mt-2">

                        <input type="number" name="stok_ukuran[S]"
                            placeholder="Stok S"
                            class="w-full border border-[#F38B93]/20
                                   bg-[#0F172A]
                                   text-white
                                   rounded-xl p-2">

                        <input type="number" name="harga_ukuran[S]"
                            placeholder="Harga S"
                            class="w-full border border-[#F38B93]/20
                                   bg-[#0F172A]
                                   text-white
                                   rounded-xl p-2">

                    </div>
                </div>

                <!-- M -->
                <div class="border border-[#F38B93]/15
                    bg-[#1E293B]
                    rounded-xl p-2">

                    <label class="flex items-center gap-2 text-sm text-white">
                        <input type="checkbox" name="ukuran[]" value="M">
                        M
                    </label>

                    <div class="grid grid-cols-2 gap-2 mt-2">

                        <input type="number" name="stok_ukuran[M]"
                            placeholder="Stok M"
                            class="w-full border border-[#F38B93]/20
                                   bg-[#0F172A]
                                   text-white
                                   rounded-xl p-2">

                        <input type="number" name="harga_ukuran[M]"
                            placeholder="Harga M"
                            class="w-full border border-[#F38B93]/20
                                   bg-[#0F172A]
                                   text-white
                                   rounded-xl p-2">

                    </div>
                </div>

                <!-- L -->
                <div class="border border-[#F38B93]/15
                    bg-[#1E293B]
                    rounded-xl p-2">

                    <label class="flex items-center gap-2 text-sm text-white">
                        <input type="checkbox" name="ukuran[]" value="L">
                        L
                    </label>

                    <div class="grid grid-cols-2 gap-2 mt-2">

                        <input type="number" name="stok_ukuran[L]"
                            placeholder="Stok L"
                            class="w-full border border-[#F38B93]/20
                                   bg-[#0F172A]
                                   text-white
                                   rounded-xl p-2">

                        <input type="number" name="harga_ukuran[L]"
                            placeholder="Harga L"
                            class="w-full border border-[#F38B93]/20
                                   bg-[#0F172A]
                                   text-white
                                   rounded-xl p-2">

                    </div>
                </div>

            </div>
        </div>

        <!-- WARNA -->
        <div class="grid grid-cols-2 gap-3">

            <input type="text" name="warna"
                placeholder="Warna"
                class="border border-[#F38B93]/25
                       bg-[#1E293B]
                       text-white
                       rounded-xl p-2
                       outline-none
                       focus:border-[#F38B93]
                       focus:ring-2 focus:ring-[#F38B93]/20
                       transition duration-200">

        </div>

        <!-- DESKRIPSI -->
        <textarea name="deskripsi" rows="2"
            placeholder="Deskripsi"
            class="w-full border border-[#F38B93]/25
                   bg-[#1E293B]
                   text-white
                   rounded-xl p-2
                   outline-none
                   focus:border-[#F38B93]
                   focus:ring-2 focus:ring-[#F38B93]/20
                   transition duration-200"></textarea>

        <!-- BUTTON -->
        <button type="submit"
            class="text-white px-4 py-3 rounded-xl w-full
                   font-semibold shadow-lg
                   transition duration-200"
            style="background-color:#F38B93;"
            onmouseover="this.style.backgroundColor='#ea7d86'"
            onmouseout="this.style.backgroundColor='#F38B93'">

            Simpan Produk

        </button>

    </div>

</div>
</form>