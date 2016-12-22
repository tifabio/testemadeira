<?php
return array(
    // ...
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => getenv(DB_HOST),
                    'port'     => getenv(DB_PORT),
                    'user'     => getenv(DB_USER),
                    'password' => getenv(DB_PASS),
                    'dbname'   => getenv(DB_BASE)
                )
            )
        )
    ),
);