<?php

namespace Course;

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
    ),
    'router' => array(
        'routes' => array(
            __NAMESPACE__ . 'course-rest' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/api/course[/:id]',
                    'constraints' => array(
                        'id' => '[a-zA-Z0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => __NAMESPACE__ . '\Controller\Course'
                    )
                ),
            ),
    	),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        ),
        'strategies' => array(
            'ViewJsonStrategy'
        )
    ),
    'controllers' => array(
        'invokables' => array(
            __NAMESPACE__ . '\Controller\Course' => __NAMESPACE__ . '\Controller\CourseRestController'
        )
    ),
    'service_manager' => array(
        'invokables' => array(
            'application.course.service' => __NAMESPACE__ . '\Service\Course\Course'
        ),
        'factories' => array(
            'application.course.orm'                    => __NAMESPACE__ . '\Service\DoctrineFactory',
            'application.course.formservice.addcourse'  => __NAMESPACE__ . '\Service\CourseAddFactory',
            'application.course.formservice.editcourse' => __NAMESPACE__ . '\Service\CourseEditFactory'
        ),
        'aliases' => array(
        ),
        'shared' => array(
            'application.course.formservice.addcourse' => false,
            'application.course.formservice.editcourse' => false
        ),

    ),
);
