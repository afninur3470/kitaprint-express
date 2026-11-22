<?php
namespace App\Services;

use Carbon\Carbon;

class DeliveryService
{
    public function isCourierAvailable(): bool
    {
        $now = Carbon::now();
        return $now->between(Carbon::createFromTime(7, 0), Carbon::createFromTime(21, 0));
    }

    public function getAvailableDeliveryOptions(): array
    {
        if ($this->isCourierAvailable()) {
            return [
                'courier' => ['label' => 'Kurir Mahasiswa', 'desc' => 'Ongkir Rp 5.000', 'cost' => 5000],
                'self_pick' => ['label' => 'Ambil Mandiri (QR)', 'desc' => 'Gratis, toko 24 jam', 'cost' => 0]
            ];
        }

        // Di luar jam operasional (Malam)
        return [
            'scheduled_courier' => ['label' => 'Diantar Besok Pagi', 'desc' => 'Kloter 07.00 - 09.00 WIB', 'cost' => 5000],
            'self_pick' => ['label' => 'Ambil Mandiri (QR)', 'desc' => 'Gratis, toko 24 jam', 'cost' => 0]
        ];
    }
}