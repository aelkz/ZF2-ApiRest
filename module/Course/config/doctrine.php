<?php

return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'doctrine_type_mappings' => array('enum' => 'string'),
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => getEnv('MYSQL_SERVICE_HOST'),
                    'port' => getEnv('MYSQL_SERVICE_PORT'),
                    'user' => getEnv('MYSQL_SERVICE_USER'),
                    'password' => getEnv('MYSQL_SERVICE_PASSWORD'),
                    'dbname' => getEnv('MYSQL_SERVICE_SCHEMA'),
                    'driverOptions' => array(
                        1002 => 'SET NAMES utf8'
                    )
                )
            ),
        ),
        'migrations' => array(
            'migrations_table' => 'migrations',
            'migrations_namespace' => 'application',
            'migrations_directory' => __DIR__ . '/../../data/DoctrineORMModule/migrations',
        ),
    ),
);
