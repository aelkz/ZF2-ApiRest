<?php
    
namespace Course\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DoctrineFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        return $sm->get('doctrine.entitymanager.orm_default');
    }
}