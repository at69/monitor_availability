<?php
/**
 * Created by PhpStorm.
 * User: Crocell
 * Date: 18/02/2017
 * Time: 18:50
 */

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;

class CityManager
{
	private $em;
	private $repository;

	/**
	 * MonitorManager constructor.
	 *
	 * @param EntityManager $entityManager
	 */
	public function __construct(EntityManager $entityManager)
	{
		$this->em = $entityManager;
		$this->repository = $this->em->getRepository('AppBundle:City');
	}

	/**
	 * Finds all entities in the repository.
	 *
	 * @return array The entities.
	 */
	public function findAll()
	{
		return $this->repository->findAll();
	}

	/**
	 * Finds an entity by its primary key / identifier.
	 *
	 * @param mixed    $id          The identifier.
	 * @param int|null $lockMode    One of the \Doctrine\DBAL\LockMode::* constants
	 *                              or NULL if no specific lock mode should be used
	 *                              during the search.
	 * @param int|null $lockVersion The lock version.
	 *
	 * @return object|null The entity instance or NULL if the entity can not be found.
	 */
	public function find($id, $lockMode = null, $lockVersion = null)
	{
		return $this->repository->find($id, $lockMode, $lockVersion);
	}

	/**
	 * Finds entities by a set of criteria.
	 *
	 * @param array      $criteria
	 * @param array|null $orderBy
	 * @param int|null   $limit
	 * @param int|null   $offset
	 *
	 * @return array The objects.
	 */
	public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
	{
		return $this->repository->findBy($criteria, $orderBy, $limit, $offset);
	}

	/**
	 * Finds a single entity by a set of criteria.
	 *
	 * @param array $criteria
	 * @param array|null $orderBy
	 *
	 * @return object|null The entity instance or NULL if the entity can not be found.
	 */
	public function findOneBy(array $criteria, array $orderBy = null)
	{
		return $this->repository->findOneBy($criteria, $orderBy);
	}
}