<?php

return [
    'settings' => [
        'displayErrorDetails' => false, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Monolog settings
        'logger' => [
            'name' => 'restoo',
            'path' => (PHP_SAPI == 'cli-server') ? 'php://stdout' : __DIR__ . '/../logfiles/restoo.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Database settings
        'mysql' => [
            'charset' => 'utf8',
            'database_type' => 'mysql',
            'database_name' => $_ENV['MYSQL_DATABASE'],
            'server' =>   $_ENV['MYSQL_SERVER'],
            'username' => $_ENV['MYSQL_USER'],
            'password' => $_ENV['MYSQL_PASSWORD']
        ],
        'allowed' => [
          'insert',
          'select',
          'update'
        ]
    ],
];
