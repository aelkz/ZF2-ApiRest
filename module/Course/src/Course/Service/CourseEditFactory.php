<?php

namespace Course\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Course\Form\CourseEdit;
use Course\InputFilter\CourseEditFilter;
use Course\Entity\Course;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

class CourseEditFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $form = new CourseEdit();
        $inputfilter = new CourseEditFilter();
        $form->setInputFilter($inputfilter);

        $em = $sm->get('application.course.orm');
        $form->setHydrator(new DoctrineObject($em))
        	 ->setObject(new Course());

        return $form;
    }
}
