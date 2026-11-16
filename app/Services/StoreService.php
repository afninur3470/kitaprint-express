<?php
namespace App\Services;

use App\Enums\StoreStatus;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class StoreService {
    public function submit(User $user, array $data): Store {
        if ($user->store()->exists()) {
            throw ValidationException::withMessages(['store' => 'Anda sudah mendaftarkan usaha.']);
        }

        return DB::transaction(function () use ($user, $data) {
            $payload = [
                'user_id' => $user->id,
                'name' => $data['name'],
                'slug' => Str::slug($data['name']) . '-' . rand(100, 999),
                'business_type' => $data['business_type'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'address' => $data['address'],
                'city' => $data['city'],
                'postal_code' => $data['postal_code'],
                'ktp_number' => $data['ktp_number'],
                'bank_name' => $data['bank_name'],
                'bank_account_number' => $data['bank_account_number'],
                'bank_account_name' => $data['bank_account_name'],
                'status' => StoreStatus::Pending,
                'submitted_at' => now(),
            ];

            if (isset($data['store_photo'])) $payload['store_photo'] = $data['store_photo']->store('stores/photos', 'public');
            if (isset($data['ktp_photo'])) $payload['ktp_photo'] = $data['ktp_photo']->store('stores/ktp', 'public');

            return Store::create($payload);
        });
    }

    public function approve(Store $store, User $admin): Store {
        if (! $store->isPending()) {
            throw ValidationException::withMessages(['status' => 'Hanya pengajuan pending yang bisa disetujui.']);
        }

        DB::transaction(function () use ($store, $admin) {
            $store->update([
                'status' => StoreStatus::Approved,
                'verified_at' => now(),
                'verified_by' => $admin->id,
                'rejection_reason' => null,
                'is_open' => true,
            ]);

            $owner = $store->owner;
            if (! $owner->hasRole('mitra')) {
                $owner->removeRole('pengguna');
                $owner->assignRole('mitra');
            }
        });
        return $store->refresh();
    }

    public function reject(Store $store, User $admin, string $reason): Store {
        if (! $store->isPending()) {
            throw ValidationException::withMessages(['status' => 'Hanya pengajuan pending yang bisa ditolak.']);
        }

        $store->update([
            'status' => StoreStatus::Rejected,
            'rejection_reason' => $reason,
            'verified_at' => now(),
            'verified_by' => $admin->id,
        ]);
        return $store->refresh();
    }
}