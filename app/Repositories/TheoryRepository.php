<?php namespace App\Repositories;

interface TheoryRepository extends BaseRepository
{
	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function find($id);

	/**
	 * @param int $id
	 *
	 * @return \Illuminate\Pagination\LengthAwarePaginator
	 */
	public function findByScientistId( $id, $perPage = null );
}