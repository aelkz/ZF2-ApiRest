<?php

namespace Course\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Http\Response;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;
use Zend\Json\Json;
use Zend\Debug\Debug as ZDebug;

class CourseRestController extends AbstractRestfulController
{
    protected $allowedCollectionMethods = array(
        'GET',
        'POST',
        'OPTIONS'
    );

    protected $allowedResourceMethods = array(
        'GET',
        'PATCH',
        'PUT',
        'DELETE'
    );

    public function checkOptions(MvcEvent $e)
    {
        $matches  = $e->getRouteMatch();
        $response = $e->getResponse();
        $request  = $e->getRequest();
        $method   = $request->getMethod();

        if ($matches->getParam('id', false)) {
            if (!in_array($method, $this->allowedResourceMethods)) {
                $response->setStatusCode(405);
                return $response;
            }
            return;
        }

        if (!in_array($method, $this->allowedCollectionMethods)) {
            $response->setStatusCode(405);
            return $response;
        }
    }

    public function injectLinkHeader(MvcEvent $e)
    {
        $response = $e->getResponse();
        $headers  = $response->getHeaders();
    }

    public function getList()
    {
        $this->getResponse()->setStatusCode(Response::STATUS_CODE_200);

        $params = array_merge_recursive(
            $this->params()->fromQuery(),
            $this->params()->fromRoute()
        );

        $service = $this->getServiceLocator()->get('application.course.service');

        try {
            $data = $service->getList($params);
        } catch (\Exception $e) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_500);
            $data = array('messages' => $e->getMessage());
        }

		return new JsonModel($data);
    }

    public function get($id)
    {
        $this->getResponse()->setStatusCode(Response::STATUS_CODE_200);
        $service = $this->getServiceLocator()->get('application.course.service');

        try {
            $data = $service->get($id);
        } catch (CourseNotFoundException $e) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_404);
            $data = $e->getMessage();
        } catch (\Exception $e) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_500);
            $data = $e->getMessage();
        }

        return new JsonModel(array(
            'data' => $data
        ));
    }

    public function create($data)
    {
        $this->getResponse()->setStatusCode(Response::STATUS_CODE_200);
		$service = $this->getServiceLocator()->get('application.course.service');

		try {
            $data = $service->create($data);
        } catch (InvalidDataException $e) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_500);
            $data = Json::decode($e->getMessage());
        } catch (\Exception $e) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_500);
            $data = $e->getMessage();
        }

		return new JsonModel(array(
			'data' => $data
		));
    }

    public function update($id, $data)
    {
        $this->getResponse()->setStatusCode(Response::STATUS_CODE_200);
        $service = $this->getServiceLocator()->get('application.course.service');

        try {
            $data = $service->update($id, $data);
        } catch (InvalidDataException $e) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_500);
            $data = Json::decode($e->getMessage());
        } catch (CourseNotFoundException $e) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_404);
            $data = Json::decode($e->getMessage());
        } catch (\Exception $e) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_500);
            $data = $e->getMessage();
        }

        return new JsonModel(array(
            'data' => $data
        ));
    }

    public function delete($id)
    {
        $this->getResponse()->setStatusCode(Response::STATUS_CODE_200);
        $service = $this->getServiceLocator()->get('application.course.service');

        try {
            $data = $service->delete($id);
        } catch (InvalidDataException $e) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_500);
            $data = Json::decode($e->getMessage());
        } catch (CourseNotFoundException $e) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_404);
            $data = Json::decode($e->getMessage());
        } catch (\Exception $e) {
            $this->getResponse()->setStatusCode(Response::STATUS_CODE_500);
            $data = $e->getMessage();
        }

        return new JsonModel(array(
            'data' => $data
        ));
    }
}
