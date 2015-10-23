<?php namespace App\Repositories;

interface BaseRepository
{
	public function paginateAll($perPage = 15, $pageName = 'page');
}