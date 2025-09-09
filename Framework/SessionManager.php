<?php

namespace Framework;

class SessionManager
{
    public static function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $_SESSION[$key] ?? $default;
    }

    public function setFlash(string $key, mixed $value): void
    {
        $this->set('flash_' . $key, $value);
    }

    public function getFlash(string $key, mixed $default = null): mixed
    {
        $value = $this->get('flash'. $key, $default);

        if ($value !== null) {
            unset($_SESSION['flash_' . $key]);
        }
        return $value;
    }
}   