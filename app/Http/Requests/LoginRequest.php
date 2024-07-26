<?php

namespace App\Http\Requests;

use App\Rules\ExistsInAnyColumn;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Todo: Use blacklisting for this. If user login failed several times, prevent logging in until the set time.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'identifier' => [
                'required', 'string', new ExistsInAnyColumn(
                    tableName   : 'users',
                    columns     : ['username', 'email'],
                    errorMessage: __('auth.failed')
                )
            ],
            'password'   => 'required|string|min:8'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'identifier.required' => __('auth.validations.identifier.required'),
        ];
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    protected function passedValidation(): void
    {
        $identifierKey = filter_var($this->input('identifier'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $this->only([
            $identifierKey => $this->input('identifier'),
            'password'     => $this->input('password')
        ]);
    }
}
