<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

/**
 * Base Form Request with security features
 * 
 * All form requests should extend this class for consistent
 * validation and security logging.
 */
abstract class SecureFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    abstract public function rules(): array;

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator): void
    {
        // Log validation failures for admin routes
        if ($this->is('admin/*') || $this->is('api/*')) {
            Log::info('Form validation failed', [
                'url' => $this->fullUrl(),
                'ip' => $this->ip(),
                'errors' => $validator->errors()->toArray(),
            ]);
        }

        parent::failedValidation($validator);
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [];
    }

    /**
     * Common validation rules for reuse
     */
    protected function emailRules(bool $required = true): array
    {
        $rules = ['email', 'max:255'];
        if ($required) {
            array_unshift($rules, 'required');
        } else {
            array_unshift($rules, 'nullable');
        }
        return $rules;
    }

    /**
     * Password validation rules
     */
    protected function passwordRules(bool $required = true): array
    {
        $rules = ['string', 'min:8', 'max:255'];
        if ($required) {
            array_unshift($rules, 'required');
        } else {
            array_unshift($rules, 'nullable');
        }
        return $rules;
    }

    /**
     * Secure string rules (for text inputs)
     */
    protected function stringRules(int $maxLength = 255, bool $required = true): array
    {
        $rules = ['string', "max:{$maxLength}"];
        if ($required) {
            array_unshift($rules, 'required');
        } else {
            array_unshift($rules, 'nullable');
        }
        return $rules;
    }

    /**
     * Image upload rules
     */
    protected function imageRules(bool $required = false, int $maxSizeKb = 10240): array
    {
        $rules = ['image', 'mimes:jpg,jpeg,png,gif,webp,svg', "max:{$maxSizeKb}"];
        if ($required) {
            array_unshift($rules, 'required');
        } else {
            array_unshift($rules, 'nullable');
        }
        return $rules;
    }

    /**
     * URL validation rules
     */
    protected function urlRules(bool $required = false): array
    {
        $rules = ['url', 'max:2048'];
        if ($required) {
            array_unshift($rules, 'required');
        } else {
            array_unshift($rules, 'nullable');
        }
        return $rules;
    }

    /**
     * Numeric rules with optional min/max
     */
    protected function numericRules(bool $required = true, ?float $min = null, ?float $max = null): array
    {
        $rules = ['numeric'];
        if ($required) {
            array_unshift($rules, 'required');
        } else {
            array_unshift($rules, 'nullable');
        }
        if ($min !== null) {
            $rules[] = "min:{$min}";
        }
        if ($max !== null) {
            $rules[] = "max:{$max}";
        }
        return $rules;
    }
}
