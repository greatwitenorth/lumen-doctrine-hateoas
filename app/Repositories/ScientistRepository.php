<?php namespace App\Repositories;

interface ScientistRepository extends BaseRepository
{
	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function find($id);

	/**
	 * Creates a fake scientist and adds some theories
	 * @return mixed
	 */
	public function createFake();
}