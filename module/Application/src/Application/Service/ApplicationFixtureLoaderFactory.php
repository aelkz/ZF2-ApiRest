<?php 
namespace Application\Service;

use Zend\ServiceManager\FactoryInterface;
use	Zend\ServiceManager\ServiceLocatorInterface;

use Doctrine\Common\DataFixtures\Loader;
use	Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use	Doctrine\Common\DataFixtures\Purger\ORMPurger;

use Course\Fixture\LoadCourseData;

class ApplicationFixtureLoaderFactory implements FactoryInterface
{
    protected $executor;

    protected $loader;

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
    	$entityManager = $serviceLocator->get('application.application.orm');
    	
    	$purger = new ORMPurger();
    	$this->loader = new Loader();
        $this->loader->addFixture(new LoadCourseData());
    	$this->executor = new ORMExecutor($entityManager, $purger);
    	
    	return $this;
    }

    public function load() 
    {
        // Second argument set to true will append the fixtures instead of purging
        return $this->executor->execute($this->loader->getFixtures(), true);
    }
}