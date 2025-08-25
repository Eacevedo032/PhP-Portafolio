<?php

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

                $error = match ($name) {
                    'required' => empty($value)                                             ? "$field is required"                              : null,
                    'min'      => strlen($value) < (int)$parameter                  ? "$field must be at least $parameter characters"   : null,
                    'max'      => strlen($value) > (int)$parameter                  ? "$field must be at most $parameter characters"    : null,
                    'url'      => !filter_var($value, FILTER_VALIDATE_URL)   ? "$field must be a valid URL"                      : null,
                    default    => null,
                };

                if ($error) {
                    $this->errors[] = $error;

                    break;
                }
            }
        }
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