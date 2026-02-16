<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

}
