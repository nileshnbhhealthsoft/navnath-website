<?php

namespace App\Http\Requests;

use App\Models\SiteContent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContactSubmissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email:rfc', 'max:255'],
            'company' => ['nullable', 'string', 'max:150'],
            'service' => [
                'required',
                Rule::in(data_get(SiteContent::current(), 'contact.form.service_options', [])),
            ],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            'website' => ['nullable', 'size:0'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => trim((string) $this->input('name')),
            'email' => trim((string) $this->input('email')),
            'company' => $this->filled('company') ? trim((string) $this->input('company')) : null,
            'message' => trim((string) $this->input('message')),
        ]);
    }
}
