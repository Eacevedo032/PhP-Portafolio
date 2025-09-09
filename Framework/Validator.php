<?php

namespace Framework;

class Validator
{
    protected $errors = [];

    public function __construct(
        protected array $Data,
        protected array $rules = [],
        protected bool $autoRedirect = true,
    ) {
        $this->validate();

        if ($autoRedirect && !$this->passes()) {
            $this->redirectIfFailed();
        }
    }

    public function validate(): void
    {
        foreach ($this->rules as $field => $rules) {
            $rules = is_array($rules) ? $rules : explode('|', $rules);
            $value = $this->Data[$field] ?? null;

            // Convertir valor vacío a null para manejo consistente
            if ($value === '') {
                $value = null;
            }

            // Si el campo es nullable y está vacío, saltar todas las validaciones
            if (in_array('nullable', $rules) && ($value === null || $value === '')) {
                continue;
            }

            foreach ($rules as $rule) {
                // Saltar la regla 'nullable' ya que ya la procesamos
                if ($rule === 'nullable') {
                    continue;
                }

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
    // Si el valor es null o vacío y no es required, no validar
    if (($value === null || $value === '') && $name !== 'required') {
        return null;
    }
    
    return match ($name) {
        'required' => ($value === null || $value === '') ? "El campo $field es requerido" : null,
        'min'      => strlen($value) < (int)$parameter ? "El campo $field debe tener al menos $parameter caracteres" : null,
        'max'      => strlen($value) > (int)$parameter ? "El campo $field debe tener máximo $parameter caracteres" : null,
        'url'      => !filter_var($value, FILTER_VALIDATE_URL) ? "El campo $field debe ser una URL válida" : null,
        'email'    => !filter_var($value, FILTER_VALIDATE_EMAIL) ? "El campo $field debe ser un email válido" : null,
        'nullable' => null, // Esta regla ya se manejó en validate()
        default    => throw new \InvalidArgumentException("La regla de validación $name no está definida."),
    };
}

    protected function validateRequired(string $field, mixed $value): ?string
    {
        return ($value === null || $value === '') ? "$field is required" : null;
    }

    protected function redirectIfFailed(): void
    {
        $session = new SessionManager();
        $session->setFlash('errors', $this->errors);

        /* var_dump($_SESSION);
        die(); */

        back();
    }

    public static function make(array $data, array $rules, bool $autoRedirect = true): self
    {
        return new self($data, $rules, $autoRedirect);
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