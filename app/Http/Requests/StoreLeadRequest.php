<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLeadRequest extends FormRequest
{
    /**
     * The enquiry form is public.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Normalise the phone number to 10 digits before validating.
     */
    protected function prepareForValidation(): void
    {
        $phone = preg_replace('/\D+/', '', (string) $this->input('phone'));

        if (strlen($phone) === 12 && str_starts_with($phone, '91')) {
            $phone = substr($phone, 2);
        } elseif (strlen($phone) === 11 && str_starts_with($phone, '0')) {
            $phone = substr($phone, 1);
        }

        $this->merge([
            'phone' => $phone,
            'name' => trim((string) $this->input('name')),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:120', "regex:/^[\pL\s.'-]+$/u"],
            'phone' => ['required', 'regex:/^[6-9]\d{9}$/'],
            'email' => ['nullable', 'email', 'max:255'],
            'city' => ['nullable', 'string', 'max:120'],
            'service' => ['nullable', Rule::in(array_keys(config('site.services')))],
            'message' => ['nullable', 'string', 'max:2000'],
            'consent' => ['accepted'],
            'website' => ['nullable', 'max:0'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.regex' => 'Please enter a valid name (letters only).',
            'phone.required' => 'Please enter your mobile number.',
            'phone.regex' => 'Please enter a valid 10-digit Indian mobile number.',
            'consent.accepted' => 'Please allow us to contact you about your enquiry.',
            'website.max' => 'Something went wrong. Please try again.',
        ];
    }
}
