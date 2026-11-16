<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegistrationRequest;
use App\Services\StoreService;

class StoreRegistrationController extends Controller {
    public function __construct(private StoreService $service) {}

    public function index() {
        $user = auth()->user();
        if ($user->store?->isApproved() && $user->hasRole('mitra')) {
            return redirect()->route('mitra.dashboard');
        }
        return view('pages.store-registration.index', ['store' => $user->store]);
    }

        public function create()
    {
        if (auth()->user()->store()->exists()) return redirect()->route('store-registration.status');
        
        // Array pengganti Enum
        $businessTypes = [
            'percetakan' => 'Percetakan Umum',
            'digital_printing' => 'Digital Printing',
            'offset' => 'Offset Printing',
            'large_format' => 'Large Format',
            'merchandise' => 'Merchandise',
        ];

        return view('pages.store-registration.create', compact('businessTypes'));
    }

    public function store(StoreRegistrationRequest $request) {
        $this->service->submit(auth()->user(), $request->validated());
        return redirect()->route('store-registration.status')->with('success', 'Pendaftaran berhasil!');
    }

    public function status() {
        $store = auth()->user()->store;
        abort_unless($store, 404);
        return view('pages.store-registration.status', compact('store'));
    }
}