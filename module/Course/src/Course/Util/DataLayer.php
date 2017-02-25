<?php

namespace Course\Util;

use Zend\Json\Json;
use Zend\ServiceManager\ServiceLocatorInterface;
use Doctrine\Common\Util\Debug as DDebug;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

/**
 * Utility class to normalize incoming data and denormalize output data.
 * Normalization layer is required to make client and server application
 * exchange data without issue.
 */
class DataLayer
{
    protected static $serviceLocator;

    public static function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        self::$serviceLocator = $serviceLocator;
    }

    public static function getServiceLocator()
    {
        return self::$serviceLocator;
    }

    public static function normalize(array $data)
    {
        $normalized = array();

        if(null !== $id) {
            $normalized['id'] = $id;
        }

        $normalized = array_merge($data, $normalized);

        return $normalized;
    }

    public static function denormalize(array $data)
    {
        $em = self::getServiceLocator()->get('application.course.orm');
        $hydrator = new DoctrineObject($em);
        $denormalized = array();

        $denormalized = array_merge(array_map(function($element) {
            if($element instanceof \Datetime) {
                return $element->format('Y-m-d H:i:s');
            }

            if(!is_scalar($element)) {
                return $element;
            }

            return (string) $element;
        }, $data), $denormalized);

        return $denormalized;
    }
}
