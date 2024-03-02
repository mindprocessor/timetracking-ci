<?php

namespace Track\Config;

use CodeIgniter\Shield\Filters\SessionAuth;
use CodeIgniter\Shield\Filters\TokenAuth;

class Registrar
{
    /**
     * Registers the Shield filters.
     */
    public static function Filters(): array
    {
        return [
            'aliases' => [
                'secure' => \Track\Filters\Secure::class,
                'secure_admin' => \Track\Filters\SecureAdmin::class,
            ],
        ];
    }
}