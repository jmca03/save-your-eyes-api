<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class ExistsInAnyColumn implements ValidationRule
{
    /**
     * Create a new class instance.
     *
     * @param string $tableName
     * @param array  $columns
     * @param string $errorMessage
     */
    public function __construct(protected string $tableName, protected array $columns, protected string $errorMessage)
    {

    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $valueExists = false;

        foreach ($this->columns as $column) {
            if (DB::table($this->tableName)->where($column, $value)->exists()) {
                $valueExists = true;
            }
        }

        !$valueExists && $fail($this->errorMessage ?: __('validation.exists', ['attribute' => $attribute]));
    }
}
