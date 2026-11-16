<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Services\StoreService;
use Illuminate\Http\Request;

class StoreVerificationController extends Controller {
    public function __construct(private StoreService $service) {}

    public function index(Request $request) {
        $status = $request->query('status', 'pending');
        $stores = Store::with('owner')->where('status', $status)->latest('submitted_at')->get();
        $counts = [
            'pending' => Store::where('status', 'pending')->count(),
            'approved' => Store::where('status', 'approved')->count(),
            'rejected' => Store::where('status', 'rejected')->count(),
        ];
        return view('pages.admin.store-verification.index', compact('stores', 'status', 'counts'));
    }

    public function show(Store $store) {
        $store->load('owner');
        return view('pages.admin.store-verification.show', compact('store'));
    }

    public function approve(Store $store) {
        $this->service->approve($store, auth()->user());
        return back()->with('success', 'Usaha disetujui! Pengguna kini menjadi Mitra.');
    }

    public function reject(Request $request, Store $store) {
        $request->validate(['rejection_reason' => 'required|min:10']);
        $this->service->reject($store, auth()->user(), $request->rejection_reason);
        return back()->with('success', 'Pengajuan ditolak.');
    }
}