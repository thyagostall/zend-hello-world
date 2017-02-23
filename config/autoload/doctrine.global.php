<?php

$url = isset($_ENV['JAWSDB_URL'])?: getenv('JAWSDB_URL');

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => [
                    'url' => $url,
                ]
            ]
        ]
    ]
];