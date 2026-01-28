<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'usuarios', // CAMBIO 1: Antes decía 'users'
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'usuarios', // CAMBIO 2: Antes decía 'users'. Ahora coincide con el provider de abajo.
        ],
    ],

    'providers' => [
        'usuarios' => [
            'driver' => 'eloquent',
            'model' => App\Models\Usuario::class,
        ],
    ],

    'passwords' => [
        'usuarios' => [ // CAMBIO 3: Cambiado el nombre del array para ser consistente
            'provider' => 'usuarios', // Debe apuntar a tu proveedor 'usuarios'
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];