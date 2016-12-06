<?php

return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'doctrine_type_mappings' => array('enum' => 'string'),
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => '127.0.0.1',
                    'port' => '3306',
                    'user'     => 'myusername',
                    'password' => 'mypassword',
                    'dbname' => 'test',
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