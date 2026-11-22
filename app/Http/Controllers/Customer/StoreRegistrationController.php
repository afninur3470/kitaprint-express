<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // <-- PASTIKAN BARIS INI ADA

class StoreRegistrationController extends Controller
{
    public function index()
    {
        $store = auth()->user()->store;
        return view('pages.store-registration.index', compact('store'));
    }

    public function create()
    {
        if (auth()->user()->store) {
            return redirect()->route('store-registration.status');
        }

        $businessTypes = [
            'percetakan' => 'Percetakan Umum',
            'digital_printing' => 'Digital Printing',
            'offset' => 'Offset Printing',
            'large_format' => 'Large Format',
            'merchandise' => 'Merchandise / Souvenir',
        ];

        return view('pages.store-registration.create', compact('businessTypes'));
    }

    public function store(Request $request)
    {
        // 1. Validasi semua inputan form
        $request->validate([
            'name' => 'required|string|max:255',
            'business_type' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'ktp_number' => 'required|digits:16',
            'ktp_photo' => 'required|image|max:2048',
            'store_photo' => 'nullable|image|max:2048',
            'bank_name' => 'required|string',
            'bank_account_number' => 'required|string',
            'bank_account_name' => 'required|string',
            'agree_terms' => 'accepted'
        ]);

        // 2. Upload File
        $ktpPath = $request->file('ktp_photo')->store('stores/ktp', 'public');
        $storePhotoPath = $request->hasFile('store_photo') 
                          ? $request->file('store_photo')->store('stores/photos', 'public') 
                          : null;

        // 3. Simpan ke Database
        Store::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            
            // INI BAGIAN YANG MEMBUAT ERROR HILANG:
            'slug' => Str::slug($request->name) . '-' . rand(100, 999), 
            
            'business_type' => $request->business_type,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'ktp_number' => $request->ktp_number,
            'ktp_photo' => $ktpPath,
            'store_photo' => $storePhotoPath,
            'bank_name' => $request->bank_name,
            'bank_account_number' => $request->bank_account_number,
            'bank_account_name' => $request->bank_account_name,
            'status' => 'pending', // Menunggu verifikasi admin
        ]);

        return redirect()->route('store-registration.status')->with('success', 'Pendaftaran berhasil! Menunggu verifikasi Admin maksimal 24 jam.');
    }

    public function status()
    {
        $store = auth()->user()->store;
        if (!$store) {
            return redirect()->route('store-registration.index');
        }
        return view('pages.store-registration.status', compact('store'));
    }
}