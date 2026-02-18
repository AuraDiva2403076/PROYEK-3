<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class PenggunaController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(8);
        return view('pengguna', compact('users'));
    }

    public function updateStatus($id)
    {
        $user = User::findOrFail($id);

        $user->status = $user->status === 'Aktif' ? 'Nonaktif' : 'Aktif';
        $user->save();

        return back();
    }

    // =======================
    // LAPORAN & EXPORT
    // =======================

    public function laporanPengguna(Request $request)
    {
        $query = User::query();

        // 🔍 FILTER
        if ($request->kode_pengguna) {
            $query->where('id', $request->kode_pengguna);
        }
        if ($request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->email) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        return view('laporan.pengguna', compact('data'));
    }

    public function export(Request $request)
    {
        $query = User::query();

        // Filter normal
        if ($request->kode_pengguna) $query->where('id', $request->kode_pengguna);
        if ($request->name) $query->where('name', 'like', '%' . $request->name . '%');
        if ($request->email) $query->where('email', 'like', '%' . $request->email . '%');

        // 🔹 FILTER BY CHECKBOX SELECTION
        if ($request->ids) {
            $ids = json_decode($request->ids);
            if (is_array($ids) && count($ids) > 0) {
                $query->whereIn('id', $ids);
            }
        }

        $data = $query->get();

        $type = $request->type ?? 'pdf';

        if ($type == 'pdf') {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('laporan.pengguna_pdf', compact('data'));
            return $pdf->download('laporan_pengguna.pdf');
        } elseif ($type == 'excel') {
            return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\UsersExport($data), 'laporan_pengguna.xlsx');
        } elseif ($type == 'csv') {
            return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\UsersExport($data), 'laporan_pengguna.csv');
        }
    }
}
