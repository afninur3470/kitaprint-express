<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Bersihkan cache role
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Buat Role
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $penggunaRole = Role::firstOrCreate(['name' => 'pengguna']);
        $mitraRole = Role::firstOrCreate(['name' => 'mitra']);
        $kurirRole = Role::firstOrCreate(['name' => 'kurir']);

        // 3. Buat User Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@kitaprint.test'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole($adminRole);

        // 4. Buat User Pengguna Umum
        $pengguna = User::updateOrCreate(
            ['email' => 'pengguna@kitaprint.test'],
            [
                'name' => 'Rani Pengguna',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $pengguna->assignRole($penggunaRole);
        
        // 5. Buat User Kurir
        $kurir = User::updateOrCreate(
            ['email' => 'kurir@kitaprint.test'],
            [
                'name' => 'Budi Kurir',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $kurir->assignRole($kurirRole);

                // 1. Buat User Mitra
        $mitraUser = User::updateOrCreate(
            ['email' => 'mitra@kitaprint.test'],
            [
                'name' => 'Pemilik Berkah Jaya',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $mitraUser->assignRole('mitra');

        // 2. Buat Toko untuk Mitra
        \App\Models\Store::updateOrCreate(
            ['user_id' => $mitraUser->id],
            [
                'name' => 'Fotocopy Berkah Jaya',
                'slug' => 'fotocopy-berkah-jaya',
                'business_type' => 'percetakan',
                'phone' => '081234567890',
                'email' => 'berkah@jaya.com',
                'address' => 'Jl. Pendidikan No. 10',
                'city' => 'Pekanbaru',
                'postal_code' => '28281',
                'ktp_number' => '1471000000000001',
                'ktp_photo' => 'dummy.jpg',
                'bank_name' => 'BCA',
                'bank_account_number' => '1234567890',
                'bank_account_name' => 'Pemilik Berkah',
                'status' => 'approved',
                'submitted_at' => now(),
                'is_open' => true,
            ]
        );
    }
}