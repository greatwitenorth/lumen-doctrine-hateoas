<?php namespace App\Repositories;

use Doctrine\ORM\EntityRepository;
use LaravelDoctrine\ORM\Pagination\Paginatable;
use Symfony\Component\HttpFoundation\Request;

abstract class DoctrineBaseRepository extends EntityRepository implements BaseRepository
{
	use Paginatable;

	/**
	 * @param \Doctrine\ORM\EntityManager $em
	 * @param \Doctrine\ORM\Mapping\ClassMetadata $md
	 */
	public function __construct($em, $md) {
		parent::__construct($em, $md);
	}
}