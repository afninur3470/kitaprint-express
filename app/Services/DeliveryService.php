<?php

namespace App\Services;

use Carbon\Carbon;

class DeliveryService
{
    /**
     * Cek apakah kurir sedang online/tersedia saat ini.
     * Simulasi: Kurir beroperasi dari jam 07:00 sampai 22:00.
     */
    public function isCourierAvailable(): bool
    {
        $now = Carbon::now();
        $start = Carbon::createFromTime(7, 0, 0); // Jam 7 Pagi
        $end = Carbon::createFromTime(22, 0, 0);  // Jam 10 Malam

        // Jika sekarang di antara jam 7 pagi dan 10 malam, kurir tersedia
        return $now->between($start, $end);
    }

    /**
     * Menentukan opsi pengiriman yang tersedia.
     */
    public function getAvailableDeliveryOptions(): array
    {
        if ($this->isCourierAvailable()) {
            return [
                'courier' => [
                    'label' => 'Kurir Mahasiswa',
                    'desc' => 'Ongkir Rp 5.000',
                    'cost' => 5000,
                    'is_active' => true
                ],
                'self_pick' => [
                    'label' => 'Ambil Mandiri (QR)',
                    'desc' => 'Gratis, ambil di toko',
                    'cost' => 0,
                    'is_active' => true
                ]
            ];
        }

        // Jika di luar jam operasional kurir
        return [
            'self_pick' => [
                'label' => 'Ambil Mandiri (QR)',
                'desc' => 'Gratis, toko buka 24 jam',
                'cost' => 0,
                'is_active' => true
            ],
            'scheduled_courier' => [
                'label' => 'Diantar Besok Pagi',
                'desc' => 'Kloter pertama (07:00 - 09:00)',
                'cost' => 5000,
                'is_active' => true
            ]
        ];
    }
}