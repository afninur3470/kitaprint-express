@props(['status'])

@php
    $colors = [
        'pending'   => 'bg-yellow-100 text-yellow-800',
        'approved'  => 'bg-green-100 text-green-800',
        'rejected'  => 'bg-red-100 text-red-800',
        'suspended' => 'bg-gray-100 text-gray-800',
    ];
    $labels = [
        'pending'   => 'Menunggu Verifikasi',
        'approved'  => 'Terverifikasi',
        'rejected'  => 'Ditolak',
        'suspended' => 'Ditangguhkan',
    ];
    $value = is_object($status) ? $status->value : $status;
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ' . ($colors[$value] ?? 'bg-gray-100 text-gray-800')]) }}>
    {{ $labels[$value] ?? $value }}
</span>