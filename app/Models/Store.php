<?php

namespace App\Models;

use App\Enums\BusinessType;
use App\Enums\StoreStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'name', 'slug', 'business_type', 'description',
        'logo', 'store_photo', 'phone', 'email', 'address', 'city',
        'province', 'postal_code', 'ktp_number', 'ktp_photo',
        'nib_number', 'npwp_number', 'bank_name', 'bank_account_number',
        'bank_account_name', 'status', 'rejection_reason', 'submitted_at',
        'verified_at', 'verified_by', 'is_open',
    ];

    protected function casts(): array
    {
        return [
            'submitted_at' => 'datetime',
            'verified_at' => 'datetime',
            'is_open' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function isPending(): bool
    {
        return $this->status === StoreStatus::Pending;
    }

    public function isApproved(): bool
    {
        return $this->status === StoreStatus::Approved;
    }

    public function isRejected(): bool
    {
        return $this->status === StoreStatus::Rejected;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}