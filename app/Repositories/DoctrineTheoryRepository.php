<?php namespace App\Repositories;

use Doctrine\ORM\EntityRepository;
use LaravelDoctrine\ORM\Pagination\Paginatable;

class DoctrineTheoryRepository extends DoctrineBaseRepository implements TheoryRepository
{
	public function findByScientistId( $id, $perPage = 15 ) {
		$perPage = $perPage ? $perPage : 15;
		
		$query = $this->createQueryBuilder('t')->where('t.scientist = ?1')->setParameter(1, $id)->getQuery();
			
		return $this->paginate($query, $perPage);
	}
}