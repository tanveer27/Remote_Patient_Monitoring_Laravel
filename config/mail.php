<?php

return [

    'driver' => env('MAIL_DRIVER', env('MAIL_DRIVER')),
    'host' => env('MAIL_HOST', env('MAIL_HOST')),
    'port' => env('MAIL_PORT', 587),
    'from' => ['address' => env('MAIL_USERNAME'), 'name' => env('MAIL_NAME')],
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    'username' => env('MAIL_USERNAME'),
    'password' => env('MAIL_PASSWORD'),
    'sendmail' => '/usr/sbin/sendmail -bs',

];
