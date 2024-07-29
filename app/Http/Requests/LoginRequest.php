<?php

namespace App\Http\Requests;

use App\Rules\ExistsInAnyColumn;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
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
    public function messages(): array
    {
        return [
            'identifier.required' => __('auth.validations.identifier.required'),
        ];
    }

    /**
     * Get the validated data from the request.
     *
     * @param null $key
     * @param null $default *
     *
     * @return array
     */
    public function validated($key = null, $default = null): array
    {
        $validated = parent::validated();

        // Determine the current identifier payload type
        // whether it is email or username based on the user's input.
        $identifierKey = filter_var($this->input('identifier'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        return [
            $identifierKey => $validated['identifier'],
            ...Arr::only($validated, ['password']),
        ];
    }
}
