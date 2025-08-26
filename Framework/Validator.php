<?php

namespace Framework;

class Validator
{
    protected $errors=[];

    public function __construct(
       protected array $Data,
       protected array $rules = []
    ){
        $this->validate();
    }

    public function validate(): void
    {
        foreach ($this->rules as $field => $rules) {
            $rules = explode('|', $rules);
            $value = trim($this->Data[$field]);

            foreach ($rules as $rule) {
                [$name, $parameter] = array_pad(explode(':', $rule, 2), 2, null);

                if ($error = $this->hasError($name, $parameter, $field, $value)) {
                    $this->errors[] = $error;

                    break;
                }
            }
        }
    }

    protected function hasError(string $name, ?string $parameter, string $field, $value): ?string
    {
        return match ($name) {
            'required' => $this->validateRequired($field, $value),
            'min'      => strlen($value) < (int)$parameter                  ? "$field must be at least $parameter characters"   : null,
            'max'      => strlen($value) > (int)$parameter                  ? "$field must be at most $parameter characters"    : null,
            'url'      => !filter_var($value, FILTER_VALIDATE_URL)   ? "$field must be a valid URL"                      : null,
            default    => null,
        };
    }

    protected function validateRequired(string $field, mixed $value): ?string
    {
        return ($value === null || $value === '') ? "$field is required" : null;
    }
    public function passes(): bool
    {
        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

}