<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TheoryRepository;

class TheoryController extends Controller {
	protected $repository;

	public function __construct( TheoryRepository $repository ) {
		$this->repository = $repository;
	}

	public function index( Request $request ) {
		$theories = $this->repository->paginateAll( $request->get( 'per_page', 15 ) );

		return $this->hateoasPagedResponse( $theories, $request );
	}

	public function show( $id ) {
		$theories = $this->repository->find( $id );

		return $this->hateoasResponse( $theories );
	}
}