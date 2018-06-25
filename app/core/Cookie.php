<?php

class Cookie
{
    private $cookie_expire;
    private $cookie_path;
    private $cookie_domain;
    private $cookie_secure;
    private $cookie_httponly;

    public function __construct(
        int $cookie_expire,
        string $cookie_path,
        string $cookie_domain,
        bool $cookie_secure,
        bool $cookie_httponly
    )
    {
        $this->cookie_expire = $cookie_expire;
        $this->cookie_path = $cookie_path;
        $this->cookie_domain = $cookie_domain;
        $this->cookie_secure = $cookie_secure;
        $this->cookie_httponly = $cookie_httponly;
    }

    public function set(string $cookie_key, string $cookie_value, int $cookie_expire = null): void
    {
        setcookie(
            $cookie_key,
            $cookie_value,
            $cookie_expire ?? $this->cookie_expire,
            $this->cookie_path,
            $this->cookie_domain,
            $this->cookie_secure,
            $this->cookie_httponly
        );
    }

    public function get(string $cookie_key): ?string
    {
        return $_COOKIE[$cookie_key] ?? null;
    }

    public function remove(string $cookie_key): void
    {
        if (isset($_COOKIE[$cookie_key])) {
            $this->set($cookie_key, '', -3600);
            unset($_COOKIE[$cookie_key]);
        }
    }
}