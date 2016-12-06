<?php

namespace Course\Entity\Repository;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Util\Debug as DDebug;
use Doctrine\ORM\EntityRepository;
use Zend\Debug\Debug as ZDebug;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

class CourseRepository extends EntityRepository
{
    /**
     * @var DoctrineObject
     */
    protected $hydrator;

    /**
     * Get the hydrator
     *
     * @return \DoctrineModule\Stdlib\Hydrator\DoctrineObject
     */
    public function getHydrator()
    {
        if (null === $this->hydrator) {
            $this->hydrator = new DoctrineObject($this->_em);
        }

        return $this->hydrator;
    }

    /**
     * Doctrine paginator contains an iterator that has
     * a method called getArrayCopy that actually return an
     * array representation of the fieldset BUT transform certain data
     * in the instance name eg.
     * a datetime instance will be transformed in a 'Datetime' string value.
     *
     * So we implement our custom getArrayCopy' method for paginator object
     *
     * @param $paginator
     * @return array
     */
    public function paginatorToArray(Paginator $paginator, array $normalizers = array())
    {
        $data = array();
        foreach ($paginator as $key => $value) {
            foreach ($normalizers as $normalizer) {
                $value = !is_array($value) ? $this->getHydrator()->extract($value) : $value;
                $value = call_user_func_array(array($normalizer, "denormalize"), array($value));
            }
            $data[$key] = $value;
        }

        return $data;
    }

	public function getParam($needle, $haystack, $default = null)
	{
		return isset($haystack[$needle]) ? $haystack[$needle] : $default;
	}

    /**
     * Return a Doctrine2 QueryBuilder configurated using incoming $params
     *
     * @param array $params
     * @return Querybuilder
     */
    public function fetchData($params = array())
    {
        $queryBuilder = $this->_em
            ->createQueryBuilder()
            ->select('a')
            ->from($this->getEntityName(), 'a')
            ->setFirstResult($this->getParam('start', $params, 0))
            ->setMaxResults($this->getParam('length', $params, 10));

        foreach ($params as $key => $param) {
            if (!$this->checkFieldExists($key)) {
              continue;
            }

            $queryBuilder->andWhere($queryBuilder->expr()->eq('a.' . $key, ':' . $key));
            $queryBuilder->setParameter($key, $param);
        }

        return $queryBuilder;
    }
}
