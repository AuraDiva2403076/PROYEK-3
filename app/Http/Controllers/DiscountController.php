<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\User;
use App\Services\FirebaseNotificationService;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::latest()->get();

        return view('discount', compact('discounts'));
    }

    public function create()
    {
        return view('tambah_discount');
    }

    public function store(Request $request)
    {
        $banner = null;

        if ($request->hasFile('banner')) {
            $banner = $request->file('banner')
                              ->store('discounts', 'public');
        }

        $discount = Discount::create([
            'title' => $request->title,
            'type' => $request->type,
            'discount_percent' => $request->discount_percent,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'banner' => $banner,
            'is_active' => true,
        ]);

        // KIRIM NOTIF PROMO KE SEMUA USER YANG PUNYA FCM TOKEN
        $firebase = app(FirebaseNotificationService::class);

        $users = User::whereNotNull('fcm_token')
            ->where('fcm_token', '!=', '')
            ->get();

       foreach ($users as $user) {
    $firebase->sendNotification(
        $user->fcm_token,
        'Promo Baru HARA 💖',
        $discount->title . ' sudah tersedia. Yuk cek promo sekarang!'
    );
       }

        foreach ($users as $user) {
            $firebase->sendNotification(
                $user->fcm_token,
                'Promo Baru HARA 💖',
                $discount->title . ' sudah tersedia. Yuk cek promo sekarang!'
            );
        }

        return redirect()
                ->route('discount.index')
                ->with('success', 'Discount berhasil ditambahkan');
    }

    public function edit($id)
    {
        $discount = Discount::findOrFail($id);

        return view('edit_discount', compact('discount'));
    }

    public function update(Request $request, $id)
    {
        $discount = Discount::findOrFail($id);

        if ($request->hasFile('banner')) {
            $banner = $request->file('banner')
                              ->store('discounts', 'public');

            $discount->banner = $banner;
        }

        $discount->title = $request->title;
        $discount->type = $request->type;
        $discount->discount_percent = $request->discount_percent;
        $discount->start_date = $request->start_date;
        $discount->end_date = $request->end_date;

        $discount->save();

        return redirect()
                ->route('discount.index')
                ->with('success', 'Discount berhasil diupdate');
    }

    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);

        $discount->delete();

        return redirect('/discount')
                ->with('success', 'Discount berhasil dihapus');
    }

    public function toggle($id)
    {
        $discount = Discount::findOrFail($id);

        $discount->is_active = !$discount->is_active;

        $discount->save();

        return redirect('/discount');
    }
}