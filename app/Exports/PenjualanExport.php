<?php

namespace App\Exports;

use App\Models\Penjualan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PenjualanExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected Collection $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function collection(): Collection
    {
        return $this->data->map(function ($item) {
            return [
                $item->kode_pesanan,
                optional($item->produk)->nama__produk ?? '-',
                $item->jumlah,
                $item->harga,
                $item->total,
                $item->tanggal,
                $item->status,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Kode Pesanan',
            'Nama Produk',
            'Jumlah',
            'Harga',
            'Total',
            'Tanggal',
            'Status',
        ];
    }
}
