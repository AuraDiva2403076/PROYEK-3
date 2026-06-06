<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\User;
use App\Services\FirebaseNotificationService;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PenjualanExport;

class PenjualanController extends Controller
{
    public function index()
    {
        // 1. Ambil semua data penjualan dengan pagination (untuk tabel)
        $data = Penjualan::paginate(10);

        // 2. Hitung statistik berdasarkan kolom 'status' di database
        $totalPesanan = Penjualan::count();
        $selesai = Penjualan::where('status', 'Selesai')->count();
        $batal = Penjualan::where('status', 'Batal')->count();
        $proses = Penjualan::where('status', 'Dalam Proses')->count();

        // 3. Kirim SEMUA variabel ke view
        return view('penjualan', compact('data', 'totalPesanan', 'selesai', 'batal', 'proses'));
    }

    public function laporan(Request $request)
    {
        $data = Penjualan::filter($request)
                    ->paginate(10)
                    ->appends($request->query());

        $produk = Produk::all();

        return view('laporan.penjualan', compact('data', 'produk'));
    }

    public function export(Request $request)
    {
        $query = Penjualan::with('produk')->filter($request);

        $ids = $request->ids ? json_decode($request->ids) : [];

        if (!empty($ids)) {
            $query->whereIn('id', $ids);
        }

        $data = $query->get();

        if ($request->type == 'pdf') {
            $pdf = Pdf::loadView('laporan.penjualan_pdf', compact('data'));
            return $pdf->download('laporan-penjualan.pdf');
        }

        if ($request->type == 'excel') {
            return Excel::download(
                new PenjualanExport($data),
                'laporan-penjualan.xlsx'
            );
        }

        if ($request->type == 'csv') {
            return Excel::download(
                new PenjualanExport($data),
                'laporan-penjualan.csv'
            );
        }
    }

    public function edit($id)
    {
        $penjualan = Penjualan::findOrFail($id);

        return view('penjualan_edit', compact('penjualan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $penjualan = Penjualan::findOrFail($id);

        $penjualan->update([
            'status' => $request->status,
        ]);

        // KIRIM NOTIF KE USER
        if ($penjualan->user_id) {
            $user = User::find($penjualan->user_id);

            if ($user && $user->fcm_token) {
                $firebase = app(FirebaseNotificationService::class);

                $firebase->sendNotification(
                    $user->fcm_token,
                    'Status Pesanan Diperbarui 📦',
                    'Pesanan kamu sekarang berstatus: ' . $penjualan->status
                );
            }
        }

        return redirect()->route('penjualan.index')
            ->with('success', 'Status penjualan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();

        return redirect()->route('penjualan.index')
            ->with('success', 'Data penjualan berhasil dihapus');
    }
}
