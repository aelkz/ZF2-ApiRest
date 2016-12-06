<?php

namespace Course\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Course\Form\CourseAdd;
use Course\InputFilter\CourseAddFilter;
use Course\Entity\Course;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

class CourseAddFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $form = new CourseAdd();
    	$inputfilter = new CourseAddFilter();
    	$form->setInputFilter($inputfilter);

    	$em = $sm->get('application.course.orm');
    	$form->setHydrator(new DoctrineObject($em))
    		 ->setObject(new Course());

    	return $form;
    }
}
