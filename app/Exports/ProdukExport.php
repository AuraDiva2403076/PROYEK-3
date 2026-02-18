<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProdukExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function($item) {
            return [
                'Kode' => $item->kode_produk,
                'Nama' => $item->nama_produk,
                'Ukuran' => $item->ukuran,
                'Kategori' => $item->kategori,
                'Harga' => $item->harga,
                'Warna' => $item->warna,
                'Stok' => $item->stok,
                'Deskripsi' => $item->deskripsi,
            ];
        });
    }

    public function headings(): array
    {
        return ['Kode', 'Nama', 'Ukuran', 'Kategori', 'Harga', 'Warna', 'Stok', 'Deskripsi'];
    }
}
