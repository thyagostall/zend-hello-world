<?php

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => [
                    'url' => $_ENV['JAWSDB_URL'],
                ]
            ]
        ]
    ]
];