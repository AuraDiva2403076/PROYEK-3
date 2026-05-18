<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class PenggunaController extends Controller
{
    public function index(Request $request)
    {
        $query = User::latest('created_at');

        if ($request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $users = $query->paginate(8)->withQueryString();

        return view('pengguna', compact('users'));
    }

    public function updateStatus($id)
    {
        $user = User::findOrFail($id);

        $user->status = $user->status === 'Aktif' ? 'Diblokir' : 'Aktif';
        $user->save();

        return back();
    }

    public function updateProfile(Request $request)
    {
        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        $user->name = $request->name;
        $user->no_telepon = $request->phone;
        $user->alamat = $request->address;

        if ($request->remove_image == '1') {
            $user->foto = null;
        } elseif ($request->filled('profile_image')) {
            $user->foto = $request->profile_image;
        }

        $user->save();

        return response()->json([
            'message' => 'Profile updated',
            'user' => $user
        ], 200);
    }

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
