<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationRequest extends FormRequest {
    public function authorize(): bool { return auth()->check(); }

    public function rules(): array {
        return [
            'name' => ['required', 'string', 'max:100'],
            'business_type' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:100'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:10'],
            'ktp_number' => ['required', 'digits:16'],
            'ktp_photo' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'store_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'bank_name' => ['required', 'string', 'max:50'],
            'bank_account_number' => ['required', 'string', 'max:30'],
            'bank_account_name' => ['required', 'string', 'max:100'],
            'agree_terms' => ['accepted'],
        ];
    }
}