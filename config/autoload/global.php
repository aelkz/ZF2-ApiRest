<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

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
                    'charset'  => 'UTF8',
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