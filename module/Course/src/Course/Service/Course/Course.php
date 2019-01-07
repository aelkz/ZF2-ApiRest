<?php
namespace Course\Service\Course;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\Debug\Debug as ZDebug;
use Zend\Json\Json;
use Doctrine\Common\Util\Debug as DDebug;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Course\Entity\Course as CourseEntity;
use Course\Service\Course\Exception\CourseNotFoundException;
use Course\Service\Course\Exception\InvalidDataException;
use Course\Util\DataLayer;

class Course implements
    EventManagerAwareInterface,
    ServiceLocatorAwareInterface
{
    use EventManagerAwareTrait;
    use ServiceLocatorAwareTrait;

    public function get($id)
    {
        $em = $this->getServiceLocator()->get('application.course.orm');
    	$entityRepository = $em->getRepository('Course\Entity\Course');
    	$entity = $entityRepository->findOneBy(array('id' => $id));

    	if(null === $entity) {
    		throw new CourseNotFoundException();
    	}

    	$hydrator = new DoctrineObject($em);

        return DataLayer::denormalize($hydrator->extract($entity));
    }

    public function getList()
    {
        $em = $this->getServiceLocator()->get('application.course.orm');
        $entityRepository = $em->getRepository('Course\Entity\Course');
        $queryBuilder = $entityRepository->fetchData();
        $paginator = new Paginator($queryBuilder);

        return $entityRepository->paginatorToArray($paginator, array(
            'Course\Util\DataLayer'
        ));
    }

    public function create($data)
    {
        $em = $this->getServiceLocator()->get('application.course.orm');
    	$entityRepository = $em->getRepository('Course\Entity\Course');
    	$form = $this->getServiceLocator()->get('application.course.formservice.addcourse');

    	$entity = new CourseEntity();
    	$form->bind($entity);
    	$form->setData($data);

    	if(!$form->isValid()) {
    		throw new InvalidDataException(Json::encode($form->getMessages()));
    	}

    	$em->persist($entity);
    	$em->flush();
    	$hydrator = new DoctrineObject($em);

        return DataLayer::denormalize($hydrator->extract($entity));
    }

    public function update($id, $data)
    {
        $em = $this->getServiceLocator()->get('application.course.orm');
    	$entityRepository = $em->getRepository('Course\Entity\Course');
    	$form = $this->getServiceLocator()->get('application.course.formservice.editcourse');
    	$entity = $entityRepository->findOneBy(array('id' => $id));

    	if(null === $entity) {
    		throw new CourseNotFoundException();
    	}

    	$form->bind($entity);
    	$form->setData($data);

    	if(!$form->isValid()) {
    		throw new InvalidDataException(Json::encode($form->getMessages()));
    	}

    	$em->persist($entity);
    	$em->flush();
    	$hydrator = new DoctrineObject($em);

        return DataLayer::denormalize($hydrator->extract($entity));
    }

    public function delete($id)
    {
        $em = $this->getServiceLocator()->get('application.course.orm');
    	$entityRepository = $em->getRepository('Course\Entity\Course');
    	$form = $this->getServiceLocator()->get('application.course.formservice.editcourse');
    	$entity = $entityRepository->findOneBy(array('id' => $id));

    	if (null === $entity) {
    		throw new CourseNotFoundException();
    	}

    	$em->remove($entity);
    	$em->flush();
    	$hydrator = new DoctrineObject($em);

        return DataLayer::denormalize($hydrator->extract($entity));
    }
}
