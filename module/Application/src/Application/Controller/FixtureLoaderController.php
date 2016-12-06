<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\Http\Response;

class FixtureLoaderController extends AbstractActionController
{
    public function loadAction()
    {
        $this->getResponse()->setStatusCode(Response::STATUS_CODE_200);
        $service = $this->getServiceLocator()->get('application.fixture.loader');
        $result = new \stdClass();
        
        try {
            $result = $service->load();
        } catch (\Exception $e) {
    		$this->getResponse()->setStatusCode(Response::STATUS_CODE_500);
            $result = $e->getMessage();
        }
        
        return new JsonModel(array('data' => $result));
    }
}
