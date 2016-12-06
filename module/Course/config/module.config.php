<?php

namespace Course;        

return array(
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'
                ),
            ),
            'orm_default' => array(
                'class'   => 'Doctrine\ORM\Mapping\Driver\DriverChain',
                'drivers' => array(
                    // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
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
                )
            ),
             __NAMESPACE__ . 'service-fixture' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/fixture/course/load',
                    'defaults' => array(
                        'controller' => __NAMESPACE__ . '\Controller\Fixture',
                        'action' => 'load'
                    )
                )
            )
    	)
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