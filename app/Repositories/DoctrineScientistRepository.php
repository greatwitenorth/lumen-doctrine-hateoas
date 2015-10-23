<?php namespace App\Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use LaravelDoctrine\ORM\Pagination\Paginatable;

class DoctrineScientistRepository extends DoctrineBaseRepository implements ScientistRepository
{
	public function createFake() {
		$faker = \Faker\Factory::create();

		$scientist = new \App\Scientist(
			$faker->firstName,
			$faker->lastName,
			$faker->numberBetween(18, 100)
		);

		$count = rand(1,10);
		for($i = 0; $i <= $count; $i++){
			$scientist->addTheory(
				new \App\Theory($faker->sentence(5))
			);
		}

		$this->getEntityManager()->persist($scientist);
		$this->getEntityManager()->flush();
		
		return $scientist;
	}
}